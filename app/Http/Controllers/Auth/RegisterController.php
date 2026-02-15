<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.signup');
    }

    public function register(Request $request)
    {
        // Log the incoming request for debugging
        Log::info('Registration attempt:', $request->all());

        // Validate input
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email|unique:user_logins,email',
            'phone' => 'required|string|max:15|unique:users,phone',
            'gender' => 'required|in:Male,Female', // Fixed: Capitalized to match DB
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
                'gender' => $request->gender, // This should now be 'Male' or 'Female'
                'national_id' => null,
                'date_of_birth' => null,
                'role' => 'Receptionist', // Capitalized to match enum
                'status' => 'Active', // Capitalized to match enum
            ]);

            Log::info('User created:', ['user_id' => $user->id]);

            // Create user login
            $userLogin = UserLogin::create([
                'user_id' => $user->id,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'status' => 'Active', // Capitalized
                'role' => 'Receptionist', // Capitalized
                'token' => null,
                'session_id' => null,
                'logged_in_at' => null,
                'logged_out_at' => null,
            ]);

            Log::info('UserLogin created:', ['login_id' => $userLogin->id]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Registration successful! You can now sign in.',
                'redirect' => '/'
            ]);

        } catch (\Exception $e) {
            DB::rollback();

            // Log the actual error
            Log::error('Registration failed with error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'input' => $request->all()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Registration failed: ' . $e->getMessage(), // Show actual error for debugging
                'debug' => 'Check laravel.log for details' // Remove in production
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
}
