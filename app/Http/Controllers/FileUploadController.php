<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
{
    public function index()
    {
        return view('admin.upload.index');
    }

    public function store(Request $request)
    {
        // Validate file upload
        $request->validate([
            'file' => 'required|file|max:10240', // max size of 10MB
        ]);

        $path = $request->file('file')->store('uploads', 'public');

        return redirect()->route('admin.upload.index')->with('success', 'File uploaded successfully!');
    }
}
