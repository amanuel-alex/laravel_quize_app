<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');  // Show the admin dashboard
    }

    public function create()
    {
        return view('admin.create');  // Show the form to create an admin resource
    }

    // Other methods like store(), show(), edit(), update(), destroy()
}
