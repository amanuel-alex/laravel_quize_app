<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;


class AuthController extends Controller
{

    public function showRoleSelectionForm()
    {
        return view('auth.role-selection');
    }

    // Show login form for a specific role
    public function showLoginForm($role)
    {
        return view('auth.login', compact('role'));
    }

    // Show register form for a specific role
    public function showRegisterForm($role)
    {
        return view('auth.register', compact('role'));
    }
    // Admin Registration
    public function adminRegister(Request $request)
    {
        $fields = $request->validate([
            'username' => ['required', 'max:255', 'string', 'regex:/^[A-Za-z\s]+$/'],
            'email' => ['required', 'max:255', 'email', 'unique:users,email'],
            'password' => ['required', 'min:4', 'confirmed'],
        ]);

        // Add 'admin' role to the fields
        $fields['role'] = 'admin';

        // Hash the password before storing
        $fields['password'] = Hash::make($fields['password']);

        // Create the admin user
        $user = User::create($fields);

        // Log the user in
        Auth::login($user);

        // Redirect to admin dashboard
        return redirect()->route('admin.dashboard');
    }

    // Admin Login
    public function adminLogin(Request $request)
    {
        $fields = $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required'],
        ]);

        // Attempt to log the user in
        if (Auth::attempt($fields)) {
            // Redirect to admin dashboard if the user is an admin
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            // If the user is not an admin, redirect to the user dashboard
            return redirect()->route('user.dashboard');
        }

        // If authentication fails
        return back()->withErrors(['failed' => 'The provided credentials do not match our records.']);
    }

    // User Registration
    public function register(Request $request)
    {
        $fields = $request->validate([
            'username' => ['required', 'max:255', 'string', 'regex:/^[A-Za-z\s]+$/'],
            'email' => ['required', 'max:255', 'email', 'unique:users,email'],
            'password' => ['required', 'min:4', 'confirmed'],
        ]);

        // Set role to 'user' for regular registration
        $fields['role'] = 'user';

        // Hash the password
        $fields['password'] = Hash::make($fields['password']);

        // Create the user
        $user = User::create($fields);

        // Log the user in
        Auth::login($user);

        // Redirect to user dashboard
        return redirect()->route('user.dashboard');
    }

    // User Login
    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => ['required', 'max:255', 'email'],
            'password' => ['required'],
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt($fields)) {
            // Check the role of the user after login
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            // Redirect to user dashboard for regular users
            return redirect()->route('user.dashboard');
        }

        // If authentication fails
        return back()->withErrors(['failed' => 'The provided credentials do not match our records.']);
    }

    // Logout Method




    // login option with facebook

    // public function loginWithFacebook()
    // {
    //     return Socialite::driver('facebook')->redirect();
    // }
    // public function facebookAuthentication(){

    //     try {
    //         $facebookUser = Socialite::driver('facebook')->user();
    //         $user = User::where('facebook_id',$facebookUser->id)->first();

    //         if ($user) {
    //             Auth::login($user);
    //             return redirect()->route('dashboard');
    //         } else {
    //             $uData = User::create([
    //                 'username' =>$facebookUser->name,
    //                 'email' =>$facebookUser->email,
    //                 'password' => Hash::make('quize@1234'),
    //                 'facebook_id' =>$facebookUser->id,
    //             ]);
    //             Auth::login($uData);
    //             return redirect()->route('dashboard');
    //         }
    //     } catch (Exception $e) {
    //         // Log the exception details
    //         Log::error('github authentication error: ' . $e->getMessage());
    //         dd($e); // or return an error message
    //     }
    // }

    // login option with github

    public function loginWithGithub()
    {
        return Socialite::driver('github')->redirect();
    }
    public function githubAuthentication()
    {
        try {
            $githubUser = Socialite::driver('github')->user();


            $user = User::where('github_id', $githubUser->id)->first();

            if ($user) {

                Auth::login($user);
                return redirect()->route('admin.user.dashboard');
            } else {
                $uData = User::create([
                    'username' => $githubUser->name,
                    'email' => $githubUser->email,
                    'password' => Hash::make('quize@1234'),
                    'github_id' => $githubUser->id,
                ]);
                Auth::login($uData);
                return redirect()->route('admin.user.dashboard');
            }
        } catch (Exception $e) {

            Log::error('GitHub authentication error: ' . $e->getMessage());
            return redirect()->route('login')->with('error', 'GitHub authentication failed. Please try again.');
        }
    }

    // login option using google 

    public function googleLogin()
    {
        return Socialite::driver('google')->redirect();
    }
    public function googleAuthentication()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            $user = User::where('google_id', $googleUser->id)->first();

            if ($user) {
                Auth::login($user);
                return redirect()->route('admin.user.dashboard');
            } else {
                $userData = User::create([
                    'username' => $googleUser->name,
                    'email' => $googleUser->email,
                    'password' => Hash::make('quize@1234'),
                    'google_id' => $googleUser->id,
                ]);
                Auth::login($userData);
                return redirect()->route('admin.user.dashboard');
            }
        } catch (Exception $e) {
            // Log the exception details
            Log::error('Google authentication error: ' . $e->getMessage());
            dd($e); // or return an error message
        }
    }

    // login option with github

    public function logout(Request $request)
    {

        // logout user
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // redirect to initial page or home
        return redirect('/');
    }
}
