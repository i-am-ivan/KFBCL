<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserLogin;
use App\Models\UserRole;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
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
        $users = User::where('role', '!=', 'SuperAdmin')->get();

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

        // Validate input with custom rule for 18+ age
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email|unique:user_logins,email',
            'phone' => 'required|string|max:15|unique:users,phone',
            'gender' => 'required|in:Male,Female',
            'date_of_birth' => 'required|date|before_or_equal:' . now()->subYears(18)->format('Y-m-d'),
            'national_id' => 'nullable|string|max:255',
            'user_role' => 'required|in:Chairman,Secretary,Treasurer,Supervisor,IT,Receptionist',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'date_of_birth.before_or_equal' => 'User must be at least 18 years old.',
            'date_of_birth.required' => 'Date of birth is required.',
            'user_role.required' => 'Please select a user role.',
            'user_role.in' => 'Invalid role selected.',
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
            // Format date if needed (should already be in Y-m-d from frontend)
            $dateOfBirth = $request->date_of_birth;

            // Create user
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'gender' => $request->gender,
                'national_id' => $request->national_id,
                'date_of_birth' => $dateOfBirth,
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

    /**
     * Update user profile (updates both users and user_logins tables)
     */
    public function updateSystemUserProfile(Request $request): JsonResponse
    {
        try {
            $userId = Auth::id();

            $validator = Validator::make($request->all(), [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'gender' => 'required|in:Male,Female',
                'date_of_birth' => 'required|date_format:d-M-Y',
                'email' => 'required|email|max:255|unique:users,email,' . $userId . '|unique:user_logins,email,' . $userId . ',user_id',
                'national_id' => 'required|string|max:255',
                'phone' => 'required|string|max:15',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Convert date format from 'd-M-Y' to 'Y-m-d' for database
            $dob = null;
            if ($request->input('date_of_birth')) {
                try {
                    $dob = Carbon::createFromFormat('d-M-Y', $request->input('date_of_birth'))->format('Y-m-d');
                } catch (\Exception $e) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Invalid date format. Please use DD-MMM-YYYY (e.g., 11-Nov-1988)'
                    ], 422);
                }
            }

            // Update users table
            User::where('id', $userId)->update([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'gender' => $request->input('gender'),
                'date_of_birth' => $dob,
                'email' => $request->input('email'),
                'national_id' => $request->input('national_id'),
                'phone' => $request->input('phone'),
                'updated_at' => now()
            ]);

            // Update user_logins table
            UserLogin::where('user_id', $userId)->update([
                'email' => $request->input('email'),
                'updated_at' => now()
            ]);

            Log::info('User profile updated', ['user_id' => $userId]);

            return response()->json([
                'success' => true,
                'message' => 'Profile updated successfully.'
            ]);

        } catch (\Exception $e) {
            Log::error('Profile update failed', [
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
     * Update user password
     */
    public function updateSystemUserPassword(Request $request): JsonResponse
    {
        try {
            $userId = Auth::id();

            $validator = Validator::make($request->all(), [
                'password' => [
                    'required',
                    'string',
                    'min:8',
                    'confirmed',
                    'regex:/[a-z]/',      // at least one lowercase letter
                    'regex:/[A-Z]/',      // at least one uppercase letter
                    'regex:/[0-9]/',      // at least one number
                    'regex:/[@$!%*#?&]/', // at least one special character
                ],
                'password_confirmation' => 'required|string|same:password'
            ], [
                'password.regex' => 'Password must contain at least one lowercase letter, one uppercase letter, one number, and one special character.',
                'password.confirmed' => 'Password confirmation does not match.'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Hash the new password
            $hashedPassword = Hash::make($request->input('password'));

            // Update user_logins table
            UserLogin::where('user_id', $userId)->update([
                'password' => $hashedPassword,
                'updated_at' => now()
            ]);

            Log::info('User password updated', ['user_id' => $userId]);

            return response()->json([
                'success' => true,
                'message' => 'Password updated successfully.'
            ]);

        } catch (\Exception $e) {
            Log::error('Password update failed', [
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
     * Deactivate user account
     */
    public function deactivateSystemUserAccount(Request $request): JsonResponse
    {
        try {
            $userId = Auth::id();

            // Update users table status to Inactive
            User::where('id', $userId)->update([
                'status' => 'Inactive',
                'updated_at' => now()
            ]);

            // Update user_logins table status to Inactive
            UserLogin::where('user_id', $userId)->update([
                'status' => 'Inactive',
                'updated_at' => now()
            ]);

            Log::info('User account deactivated', ['user_id' => $userId]);

            // Return success with signout URL
            return response()->json([
                'success' => true,
                'message' => 'Account deactivated successfully.',
                'redirect' => route('signout') // Send the signout route URL
            ]);

        } catch (\Exception $e) {
            Log::error('Account deactivation failed', [
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
     * Get current authenticated user data
     */
    public function getCurrentUser(): JsonResponse
    {
        try {
            $user = Auth::user();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found'
                ], 404);
            }

            // Get user login data
            $userLogin = UserLogin::where('user_id', $user->id)->first();

            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $user->id,
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'gender' => $user->gender,
                    'national_id' => $user->national_id,
                    'date_of_birth' => $user->date_of_birth ? Carbon::parse($user->date_of_birth)->format('d-M-Y') : null,
                    'role' => $user->role,
                    'status' => $user->status,
                    'login_status' => $userLogin ? $userLogin->status : null
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Get current user failed', [
                'error' => $e->getMessage()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

}
