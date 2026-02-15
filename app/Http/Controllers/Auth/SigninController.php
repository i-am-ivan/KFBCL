<?php



namespace App\Http\Controllers\Auth;



use App\Http\Controllers\Controller;

use App\Models\User;

use App\Models\UserLogin;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Log;

use Illuminate\Foundation\Auth\User as Authenticatable;



class SigninController extends Controller

{

    public function showSigninForm()

    {

        return view('auth.signin');

    }



    public function signin(Request $request)

    {

        Log::info('Signin attempt:', ['email' => $request->email]);



        try {

            // Find user login by email

            $userLogin = UserLogin::where('email', $request->email)->first();



            if (!$userLogin) {

                return response()->json([

                    'success' => false,

                    'message' => 'Invalid email or password'

                ], 401);

            }



            // Check password

            if (!Hash::check($request->password, $userLogin->password)) {

                return response()->json([

                    'success' => false,

                    'message' => 'Invalid email or password'

                ], 401);

            }



            // Check if account is active

            if ($userLogin->status !== 'Active') {

                return response()->json([

                    'success' => false,

                    'message' => 'Your account is ' . strtolower($userLogin->status) . '. Please contact administrator.'

                ], 401);

            }



            // Get the user - Use User model (not Users)

            $user = User::where('id', $userLogin->user_id)->first();  // Changed from Users to User



            if (!$user) {

                return response()->json([

                    'success' => false,

                    'message' => 'Account error. Please contact administrator.'

                ], 500);

            }



            // Check user status in users table

            if ($user->status !== 'Active') {

                return response()->json([

                    'success' => false,

                    'message' => 'Your account is ' . strtolower($user->status) . '. Please contact administrator.'

                ], 401);

            }



            // Log the user in - Now $user is an Authenticatable instance

            Auth::login($user, $request->boolean('remember', false));



            // Update user login info

            $userLogin->update([

                'logged_in_at' => now(),

                'session_id' => session()->getId(),

                'token' => session()->token(),

                'logged_out_at' => null,

            ]);



            // Determine redirect based on role

            $redirectUrl = $this->getRedirectPath($userLogin->role);



            return response()->json([

                'success' => true,

                'message' => 'Sign in successful! Redirecting...',

                'redirect' => $redirectUrl,

                'role' => $userLogin->role

            ]);



        } catch (\Exception $e) {

            Log::error('Signin failed:', ['error' => $e->getMessage()]);

            return response()->json([

                'success' => false,

                'message' => 'Sign in failed. Please try again.'

            ], 500);

        }

    }



    public function signout(Request $request)

    {

        if (Auth::check()) {

            $userId = Auth::id();



            // Update logout time

            UserLogin::where('user_id', $userId)

                ->whereNull('logged_out_at')

                ->update(['logged_out_at' => now()]);



            Log::info('User signed out:', ['user_id' => $userId]);



            Auth::logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

        }



        return redirect('/');

    }



    private function getRedirectPath($role)

    {

        // Match your dashboard directory structure and named routes

        return match(strtolower($role)) {

            'treasurer' => route('treasurer.dashboard'),

            'supervisor' => route('supervisor.dashboard'),

            'chairman' => route('chairman.dashboard'),

            'secretarygeneral' => route('secretary.dashboard'), // This matches "Secretary General" → secretarygeneral → folder: secretaryGeneral

            'it' => route('it.dashboard'),

            'receptionist' => route('receptionist.dashboard'),

            default => route('receptionist.dashboard'),  // fallback

        };

    }

}