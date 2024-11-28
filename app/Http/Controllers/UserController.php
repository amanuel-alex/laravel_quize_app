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
        return view('admin.user.index', compact('all_user'));
    }
    public function addUserForm()
    {
        return view('admin.user.create');
    }
    public function AddUser(Request $request)
    {

        // Validation
        $request->validate([
            'username' => ['required', 'max:255', 'string', 'regex:/^[A-Za-z\s]+$/'],
            'email' => ['required', 'max:255', 'email', 'unique:users,email'],
            'password' => ['required', 'min:4', 'confirmed'],
        ]);

        try {
            // Create a new user
            $new_user = new User;
            $new_user->username = $request->username;
            $new_user->email = $request->email;
            $new_user->password = Hash::make($request->password);
            $new_user->save(); // Save the user to the database

            // Redirect with success message
            return redirect('admin.user.index')->with('success', 'User registered successfully');
        } catch (\Exception $e) {
            // Redirect with error message
            return redirect('admin.user.create')->with('failed', $e->getMessage());
        }
    }
    public function update(Request $request)
    {

        // Validation
        $request->validate([
            'username' => ['required', 'max:255', 'string', 'regex:/^[A-Za-z\s]+$/'],
            'email' => ['required', 'max:255', 'email', 'unique:users,email'],
            'password' => ['required', 'min:4', 'confirmed'],
        ]);

        try {
            // update a new user
            $update_user = User::where('id', $request->user_id)->update(
                [
                    'username' => $request->username,
                    'email' => $request->email,
                    'email' => $request->email,

                ]
            );

            // Redirect with success message
            return redirect('admin.user.index')->with('success', 'User updated successfully');
        } catch (\Exception $e) {
            // Redirect with error message
            return redirect('admin.user.create')->with('failed', $e->getMessage());
        }
    }
    public function editUserForm($id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('user_detail')->with('error', 'User not found');
        }

        return view('admin.user.edit', compact('user'));
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user_detail')->with('success', 'User deleted successfully!');
    }
}
