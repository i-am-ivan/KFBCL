<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use Carbon\Carbon;
Use App\Models\MemberKin;
use App\Models\MemberVehicle;
use App\Models\Stage;
use App\Models\MemberContribution;
use App\Models\MemberLoanType;
use App\Models\MemberLoan;
use App\Models\MemberLoanTransaction;
use App\Models\MemberBonusType;
use App\Models\MemberFineType;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\File;

class BodabodaController extends Controller {

    // A. Members (members table) ---------------------------------------------------------------------------------------
    // Return all members with their next-of-kin and vehicles (JSON)
    public function listAllMembers(Request $request): JsonResponse
    {
        $members = Member::select('members.*')
            ->with(['kins', 'vehicles', 'identification'])
            ->addSelect([
                'last_contribution_amount' => MemberContribution::select('transactionAmount')
                    ->whereColumn('memberId', 'members.memberId')
                    ->where('transactionStatus', 'Confirmed')
                    ->where('transactionType', 'Paid-In')
                    ->orderBy('transactionDate', 'desc')
                    ->limit(1),
                'last_contribution_date' => MemberContribution::select('transactionDate')
                    ->whereColumn('memberId', 'members.memberId')
                    ->where('transactionStatus', 'Confirmed')
                    ->where('transactionType', 'Paid-In')
                    ->orderBy('transactionDate', 'desc')
                    ->limit(1),
            ])
            ->orderBy('memberId', 'asc')
            ->get();

        return response()->json(['data' => $members], 200);
    }

    // Count all members (JSON)
    public function countAllMembers(): JsonResponse
    {
        $total = Member::count();
        return response()->json(['count' => $total], 200);
    }


    public function countMembers()
    {
        $count = DB::table('members')->where('membership', 'Member')->count();
        return response()->json(['count' => $count]);
    }

    public function countNonMembers()
    {
        $count = DB::table('members')->where('membership', 'Non-Member')->count();
        return response()->json(['count' => $count]);
    }

    // Add a new member with file uploads
    public function addMember(Request $request)
    {
        try {
            // Validate incoming data
            $validated = $request->validate([
                'personal.firstName' => 'required|string|max:255',
                'personal.lastName' => 'required|string|max:255',
                'personal.email' => 'required|email|max:255',
                'personal.primaryPhone' => 'required|string|max:20',
                'personal.secondaryPhone' => 'nullable|string|max:20',
                'personal.gender' => 'required|in:Male,Female',
                'personal.dob' => 'required|date_format:d-m-Y',

                'kin.firstName' => 'required|string|max:255',
                'kin.lastName' => 'required|string|max:255',
                'kin.email' => 'required|email|max:255',
                'kin.phone' => 'required|string|max:20',
                'kin.relation' => 'required|string|max:255',

                'identification.nationalId' => 'required|string|max:50',
                'identification.drivingLicense' => 'required|string|max:50',
                'identification.licenseType' => 'required|string|max:255',

                'memberType' => 'required|in:Member,Non-Member',

                'id_front' => 'required|file|mimes:png,jpg,jpeg,webp|max:5120',
                'id_back' => 'required|file|mimes:png,jpg,jpeg,webp|max:5120',
            ]);

            // Start database transaction
            DB::beginTransaction();

            // 1. Insert into members table
            $memberId = DB::table('members')->insertGetId([
                'firstname' => $validated['personal']['firstName'],
                'lastname' => $validated['personal']['lastName'],
                'email' => $validated['personal']['email'],
                'phone1' => $validated['personal']['primaryPhone'],
                'phone2' => $validated['personal']['secondaryPhone'] ?? null,
                'gender' => $validated['personal']['gender'],
                'dob' => date('Y-m-d', strtotime($validated['personal']['dob'])),
                'author' => Auth::id(),
                'membership' => $validated['memberType'],
                'status' => 'Active',
                'created_on' => now(),
                'updated_on' => now(),
            ]);

            // 2. Insert into member_kin table
            DB::table('member_kin')->insert([
                'member' => $memberId,
                'firstname' => $validated['kin']['firstName'],
                'lastname' => $validated['kin']['lastName'],
                'email' => $validated['kin']['email'],
                'phone' => $validated['kin']['phone'],
                'relation' => $validated['kin']['relation'],
                'status' => 'Pending',
                'created_on' => now(),
                'updated_on' => now(),
            ]);

            // 3. Create directory for identification files (using memberId as folder name)
            $folderName = $memberId;
            $directoryPath = database_path("etc/configs/dumps/raw/{$folderName}");

            // Create directory if it doesn't exist
            if (!File::exists($directoryPath)) {
                File::makeDirectory($directoryPath, 0755, true);
            }

            // 4. Save uploaded files
            $idFrontFile = $request->file('id_front');
            $idBackFile = $request->file('id_back');

            $frontFileName = 'front.' . $idFrontFile->getClientOriginalExtension();
            $backFileName = 'back.' . $idBackFile->getClientOriginalExtension();

            $frontPath = "database/etc/configs/dumps/raw/{$folderName}/{$frontFileName}";
            $backPath = "database/etc/configs/dumps/raw/{$folderName}/{$backFileName}";

            // Move files to directory
            $idFrontFile->move($directoryPath, $frontFileName);
            $idBackFile->move($directoryPath, $backFileName);

            // 5. Insert into members_identification table
            DB::table('member_identifications')->insert([
                'member_id' => $memberId,
                'national_id' => $validated['identification']['nationalId'],
                'driver_license' => $validated['identification']['drivingLicense'],
                'driving_license_type' => $validated['identification']['licenseType'],
                'ntsa_compliance' => 'Pending',
                'national_id_front_path' => $frontPath,
                'national_id_back_path' => $backPath,
                'author' => Auth::id(),
                'status' => 'Pending',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Commit transaction
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Member added successfully!',
                'redirect' => route('treasurer.bodaboda')
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    // Get all related member data
    public function getAllMemberData($memberId)
    {
        $memberData = [
            'member' => DB::table('members')->where('memberId', $memberId)->first(),
            'identification' => DB::table('member_identifications')->where('member_id', $memberId)->first(),
            'kin' => DB::table('member_kin')->where('member', $memberId)->first(),
            //'vehicles' => DB::table('members_vehicles')->where('member', $memberId)->get(),
            'contributions' => DB::table('member_contributions')->where('memberId', $memberId)->get(),
        ];

        return response()->json($memberData);
    }

    // Get  all member kins
    public function getMemberKins($memberId)
    {
        $kins = DB::table('member_kin')
            ->where('member', $memberId)
            ->get();

        return response()->json($kins);
    }

    // Update Member Personal Info
    public function updateMemberPersonalInfo(Request $request, $memberId)
    {
        try {
            $validated = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'primary_phone' => 'required|string|max:255',
                'secondary_phone' => 'nullable|string|max:255',
                'gender' => 'required|in:Male,Female',
                'dob' => 'required|date',
                'membership' => 'required|in:Member,Non-Member',
                'status' => 'required|in:Active,In-Active,Suspended,Blacklisted'
            ]);

            $updated = DB::table('members')
                ->where('memberId', $memberId)
                ->update([
                    'firstname' => $validated['first_name'],
                    'lastname' => $validated['last_name'],
                    'email' => $validated['email'],
                    'phone1' => $validated['primary_phone'],
                    'phone2' => $validated['secondary_phone'],
                    'gender' => $validated['gender'],
                    'dob' => $validated['dob'],
                    'membership' => $validated['membership'],
                    'status' => $validated['status'],
                    'updated_on' => now()
                ]);

            if ($updated) {
                return response()->json([
                    'success' => true,
                    'message' => 'Member personal information updated successfully'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'No changes were made or member not found'
                ], 400);
            }

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating member information: ' . $e->getMessage()
            ], 500);
        }
    }

