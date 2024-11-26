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
    // register 
    public function register(Request $request)
    {

        // validate
        $fields = $request->validate([

            'username' => ['required', 'max:255', 'string', 'regex:/^[A-Za-z\s]+$/'],
            'email' => ['required', 'max:255', 'email', 'unique:users'],
            'password' => ['required', 'min:4', 'confirmed'],

        ]);
        // register
        $user = User::create($fields);
        // login
        Auth::login($user);
        // redirect
        return redirect()->route('home');
    }
    public function login(Request $request)
    {
        $fields = $request->validate([

            'email' => ['required', 'max:255', 'email'],
            'password' => ['required'],

        ]);

        if (Auth::attempt($fields, $request->remember)) {
            return  redirect()->intended();
        } else {
            return back()->withErrors(['failed' => 'The provided creditials do not match our record']);
        }
    }

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
                return redirect()->route('dashboard');
            } else {
                $uData = User::create([
                    'username' => $githubUser->name,
                    'email' => $githubUser->email,
                    'password' => Hash::make('quize@1234'),
                    'github_id' => $githubUser->id,
                ]);
                Auth::login($uData);
                return redirect()->route('dashboard');
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
                return redirect()->route('dashboard');
            } else {
                $userData = User::create([
                    'username' => $googleUser->name,
                    'email' => $googleUser->email,
                    'password' => Hash::make('quize@1234'),
                    'google_id' => $googleUser->id,
                ]);
                Auth::login($userData);
                return redirect()->route('dashboard');
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
