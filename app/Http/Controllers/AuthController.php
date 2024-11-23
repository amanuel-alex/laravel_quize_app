<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use PhpParser\Node\Stmt\TryCatch;
use Psy\Readline\Userland;

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

    // login option using google facebook and github

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
                // User exists, log them in
                Auth::login($user);
                return redirect()->route('users.dashboard');
            } else {
                $userData = User::create([
                    'username' => $googleUser->name,
                    'email' => $googleUser->email,
                    'password' => Hash::make('quize@1234'),
                    'google_id' => $googleUser->id,
                ]);
                Auth::login($userData);
                return redirect()->route('users.dashboard');
            }
        } catch (Exception $e) {
            dd($e);
        }
    }



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
