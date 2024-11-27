<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class userController extends Controller
{
    //all crude logic implementations CRUD
    public function loadAllUser()
    {
        $all_user = User::all();
        return view('admin.user.index');
    }
    public function addUserForm()
    {
        return view('admin.user.create');
    }
    public function AddUser(Request $request)
    {
        // Validation
        $request->validate([
            'username' => ['required', 'max:255', 'string', 'regex:/^[A-Za-z\s]+$/'], // Customize regex as needed
            'email' => ['required', 'max:255', 'email', 'unique:users,email'],
            'password' => ['required', 'min:4', 'confirmed'], // 'confirmed' automatically checks password_confirmation field
        ]);

        try {
            // Create a new user
            $new_user = new User;
            $new_user->username = $request->username;
            $new_user->email = $request->email;
            $new_user->password = Hash::make($request->password); // Hash password
            $new_user->save(); // Save the user to the database

            // Redirect with success message
            return redirect()->route('admin.user.index')->with('success', 'User registered successfully');
        } catch (\Exception $e) {
            // Redirect with error message
            return redirect()->route('admin.user.create')->with('failed', $e->getMessage());
        }
    }
}
