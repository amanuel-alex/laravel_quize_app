<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // register users
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
