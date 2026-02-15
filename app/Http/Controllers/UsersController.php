<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserLogin;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;

class UsersController extends Controller
{
    /**
     * Get dashboard stats for users page - SIMPLE ONE CALL like appointments
     */
    public function getDashboardStats(): JsonResponse
    {
        try {
            // 1. Count all users where role != 'IT'
            $totalUsers = User::where('role', '!=', 'IT')->count();

            // 2. Count active users where status = 'Active' and role != 'IT'
            $activeUsers = User::where('status', 'Active')
                             ->where('role', '!=', 'IT')
                             ->count();

            // 3. Count all user roles
            $totalRoles = UserRole::count();

            // Return JSON response - SIMPLE format
            return response()->json([
                'success' => true,
                'data' => [
                    'total_users' => $totalUsers,
                    'active_users' => $activeUsers,
                    'total_roles' => $totalRoles,
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving stats: ' . $e->getMessage()
            ], 500);
        }
    } 

    /**
     * Get all users where role != 'IT' for Alpine.js table
     */
    public function getAllUsers(): JsonResponse
    {
        $users = User::where('role', '!=', 'IT')->get();

        return response()->json([
            'users' => $users
        ]);
    }

    /**
     * Get all user roles for table
     */
    public function getAllUserRoles(): JsonResponse
    {
        $userRoles = UserRole::all();

        return response()->json([
            'userRoles' => $userRoles
        ]);
    }
    /**
     * Function to create new system users
     */
    public function store(Request $request)
    {
        // Log the incoming request
        Log::info('Create user attempt:', $request->all());

        // Validate input
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email|unique:user_logins,email',
            'phone' => 'required|string|max:15|unique:users,phone',
            'gender' => 'required|in:Male,Female',
            'date_of_birth' => 'nullable|date',
            'national_id' => 'nullable|string|max:255',
            'user_role' => 'required|in:Chairman,Secretary,Treasurer,Supervisor,IT,Receptionist',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            Log::error('Validation failed:', $validator->errors()->toArray());
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Start database transaction
        DB::beginTransaction();

        try {
            // Create user
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'gender' => $request->gender,
                'national_id' => $request->national_id,
                'date_of_birth' => $request->date_of_birth,
                'role' => $request->user_role,
                'status' => 'Active',
            ]);

            Log::info('User created:', ['user_id' => $user->id]);

            // Create user login
            $userLogin = UserLogin::create([
                'user_id' => $user->id,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'status' => 'Active',
                'role' => $request->user_role,
                'token' => null,
                'session_id' => null,
                'logged_in_at' => null,
                'logged_out_at' => null,
            ]);

            Log::info('UserLogin created:', ['login_id' => $userLogin->id]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'User created successfully!',
            ]);

        } catch (\Exception $e) {
            DB::rollback();

            Log::error('Create user failed:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to create user: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function checkEmail(Request $request)
    {
        $exists = User::where('email', $request->email)->exists() ||
                  UserLogin::where('email', $request->email)->exists();

        return response()->json(['exists' => $exists]);
    }

    public function checkPhone(Request $request)
    {
        $exists = User::where('phone', $request->phone)->exists();

        return response()->json(['exists' => $exists]);
    }

    /**
     *  Function for resetting user password in user management
     */
    public function resetPassword(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer|exists:users,id',
            'u_password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $userId = $request->input('user_id');
            $hashedPassword = Hash::make($request->input('u_password'));

            UserLogin::where('user_id', $userId)->update([
                'password' => $hashedPassword,
                'updated_at' => now()
            ]);

            Log::info('Password reset for user', ['user_id' => $userId]);

            return response()->json([
                'success' => true,
                'message' => 'Password updated successfully.'
            ]);
        } catch (\Exception $e) {
            Log::error('Password reset failed', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Failed to update password.'
            ], 500);
        }
    }

    /**
     * Update user details (updates users and user_logins tables)
     */
    public function updateSystemUser(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|integer|exists:users,id',
                'u_first_name' => 'required|string|max:255',
                'u_last_name' => 'required|string|max:255',
                'u_email' => 'required|email|max:255',
                'u_phone' => 'required|string|max:15',
                'u_gender' => 'required|in:Male,Female',
                'u_national_id' => 'nullable|string|max:255',
                'u_dob' => 'nullable|date_format:d-M-Y',
                'u_role' => 'required|string|max:255',
                'u_status' => 'required|in:Active,Inactive,Suspended,Removed',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $userId = (int) $request->input('user_id');

            // Convert date format from 'd-M-Y' to 'Y-m-d'
            $dob = null;
            if ($request->input('u_dob')) {
                try {
                    $dob = \Carbon\Carbon::createFromFormat('d-M-Y', $request->input('u_dob'))->format('Y-m-d');
                } catch (\Exception $e) {
                    $dob = $request->input('u_dob');
                }
            }

            // Update users table
            User::where('id', $userId)->update([
                'first_name' => $request->input('u_first_name'),
                'last_name' => $request->input('u_last_name'),
                'email' => $request->input('u_email'),
                'phone' => $request->input('u_phone'),
                'gender' => $request->input('u_gender'),
                'national_id' => $request->input('u_national_id'),
                'date_of_birth' => $dob,
                'role' => $request->input('u_role'),
                'status' => $request->input('u_status'),
            ]);

            // Update user_logins table
            UserLogin::where('user_id', $userId)->update([
                'email' => $request->input('u_email'),
                'role' => $request->input('u_role'),
                'status' => $request->input('u_status'),
            ]);

            Log::info('User updated', ['user_id' => $userId]);

            return response()->json([
                'success' => true,
                'message' => 'User updated successfully.'
            ]);

        } catch (\Exception $e) {
            Log::error('User update failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete user from system (deletes from both users and user_logins tables)
     */
    public function deleteSystemUser(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        DB::beginTransaction();

        try {
            $userId = (int) $request->input('user_id');

            // Delete from user_logins table first (child table)
            $loginDeleted = UserLogin::where('user_id', $userId)->delete();

            // Force delete from users table (parent table) - handles soft deletes
            $userDeleted = User::where('id', $userId)->forceDelete();

            DB::commit();

            Log::info('User deleted', [
                'user_id' => $userId,
                'login_records_deleted' => $loginDeleted,
                'user_records_deleted' => $userDeleted
            ]);

            return response()->json([
                'success' => true,
                'message' => 'User has been removed from the system.'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('User deletion failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

}