    // Update Member Identification and documents
    public function updateIdentificationDocuments(Request $request, $memberId)
    {
        try {
            $validated = $request->validate([
                'national_id' => 'required|string|max:50',
                'driving_license' => 'nullable|string|max:50',
                'license_type' => 'nullable|string|max:100',
                'ntsa_compliant' => 'nullable|string|max:20',
                'status' => 'required|in:Approved,Flagged,Pending',
                'id_front' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
                'id_back' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120'
            ]);

            // Check if record exists
            $existing = DB::table('member_identifications')
                ->where('member_id', $memberId)
                ->first();

            $data = [
                'national_id' => $validated['national_id'],
                'driver_license' => $validated['driving_license'],
                'driving_license_type' => $validated['license_type'],
                'ntsa_compliance' => $validated['ntsa_compliant'],
                'status' => $validated['status'],
                'updated_at' => now()
            ];

            // Define the base directory path
            $basePath = "database/etc/configs/dumps/raw/{$memberId}";

            // Ensure directory exists
            if (!file_exists($basePath)) {
                mkdir($basePath, 0755, true);
            }

            // Handle front ID file upload - always save as front with original extension
            if ($request->hasFile('id_front')) {
                $frontFile = $request->file('id_front');
                $extension = $frontFile->getClientOriginalExtension();
                $frontFilename = "front.{$extension}";
                $frontPath = "{$basePath}/{$frontFilename}";

                // Move and rename the file
                $frontFile->move($basePath, $frontFilename);

                // Store the path in DB (without changing it)
                $data['national_id_front_path'] = $frontPath;
            }

            // Handle back ID file upload - always save as back with original extension
            if ($request->hasFile('id_back')) {
                $backFile = $request->file('id_back');
                $extension = $backFile->getClientOriginalExtension();
                $backFilename = "back.{$extension}";
                $backPath = "{$basePath}/{$backFilename}";

                // Move and rename the file
                $backFile->move($basePath, $backFilename);

                // Store the path in DB (without changing it)
                $data['national_id_back_path'] = $backPath;
            }

            if ($existing) {
                // Update existing record
                $updated = DB::table('member_identifications')
                    ->where('member_id', $memberId)
                    ->update($data);
            } else {
                // Insert new record
                $data['member_id'] = $memberId;
                $data['author'] = Auth::id() ?? 1;
                $data['created_at'] = now();
                $updated = DB::table('member_identifications')
                    ->insert($data);
            }

            if ($updated) {
                return response()->json([
                    'success' => true,
                    'message' => 'Member identification documents updated successfully'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'No changes were made or member not found'
                ], 400);
            }

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating identification documents: ' . $e->getMessage()
            ], 500);
        }
    }

    public function addMemberKin(Request $request, $memberId)
    {
        try {
            $validated = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:255',
                'relation' => 'required|string|max:255'
            ]);

            $data = [
                'member' => $memberId,
                'firstname' => $validated['first_name'],
                'lastname' => $validated['last_name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'relation' => $validated['relation'],
                'status' => 'Active',
                'created_on' => now(),
                'updated_on' => now()
            ];

            $inserted = DB::table('member_kin')->insert($data);

            if ($inserted) {
                return response()->json([
                    'success' => true,
                    'message' => 'Next of kin added successfully'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to add next of kin'
                ], 400);
            }

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error adding next of kin: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateMemberKin(Request $request, $memberId, $kinId)
    {
        try {
            $validated = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:255',
                'relation' => 'required|string|max:255',
                'status' => 'required|string|max:255'
            ]);

            $data = [
                'firstname' => $validated['first_name'],
                'lastname' => $validated['last_name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'relation' => $validated['relation'],
                'status' => $validated['status'],
                'updated_on' => now()
            ];

            $updated = DB::table('member_kin')
                ->where('kin_id', $kinId)
                ->where('member', $memberId)
                ->update($data);

            if ($updated) {
                return response()->json([
                    'success' => true,
                    'message' => 'Next of kin updated successfully'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'No changes were made or kin not found'
                ], 400);
            }

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating next of kin: ' . $e->getMessage()
            ], 500);
        }
    }

    public function deleteMemberKin(Request $request, $memberId, $kinId)
    {
        try {
            // Get kin details for confirmation message
            $kin = DB::table('member_kin')
                ->where('kin_id', $kinId)
                ->where('member', $memberId)
                ->first();

            if (!$kin) {
                return response()->json([
                    'success' => false,
                    'message' => 'Next of kin not found'
                ], 404);
            }

            $deleted = DB::table('member_kin')
                ->where('kin_id', $kinId)
                ->where('member', $memberId)
                ->delete();

            if ($deleted) {
                return response()->json([
                    'success' => true,
                    'message' => 'Next of kin removed successfully',
                    'kin_name' => $kin->firstname . ' ' . $kin->lastname
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to delete next of kin'
                ], 400);
            }

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting next of kin: ' . $e->getMessage()
            ], 500);
        }
    }

    // Vehicles --------------------------------------------------------------------------------------

    public function addMemberVehicle(Request $request, $memberId)
    {
        try {
            $validated = $request->validate([
                'type' => 'required|in:Motorcycle,Tuk Tuk',
                'plate_number' => 'required|string|max:255',
                'brand' => 'required|string|max:255',
                'model' => 'required|string|max:255',
                'make' => 'required|string|max:255',
                'cc' => 'required|string|max:255',
                'insurance' => 'required|in:Comprehesive,Third-Party',
                'yom' => 'required|integer|min:1900|max:2099',
                'ntsa_compliant' => 'required|in:Approved,Suspended',
                'status' => 'required|in:Approved,Suspended,Under Review'
            ]);

            $data = [
                'member' => $memberId,
                'plate_number' => $validated['plate_number'],
                'make' => $validated['make'],
                'model' => $validated['model'],
                'brand' => $validated['brand'],
                'yom' => $validated['yom'],
                'CC' => $validated['cc'],
                'NTSA_compliant' => $validated['ntsa_compliant'] === 'Approved' ? 1 : 0,
                'insurance' => $validated['insurance'],
                'status' => $validated['status'],
                'created_on' => now(),
                'updated_on' => now()
            ];

            $inserted = DB::table('members_vehicles')->insert($data);

            if ($inserted) {
                return response()->json([
                    'success' => true,
                    'message' => 'Vehicle added successfully'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to add vehicle'
                ], 400);
            }

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error adding vehicle: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateMemberVehicle(Request $request, $memberId, $vehicleId)
    {
        try {
            $validated = $request->validate([
                'type' => 'required|in:Motorcycle,Tuk Tuk',
                'plate_number' => 'required|string|max:255',
                'brand' => 'required|string|max:255',
                'model' => 'required|string|max:255',
                'make' => 'required|string|max:255',
                'cc' => 'required|string|max:255',
                'insurance' => 'required|in:Comprehesive,Third-Party',
                'yom' => 'required|integer|min:1900|max:2099',
                'ntsa_compliant' => 'required|in:Approved,Suspended',
                'status' => 'required|in:Approved,Suspended,Under Review'
            ]);

            $data = [
                'plate_number' => $validated['plate_number'],
                'make' => $validated['make'],
                'model' => $validated['model'],
                'brand' => $validated['brand'],
                'yom' => $validated['yom'],
                'CC' => $validated['cc'],
                'type' => $validated['type'],
                'NTSA_compliant' => $validated['ntsa_compliant'] === 'Approved' ? 1 : 0,
                'insurance' => $validated['insurance'],
                'status' => $validated['status'],
                'updated_on' => now()
            ];

            $updated = DB::table('members_vehicles')
                ->where('vehicleId', $vehicleId)
                ->where('member', $memberId)
                ->update($data);

            if ($updated) {
                return response()->json([
                    'success' => true,
                    'message' => 'Vehicle updated successfully'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'No changes were made or vehicle not found'
                ], 400);
            }

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating vehicle: ' . $e->getMessage()
            ], 500);
        }
    }

    public function deleteMemberVehicle(Request $request, $memberId, $vehicleId)
    {
        try {
            // Get vehicle details for confirmation message
            $vehicle = DB::table('members_vehicles')
                ->where('vehicleId', $vehicleId)
                ->where('member', $memberId)
                ->first();

            if (!$vehicle) {
                return response()->json([
                    'success' => false,
                    'message' => 'Vehicle not found'
                ], 404);
            }

            $deleted = DB::table('members_vehicles')
                ->where('vehicleId', $vehicleId)
                ->where('member', $memberId)
                ->delete();

            if ($deleted) {
                return response()->json([
                    'success' => true,
                    'message' => 'Vehicle removed successfully',
                    'vehicle_details' => $vehicle->model . ' ' . $vehicle->make . ' ' . $vehicle->plate_number
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to delete vehicle'
                ], 400);
            }

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting vehicle: ' . $e->getMessage()
            ], 500);
        }
    }

    // Vehicle Stats
    public function countAllVehicles()
    {
        $count = DB::table('members_vehicles')->count();
        return response()->json(['count' => $count]);
    }

    public function countAllMotorcycles()
    {
        $count = DB::table('members_vehicles')->where('type', 'Motorcycle')->count();
        return response()->json(['count' => $count]);
    }

    public function countAllTukTuks()
    {
        $count = DB::table('members_vehicles')->where('type', 'Tuk Tuk')->count();
        return response()->json(['count' => $count]);
    }

    // B. Stages -----------------------------------------------------------------------------------
    public function listAllStages(Request $request): JsonResponse
    {
        $stages = Stage::leftJoin('members', 'stages.manager', '=', 'members.memberId')
            ->select(
                'stages.*',
                DB::raw("COALESCE(CONCAT(members.firstname, ' ', members.lastname), '') as manager_name"),
                'members.memberId as manager_id'
            )
            ->get();

        return response()->json(['data' => $stages], 200);
    }

    // Count all stages (JSON)
    public function countAllStages(): JsonResponse
    {
        $total = Stage::count();
        return response()->json(['total' => $total], 200);
    }

    // Add this method to your existing controller
    public function storeStage(Request $request)
    {
        try {
            // Validate input
            $validated = $request->validate([
                'newStageLocation' => 'required|string|max:255',
                'newStageStatus' => 'required|string|in:Active,In-Active,Under Review',
            ], [
                'newStageLocation.required' => 'Stage location cannot be empty',
                'newStageStatus.required' => 'Stage status cannot be empty',
            ]);

            // Create new stage
            $stage = Stage::create([
                'location' => $validated['newStageLocation'],
                'status' => $validated['newStageStatus'],
                'author' => Auth::id(),
                'established' => now(),
                'created_on' => now(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Stage location created successfully!',
                'redirect' => route('treasurer.bodaboda')
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => implode('\n', array_merge(...array_values($e->errors())))
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    //
    public function getAllStagesData()
    {
        $stages = Stage::select('stageId', 'location', 'established', 'status')->get();

        return response()->json([
            'success' => true,
            'data' => $stages
        ]);
    }

    // Update Stage entry
    public function updateStageDetails(Request $request)
    {
        try {
            $validated = $request->validate([
                'stageId' => 'required|exists:stages,stageId',
                'updateStageLocation' => 'required|string|max:255',
                'updateStageStatus' => 'required|string|in:Active,In-Active,Under Review',
            ], [
                'updateStageLocation.required' => 'Stage location cannot be empty',
                'updateStageStatus.required' => 'Stage status cannot be empty',
            ]);

            $stage = Stage::find($validated['stageId']);
            $stage->update([
                'location' => $validated['updateStageLocation'],
                'status' => $validated['updateStageStatus'],
                'updated_on' => now(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Stage updated successfully!',
                'redirect' => route('treasurer.bodaboda')
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => implode('\n', array_merge(...array_values($e->errors())))
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    // Delete Stage entry
    public function deleteStageLocation(Request $request)
    {
        try {
            $validated = $request->validate([
                'stageId' => 'required|exists:stages,stageId',
            ]);

            Stage::find($validated['stageId'])->delete();

            return response()->json([
                'success' => true,
                'message' => 'Stage deleted successfully!',
                'redirect' => route('treasurer.bodaboda')
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    // Vehicles ---------------------------------------------------------------------------------------------------------
    public function getAllMemberVehicleData($memberId)
    {
        $vehicles = DB::table('members_vehicles')
            ->where('member', $memberId)
            ->get();

        return response()->json([
            'success' => true,
            'vehicles' => $vehicles
        ]);
    }

    public function getCountMemberVehicles($memberId)
    {
        $count = DB::table('members_vehicles')
            ->where('member', $memberId)
            ->count();

        return response()->json([
            'success' => true,
            'count' => $count
        ]);
    }

    public function getAllNonMemberVehicleData($memberId)
    {
        $vehicles = DB::table('member_assign_vehicles')
            ->join('members_vehicles', 'member_assign_vehicles.vehicle', '=', 'members_vehicles.vehicleId')
            ->where('member_assign_vehicles.rider', $memberId)
            ->select('member_assign_vehicles.*', 'members_vehicles.*')
            ->get();

        return response()->json([
            'success' => true,
            'vehicles' => $vehicles
        ]);
    }

    public function getCountNonMemberVehicles($memberId)
    {
        $count = DB::table('members_vehicles')
            ->join('member_assign_vehicles', 'members_vehicles.vehicleId', '=', 'member_assign_vehicles.vehicle')
            ->where('member_assign_vehicles.rider', $memberId)
            ->distinct('members_vehicles.vehicleId')
            ->count('members_vehicles.vehicleId');

        return response()->json([
            'success' => true,
            'count' => $count
        ]);
    }
        // Get available vehicles for assignment
    public function getAvailableMemberVehicles(Request $request, $memberId)
    {
        try {
            $type = $request->query('type', 'all');

            $query = DB::table('members_vehicles')
                ->where('availability', 'Available');

            if ($type !== 'all' && !empty($type)) {
                $query->where('type', $type);
            }

            $vehicles = $query->get();

            return response()->json([
                'success' => true,
                'vehicles' => $vehicles
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching available vehicles: ' . $e->getMessage()
            ], 500);
        }
    }

    // Assign vehicle to non-member
    public function assignMemberVehicle(Request $request, $memberId)
    {
        try {
            $validated = $request->validate([
                'vehicle_id' => 'required|integer|exists:members_vehicles,vehicleId',
                'status' => 'required|in:Approved,Pending,Cancelled'
            ]);

            // Begin transaction
            DB::beginTransaction();

            // Check if vehicle is still available
            $vehicle = DB::table('members_vehicles')
                ->where('vehicleId', $validated['vehicle_id'])
                ->where('availability', 'Available')
                ->first();

            if (!$vehicle) {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => 'Vehicle is no longer available'
                ], 400);
            }

            // Insert into member_assign_vehicles
            $assignedData = [
                'rider' => $memberId,
                'vehicle' => $validated['vehicle_id'],
                'assignedDate' => now(),
                'status' => 'Assigned',
                'author' => Auth::id(),
                'updated_on' => now(),
                'created_at' => now(),
            ];

            $assigned = DB::table('member_assign_vehicles')->insert($assignedData);

            if (!$assigned) {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to assign vehicle'
                ], 400);
            }

            // Update vehicle availability to Assigned
            $updated = DB::table('members_vehicles')
                ->where('vehicleId', $validated['vehicle_id'])
                ->update([
                    'availability' => 'Assigned',
                    'updated_on' => now()
                ]);

            if (!$updated) {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to update vehicle status'
                ], 400);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Vehicle assigned successfully'
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error assigning vehicle: ' . $e->getMessage()
            ], 500);
        }
    }

    // Reassign vehicle (make available again)
    public function reassignMemberVehicle(Request $request, $memberId)
    {
        try {
            $validated = $request->validate([
                'vehicle_id' => 'required|integer|exists:members_vehicles,vehicleId'
            ]);

            // Begin transaction
            DB::beginTransaction();

            // Get current assignment
            $currentAssignment = DB::table('member_assign_vehicles')
                ->where('vehicle', $validated['vehicle_id'])
                ->where('rider', $memberId)
                ->where('status', 'Assigned')
                ->latest('assignedDate')
                ->first();

            if (!$currentAssignment) {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => 'No active assignment found for this vehicle'
                ], 400);
            }

            // Update assignment status to Re-Assigned
            $updated = DB::table('member_assign_vehicles')
                ->where('assignedId', $currentAssignment->assignedId)
                ->update([
                    'status' => 'Re-Assigned',
                    'updated_on' => now(),

                ]);

            if (!$updated) {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to update assignment status'
                ], 400);
            }

            // Update vehicle availability to Available
            $vehicleUpdated = DB::table('members_vehicles')
                ->where('vehicleId', $validated['vehicle_id'])
                ->update([
                    'availability' => 'Available',
                    'updated_on' => now()
                ]);

            if (!$vehicleUpdated) {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to update vehicle availability'
                ], 400);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Vehicle reassigned successfully'
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error reassigning vehicle: ' . $e->getMessage()
            ], 500);
        }
    }

    // Contributions -----------------------------------------------------------------------------------------------------
    // Get all bodaboda contribution data
    public function getAllContributions(Request $request): JsonResponse
    {
        $contributions = MemberContribution::select([
                'member_contributions.*',
                DB::raw('CONCAT(members.firstname, " ", members.lastname) as full_name'),
                'members.membership'
            ])
            ->join('members', 'member_contributions.memberId', '=', 'members.memberId')
            ->where('member_contributions.transactionType', 'Paid-In')
            ->where('member_contributions.transactionStatus', 'Confirmed')
            ->orderBy('member_contributions.transactionDate', 'desc')
            ->get();

        return response()->json(['data' => $contributions], 200);
    }

    public function getAllMemberContributions($memberId)
    {
        $contributions = DB::table('member_contributions')
            ->where('memberId', $memberId)
            ->orderBy('transactionDate', 'desc')
            ->get();

        return response()->json($contributions);
    }

    public function getTotalContributionBalance(Request $request): JsonResponse
    {
        $totalPaidIn = MemberContribution::where('transactionType', 'Paid-In')
            ->where('transactionStatus', 'Confirmed')
            ->sum('transactionAmount');

        $totalPaidOut = MemberContribution::where('transactionType', 'Paid-Out')
            ->where('transactionStatus', 'Confirmed')
            ->sum('transactionAmount');

        $balance = $totalPaidIn - $totalPaidOut;

        return response()->json([
            'success' => true,
            'balance' => $balance,
            'formatted' => 'KES ' . number_format($balance, 2)
        ], 200);
    }

    public function getMemberContributionBalance(Request $request, $memberId): JsonResponse
    {
        $totalPaidIn = MemberContribution::where('memberId', $memberId)
            ->where('transactionType', 'Paid-In')
            ->where('transactionStatus', 'Confirmed')
            ->sum('transactionAmount');

        $totalPaidOut = MemberContribution::where('memberId', $memberId)
            ->where('transactionType', 'Paid-Out')
            ->where('transactionStatus', 'Confirmed')
            ->sum('transactionAmount');

        $balance = $totalPaidIn - $totalPaidOut;

        return response()->json([
            'success' => true,
            'balance' => $balance,
            'formatted' => 'KES ' . number_format($balance, 2)
        ], 200);
    }

    // Make a contribution (Paid-In)
    public function makeMemberContribution(Request $request, $memberId)
    {
        try {
            $validated = $request->validate([
                'amount' => 'required|numeric|min:0.01',
                'payment_mode' => 'required|in:Cash,MPesa,Bank',
                'transaction_code' => 'nullable|string|max:255',
                'status' => 'required|in:Confirmed,Pending,Cancelled'
            ]);

            // Generate transaction code if not provided
            $transactionCode = $validated['transaction_code'] ?? 'CONT-' . strtoupper(uniqid());

            $data = [
                'memberId' => $memberId,
                'transactionCode' => $transactionCode,
                'transactionAmount' => $validated['amount'],
                'transactionDate' => now(),
                'transactionMode' => $validated['payment_mode'],
                'transactionType' => 'Paid-In',
                'transactionStatus' => $validated['status'],
                'transactionAuthor' => Auth::id(),
                'transactionUpdatedOn' => now()
            ];

            $inserted = DB::table('member_contributions')->insert($data);

            if ($inserted) {
                return response()->json([
                    'success' => true,
                    'message' => 'Contribution added successfully'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to add contribution'
                ], 400);
            }

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error adding contribution: ' . $e->getMessage()
            ], 500);
        }
    }

    // Withdraw from contribution (Paid-Out)
    public function withdrawMemberContribution(Request $request, $memberId)
    {
        try {
            $validated = $request->validate([
                'amount' => 'required|numeric|min:0.01',
                'payment_mode' => 'required|in:Cash,MPesa,Bank',
                'transaction_code' => 'nullable|string|max:255',
                'status' => 'required|in:Confirmed,Pending,Cancelled'
            ]);

            // Check if member has sufficient balance
            $totalIn = DB::table('member_contributions')
                ->where('memberId', $memberId)
                ->where('transactionType', 'Paid-In')
                ->whereIn('transactionStatus', ['Confirmed', 'Approved'])
                ->sum('transactionAmount');

            $totalOut = DB::table('member_contributions')
                ->where('memberId', $memberId)
                ->where('transactionType', 'Paid-Out')
                ->whereIn('transactionStatus', ['Confirmed', 'Approved'])
                ->sum('transactionAmount');

            $balance = $totalIn - $totalOut;

            if ($balance < $validated['amount']) {
                return response()->json([
                    'success' => false,
                    'message' => 'Insufficient balance. Available: ' . number_format($balance, 2)
                ], 400);
            }

            // Generate transaction code if not provided
            $transactionCode = $validated['transaction_code'] ?? 'WITH-' . strtoupper(uniqid());

            $data = [
                'memberId' => $memberId,
                'transactionCode' => $transactionCode,
                'transactionAmount' => $validated['amount'],
                'transactionDate' => now(),
                'transactionMode' => $validated['payment_mode'],
                'transactionType' => 'Paid-Out',
                'transactionStatus' => $validated['status'],
                'transactionAuthor' => Auth::id(),
                'transactionUpdatedOn' => now()
            ];

            $inserted = DB::table('member_contributions')->insert($data);

            if ($inserted) {
                return response()->json([
                    'success' => true,
                    'message' => 'Withdrawal processed successfully'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to process withdrawal'
                ], 400);
            }

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error processing withdrawal: ' . $e->getMessage()
            ], 500);
        }
    }

    // Update contribution transaction
    public function updateMemberContribution(Request $request, $memberId, $transactionId)
    {
        try {
            $validated = $request->validate([
                'amount' => 'required|numeric|min:0.01',
                'payment_mode' => 'required|in:Cash,MPesa,Bank',
                'transaction_code' => 'nullable|string|max:255',
                'status' => 'required|in:Confirmed,Pending,Cancelled'
            ]);

            // Get the original transaction to check if it exists
            $original = DB::table('member_contributions')
                ->where('transactionId', $transactionId)
                ->where('memberId', $memberId)
                ->first();

            if (!$original) {
                return response()->json([
                    'success' => false,
                    'message' => 'Transaction not found'
                ], 404);
            }

            $data = [
                'transactionAmount' => $validated['amount'],
                'transactionMode' => $validated['payment_mode'],
                'transactionCode' => $validated['transaction_code'] ?? $original->transactionCode,
                'transactionStatus' => $validated['status'],
                'transactionUpdatedOn' => now()
            ];

            $updated = DB::table('member_contributions')
                ->where('transactionId', $transactionId)
                ->where('memberId', $memberId)
                ->update($data);

            if ($updated) {
                return response()->json([
                    'success' => true,
                    'message' => 'Transaction updated successfully'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'No changes were made or transaction not found'
                ], 400);
            }

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating transaction: ' . $e->getMessage()
            ], 500);
        }
    }

    // Monthly Contribution Data for Chart
    public function getMonthlyContributions()
    {
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $currentYear = now()->year;

        $data = [];
        foreach ($months as $index => $month) {
            $monthNum = $index + 1;

            $paidIn = DB::table('member_contributions')
                ->whereYear('transactionDate', $currentYear)
                ->whereMonth('transactionDate', $monthNum)
                ->where('transactionType', 'Paid-In')
                ->where('transactionStatus', 'Confirmed')
                ->sum('transactionAmount');

            $paidOut = DB::table('member_contributions')
                ->whereYear('transactionDate', $currentYear)
                ->whereMonth('transactionDate', $monthNum)
                ->where('transactionType', 'Paid-Out')
                ->where('transactionStatus', 'Confirmed')
                ->sum('transactionAmount');

            $data[] = [
                'month' => $month,
                'paid_in' => $paidIn,
                'paid_out' => $paidOut,
                'net' => $paidIn - $paidOut
            ];
        }

        return response()->json(['data' => $data]);
    }

    // Bonuses ----------------------------------------------------------------------------------------------------------
    // Get all bodaboda bonus types statistics
    public function getAllBonusTypesSummary(Request $request): JsonResponse
    {
        $bonusSummary = MemberBonusType::select([
                'member_bonus_types.*',
                DB::raw('COALESCE(SUM(member_bonuses.transactionAmount), 0) as total_bonus_amount'),
                DB::raw('COALESCE(COUNT(member_bonuses.transactionId), 0) as total_bonuses_given')
            ])
            ->leftJoin('member_bonuses', 'member_bonus_types.bonusId', '=', 'member_bonuses.transactionBonus')
            ->groupBy('member_bonus_types.bonusId', 'member_bonus_types.bonus_name',
                    'member_bonus_types.calculation_method', 'member_bonus_types.percentage',
                    'member_bonus_types.created_on', 'member_bonus_types.status')
            ->orderBy('member_bonus_types.bonus_name')
            ->get();

        return response()->json(['data' => $bonusSummary], 200);
    }

    public function countAllMemberBonusTypes()
    {
        $count = \App\Models\MemberBonusType::count();

        return response()->json([
            'success' => true,
            'count' => $count
        ]);
    }

    // Create new bonus type
    public function createNewBonusType(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'newBonusType' => 'required|string|max:255',
                'bonusDescription' => 'nullable|string',
                'newBonusPercentage' => 'required|numeric|min:0|max:100',
                'newBonusStatus' => 'required|string'
            ]);

            $bonusType = MemberBonusType::create([
                'bonus_name' => $validated['newBonusType'],
                'description' => $validated['bonusDescription'] ?? '',
                'calculation_method' => 'percentage', // Default as per your structure
                'percentage' => $validated['newBonusPercentage'],
                'status' => $validated['newBonusStatus'],
                'author' => Auth::id(),
                'created_on' => now(),
                'updated_on' => now()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Bonus type created successfully',
                'data' => $bonusType
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create bonus type: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateBonusType(Request $request)
    {
        try {
            $request->validate([
                'bonus_id' => 'required|integer|exists:member_bonus_types,bonusId',
                'bonus_name' => 'required|string|max:255',
                'description' => 'required|string',
                'percentage' => 'required|numeric|min:0|max:100',
                'status' => 'required|string'
            ]);

            $bonusType = MemberBonusType::find($request->bonus_id);

            // Use update() instead of direct property assignment
            $bonusType->update([
                'bonus_name' => $request->bonus_name,
                'description' => $request->description,
                'calculation_method' => $request->description,
                'percentage' => $request->percentage,
                'status' => $request->status,
                'author' => Auth::id(),
                'updated_on' => now()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Bonus Type updated successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteBonusType(Request $request)
    {
        try {
            $request->validate([
                'bonus_id' => 'required|integer|exists:member_bonus_types,bonusId'
            ]);

            $bonusType = MemberBonusType::find($request->bonus_id);

            // DB is set to CASCADE, so related records will be deleted automatically
            $bonusType->delete();

            return response()->json([
                'success' => true,
                'message' => 'Bonus Type deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // Fines ------------------------------------------------------------------------------------------------------------
    // Get all bodaboda Fines types statistics
    public function getAllFineTypesSummary(Request $request): JsonResponse
    {
        $fineSummary = MemberFineType::select([
                'member_fine_types.*',
                DB::raw('COALESCE(SUM(member_fines.transactionAmount), 0) as total_fine_amount'),
                DB::raw('COALESCE(COUNT(member_fines.transactionId), 0) as total_fines_issued')
            ])
            ->leftJoin('member_fines', 'member_fine_types.fineId', '=', 'member_fines.transactionFine')
            ->groupBy('member_fine_types.fineId', 'member_fine_types.fine_name',
                    'member_fine_types.description', 'member_fine_types.percentage',
                    'member_fine_types.is_percentage', 'member_fine_types.created_on',
                    'member_fine_types.status')
            ->orderBy('member_fine_types.fine_name')
            ->get();

        return response()->json(['data' => $fineSummary], 200);
    }

    public function countAllMemberFineTypes()
    {
        $count = \App\Models\MemberFineType::count();

        return response()->json([
            'success' => true,
            'count' => $count
        ]);
    }

    // Create new fine type
    public function createNewFineType(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'newFineType' => 'required|string|max:255',
                'fineDescription' => 'nullable|string',
                'newFinePercentage' => 'required|numeric|min:0|max:100',
                'newFineStatus' => 'required|string'
            ]);

            $fineType = MemberFineType::create([
                'fine_name' => $validated['newFineType'],
                'description' => $validated['fineDescription'] ?? '',
                'percentage' => $validated['newFinePercentage'],
                'is_percentage' => 1, // Default to percentage as per your form
                'status' => $validated['newFineStatus'],
                'author' => Auth::id(),
                'created_on' => now(),
                'updated_on' => now()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Fine type created successfully',
                'data' => $fineType
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create fine type: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateFineType(Request $request)
    {
        try {
            $request->validate([
                'fine_id' => 'required|integer|exists:member_fine_types,fineId',
                'fine_name' => 'required|string|max:255',
                'description' => 'required|string',
                'percentage' => 'required|numeric|min:0|max:100',
                'status' => 'required|string'
            ]);

            $fineType = MemberFineType::find($request->fine_id);

            // USE update() METHOD INSTEAD OF DIRECT ASSIGNMENT
            $fineType->update([
                'fine_name' => $request->fine_name,
                'description' => $request->description,
                'percentage' => $request->percentage,
                'is_percentage' => $request->is_percentage ?? 1,
                'status' => $request->status,
                'author' => Auth::id(),
                'updated_on' => now()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Fine Type updated successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteFineType(Request $request)
    {
        try {
            $request->validate([
                'fine_id' => 'required|integer|exists:member_fine_types,fineId'
            ]);

            $fineType = MemberFineType::find($request->fine_id);

            // DB is set to CASCADE, so related records will be deleted automatically
            $fineType->delete();

            return response()->json([
                'success' => true,
                'message' => 'Fine Type deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function getAllMemberFines($memberId)
    {
        $fines = DB::table('member_fines')
            ->where('memberId', $memberId)
            ->orderBy('transactionDate', 'desc')
            ->get();

        return response()->json($fines);
    }

    // Loans ------------------------------------------------------------------------------------------------------------
    // All loan types statistics
    public function getAllLoansSummary(Request $request): JsonResponse
    {
        $loansSummary = MemberLoanType::select([
                'member_loan_types.*',
                DB::raw('COALESCE(SUM(member_loans.transactionLoanAmount), 0) as total_loaned'),
                DB::raw('COALESCE(COUNT(DISTINCT CASE WHEN member_loans.transactionStatus = "Approved" THEN member_loans.transactionId END), 0) as total_loans'),
                DB::raw('COALESCE(COUNT(DISTINCT CASE WHEN member_loans_transactions.transactionStatus = "Confirmed" THEN member_loans_transactions.transactionId END), 0) as active_loan_transactions')
            ])
            ->leftJoin('member_loans', 'member_loan_types.loanId', '=', 'member_loans.transactionLoan')
            ->leftJoin('member_loans_transactions', function($join) {
                $join->on('member_loans.transactionId', '=', 'member_loans_transactions.transactionLoan')
                    ->where('member_loans_transactions.transactionStatus', '=', 'Confirmed');
            })
            ->groupBy('member_loan_types.loanId', 'member_loan_types.loan_type_name',
                    'member_loan_types.interest_rate', 'member_loan_types.repayment_period_months',
                    'member_loan_types.max_amount', 'member_loan_types.created_on',
                    'member_loan_types.status')
            ->orderBy('member_loan_types.loan_type_name')
            ->get();

        return response()->json(['data' => $loansSummary], 200);
    }

    public function countAllMemberLoanTypes()
    {
        $count = \App\Models\MemberLoanType::count();

        return response()->json([
            'success' => true,
            'count' => $count
        ]);
    }

    // Create new loan type
    public function createNewLoanType(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'newLoanType' => 'required|string|max:255',
                'loanInterestRate' => 'required|numeric|min:0',
                'loanMaxAmount' => 'required|numeric|min:0',
                'loanRepaymentPeriod' => 'required|integer|min:1',
                'newLoanStatus' => 'required|string'
            ]);

            // Create new instance and save manually
            $loanType = new MemberLoanType();
            $loanType->loan_type_name = $validated['newLoanType'];
            $loanType->interest_rate = $validated['loanInterestRate'];
            $loanType->max_amount = $validated['loanMaxAmount'];
            $loanType->repayment_period_months = $validated['loanRepaymentPeriod'];
            $loanType->status = $validated['newLoanStatus'];
            $loanType->author = Auth::id();
            $loanType->created_on = now();
            $loanType->updated_on = now();
            $loanType->save();

            return response()->json([
                'success' => true,
                'message' => 'Loan type created successfully',
                'data' => $loanType
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create loan type: ' . $e->getMessage()
            ], 500);
        }
    }

    // UPDATE LOAN TYPE
    public function updateLoanType(Request $request)
    {
        try {
            // Get JSON input if sent as JSON
            $data = $request->json()->all();

            $validator = Validator::make($data, [
                'loan_type_id' => 'required|integer|exists:member_loan_types,loanId',
                'loan_type_name' => 'required|string|max:255',
                'interest_rate' => 'required|numeric|min:0',
                'max_amount' => 'required|numeric|min:0',
                'repayment_period_months' => 'required|integer|min:1',
                'status' => 'required|string'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed: ' . implode(', ', $validator->errors()->all())
                ], 422);
            }

            $loanType = MemberLoanType::find($data['loan_type_id']);

            if (!$loanType) {
                return response()->json([
                    'success' => false,
                    'message' => 'Loan Type not found'
                ], 404);
            }

            $loanType->loan_type_name = $data['loan_type_name'];
            $loanType->interest_rate = $data['interest_rate'];
            $loanType->max_amount = $data['max_amount'];
            $loanType->repayment_period_months = $data['repayment_period_months'];
            $loanType->status = $data['status'];
            $loanType->author = Auth::id();
            $loanType->updated_on = now();
            $loanType->save();

            return response()->json([
                'success' => true,
                'message' => 'Loan Type updated successfully!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Server error: ' . $e->getMessage()
            ], 500);
        }
    }

    // DELETE LOAN TYPE
    public function deleteLoanType(Request $request)
    {
        try {
            $request->validate([
                'loan_type_id' => 'required|integer|exists:member_loan_types,loanId'
            ]);

            $loanType = MemberLoanType::find($request->loan_type_id);

            // DB is set to CASCADE, so related records will be deleted automatically
            $loanType->delete();

            return response()->json([
                'success' => true,
                'message' => 'Loan Type deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // Count all member active loans
    public function countAllMemberLoans($memberId)
    {
        $count = DB::table('member_loans')
            ->where('memberId', $memberId)
            ->where('transactionLoanStatus', 'Active')
            ->count();

        return response()->json(['active_loans_count' => $count]);
    }

    public function getAllMemberLoans($memberId)
    {
        $loans = DB::table('member_loans')
            ->where('memberId', $memberId)
            ->orderBy('transactionCreated', 'desc')
            ->get();

        return response()->json($loans);
    }

    // Loan Stats
    public function countAllLoansAwarded()
    {
        $count = DB::table('member_loans')->count();
        return response()->json(['count' => $count]);
    }

    public function countAllActiveLoans()
    {
        $count = DB::table('member_loans')
            ->where('transactionLoanStatus', 'Active')
            ->count();
        return response()->json(['count' => $count]);
    }

    public function countAllBadLoans()
    {
        $count = DB::table('member_loans')
            ->whereIn('transactionLoanStatus', ['Defaulted', 'Stopped'])
            ->count();
        return response()->json(['count' => $count]);
    }

    // Monthly Loan Data for Chart
    public function getMonthlyLoans()
    {
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $currentYear = now()->year;

        $data = [];
        foreach ($months as $index => $month) {
            $monthNum = $index + 1;

            $disbursed = DB::table('member_loans')
                ->whereYear('transactionCreated', $currentYear)
                ->whereMonth('transactionCreated', $monthNum)
                ->where('transactionStatus', 'Approved')
                ->sum('transactionLoanAmount');

            $repaid = DB::table('member_loans_transactions')
                ->whereYear('transactionDate', $currentYear)
                ->whereMonth('transactionDate', $monthNum)
                ->where('transactionStatus', 'Confirmed')
                ->sum('transactionAmount');

            $data[] = [
                'month' => $month,
                'disbursed' => $disbursed,
                'repaid' => $repaid
            ];
        }

        return response()->json(['data' => $data]);
    }

    // Loan Status Distribution for Pie Chart
    public function getLoanStatusDistribution()
    {
        $active = DB::table('member_loans')
            ->where('transactionLoanStatus', 'Active')
            ->count();

        $repaid = DB::table('member_loans')
            ->where('transactionLoanStatus', 'Repaid')
            ->count();

        $defaulted = DB::table('member_loans')
            ->whereIn('transactionLoanStatus', ['Defaulted', 'Stopped'])
            ->count();

        return response()->json([
            'active' => $active,
            'repaid' => $repaid,
            'defaulted' => $defaulted
        ]);
    }

    // Get all loan types for dropdown
    public function getAllLoanData()
    {
        try {
            $loanTypes = DB::table('member_loan_types')
                ->where('status', 'Active')
                ->select('loanId', 'loan_type_name', 'interest_rate', 'max_amount', 'repayment_period_months')
                ->get();

            // Get all loans with related data
            $loans = DB::table('member_loans as ml')
                ->join('member_loan_types as mlt', 'ml.transactionLoan', '=', 'mlt.loanId')
                ->join('members as m', 'ml.memberId', '=', 'm.memberId')
                ->select(
                    'ml.*',
                    'mlt.loan_type_name',
                    'mlt.interest_rate',
                    'm.firstname',
                    'm.lastname',
                    'm.membership'
                )
                ->orderBy('ml.transactionCreated', 'desc')
                ->get();

            return response()->json([
                'success' => true,
                'loanTypes' => $loanTypes,
                'loans' => $loans
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching loan data: ' . $e->getMessage()
            ], 500);
        }
    }

    // Assign loan to member
    public function assignMemberLoan(Request $request, $memberId)
    {
        try {
            $validated = $request->validate([
                'loan_type_id' => 'required|integer|exists:member_loan_types,loanId',
                'amount' => 'required|numeric|min:1',
                'period_months' => 'required|integer|min:1',
                'payment_mode' => 'required|in:Cash,MPesa,Bank',
                'transaction_code' => 'nullable|string|max:255',
                'status' => 'required|in:Approved,Under Review,Cancelled'
            ]);

            // Get loan type details
            $loanType = DB::table('member_loan_types')
                ->where('loanId', $validated['loan_type_id'])
                ->first();

            if (!$loanType) {
                return response()->json([
                    'success' => false,
                    'message' => 'Loan type not found'
                ], 404);
            }

            // Check if amount exceeds max borrowable
            if ($validated['amount'] > $loanType->max_amount) {
                return response()->json([
                    'success' => false,
                    'message' => 'Amount exceeds maximum borrowable of ' . number_format($loanType->max_amount, 2)
                ], 400);
            }

            // Calculate dates
            $startDate = Carbon::now()->addDays(30);
            $endDate = Carbon::now()->addDays(30 + ($validated['period_months'] * 30));

            // Generate transaction code
            $transactionCode = $validated['transaction_code'] ?? 'LOAN-' . strtoupper(uniqid());

            DB::beginTransaction();

            // Insert into member_loans
            $loanData = [
                'memberId' => $memberId,
                'transactionLoan' => $validated['loan_type_id'],
                'transactionLoanAmount' => $validated['amount'],
                'transactionLoanPeriod' => $validated['period_months'],
                'transactionLoanStartDate' => $startDate,
                'transactionLoanRepaymentMode' => 1, // Default repayment mode
                'transactionAuthor' => Auth::id(),
                'transactionCreated' => now(),
                'transactionUpdatedOn' => now(),
                'transactionLoanStatus' => 'Active',
                'transactionStatus' => $validated['status']
            ];

            $loanId = DB::table('member_loans')->insertGetId($loanData);

            // Insert into member_loans_transactions (initial disbursement)
            $transactionData = [
                'memberId' => $memberId,
                'transactionLoan' => $loanId,
                'transactionCode' => $transactionCode,
                'transactionAmount' => $validated['amount'],
                'transactionDate' => now(),
                'transactionMode' => $validated['payment_mode'],
                'transactionAuthor' => Auth::id(),
                'transactionUpdatedOn' => now(),
                'transactionStatus' => 'Confirmed'
            ];

            DB::table('member_loans_transactions')->insert($transactionData);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Loan assigned successfully'
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error assigning loan: ' . $e->getMessage()
            ], 500);
        }
    }

    // Repay loan (make payment)
    public function repayMemberLoan(Request $request, $memberId)
    {
        try {
            $validated = $request->validate([
                'loan_id' => 'required|integer|exists:member_loans,transactionId',
                'amount' => 'required|numeric|min:1',
                'payment_mode' => 'required|in:Cash,MPesa,Bank',
                'transaction_code' => 'nullable|string|max:255',
                'status' => 'required|in:Confirmed,Pending,Cancelled'
            ]);

            // Check if loan exists and is active
            $loan = DB::table('member_loans')
                ->where('transactionId', $validated['loan_id'])
                ->where('memberId', $memberId)
                ->where('transactionLoanStatus', 'Active')
                ->first();

            if (!$loan) {
                return response()->json([
                    'success' => false,
                    'message' => 'Active loan not found'
                ], 404);
            }

            // Generate transaction code
            $transactionCode = $validated['transaction_code'] ?? 'REPAY-' . strtoupper(uniqid());

            // Insert repayment transaction
            $transactionData = [
                'memberId' => $memberId,
                'transactionLoan' => $validated['loan_id'],
                'transactionCode' => $transactionCode,
                'transactionAmount' => $validated['amount'],
                'transactionDate' => now(),
                'transactionMode' => $validated['payment_mode'],
                'transactionAuthor' => Auth::id(),
                'transactionUpdatedOn' => now(),
                'transactionStatus' => $validated['status']
            ];

            DB::table('member_loans_transactions')->insert($transactionData);

            // Calculate total repaid
            $totalRepaid = DB::table('member_loans_transactions')
                ->where('transactionLoan', $validated['loan_id'])
                ->where('transactionStatus', 'Confirmed')
                ->sum('transactionAmount');

            // If fully repaid, update loan status
            if ($totalRepaid >= $loan->transactionLoanAmount) {
                DB::table('member_loans')
                    ->where('transactionId', $validated['loan_id'])
                    ->update([
                        'transactionLoanStatus' => 'Repaid',
                        'transactionUpdatedOn' => now()
                    ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Loan repayment processed successfully'
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error processing repayment: ' . $e->getMessage()
            ], 500);
        }
    }

    // Update loan transaction
    public function updateMemberLoanTransaction(Request $request, $memberId, $transactionId)
    {
        try {
            $validated = $request->validate([
                'amount' => 'required|numeric|min:1',
                'payment_mode' => 'required|in:Cash,MPesa,Bank',
                'transaction_code' => 'nullable|string|max:255',
                'status' => 'required|in:Confirmed,Pending,Cancelled,Reversed'
            ]);

            $data = [
                'transactionAmount' => $validated['amount'],
                'transactionMode' => $validated['payment_mode'],
                'transactionCode' => $validated['transaction_code'],
                'transactionStatus' => $validated['status'],
                'transactionUpdatedOn' => now()
            ];

            $updated = DB::table('member_loans_transactions')
                ->where('transactionId', $transactionId)
                ->where('memberId', $memberId)
                ->update($data);

            if ($updated) {
                return response()->json([
                    'success' => true,
                    'message' => 'Transaction updated successfully'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Transaction not found'
                ], 404);
            }

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating transaction: ' . $e->getMessage()
            ], 500);
        }
    }

    // Get current member's loans
    public function getCurrentMemberLoans($memberId)
    {
        try {
            $loans = DB::table('member_loans as ml')
                ->join('member_loan_types as mlt', 'ml.transactionLoan', '=', 'mlt.loanId')
                ->leftJoin('member_loans_transactions as mlt2', 'ml.transactionId', '=', 'mlt2.transactionLoan')
                ->where('ml.memberId', $memberId)
                ->select(
                    'ml.*',
                    'mlt.loan_type_name',
                    'mlt.interest_rate',
                    DB::raw('COALESCE(SUM(mlt2.transactionAmount), 0) as total_repaid'),
                    DB::raw('ml.transactionLoanAmount - COALESCE(SUM(mlt2.transactionAmount), 0) as outstanding_balance')
                )
                ->groupBy('ml.transactionId')
                ->orderBy('ml.transactionCreated', 'desc')
                ->get();

            // Add last repayment information for each loan
            foreach ($loans as $loan) {
                $lastRepayment = DB::table('member_loans_transactions')
                    ->where('transactionLoan', $loan->transactionId)
                    ->where('transactionStatus', 'Confirmed')
                    ->orderBy('transactionDate', 'desc')
                    ->first();

                $loan->last_repayment = $lastRepayment ? [
                    'amount' => $lastRepayment->transactionAmount,
                    'date' => $lastRepayment->transactionDate
                ] : null;
            }

            return response()->json([
                'success' => true,
                'loans' => $loans
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching member loans: ' . $e->getMessage()
            ], 500);
        }
    }

    // Savings -----------------------------------------------------------------------------------------------------------
    public function getAllMemberSavings($memberId)
    {
        $savings = DB::table('member_savings')
            ->where('memberId', $memberId)
            ->orderBy('transactionDate', 'desc')
            ->get();

        return response()->json($savings);
    }

}
