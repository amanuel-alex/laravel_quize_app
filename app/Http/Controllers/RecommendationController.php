<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RecommendationController extends Controller
{
    public function index()
    {
        // View for sending recommendations
        return view('admin.recommendations.index');
    }

    public function send(Request $request)
    {
        // Send recommendation message to users
        $request->validate([
            'message' => 'required|string',
            'user_id' => 'required|exists:users,id',
        ]);

        $user = User::find($request->user_id);
        Mail::to($user->email)->send(new \App\Mail\RecommendationMail($request->message));

        return redirect()->route('admin.recommendations.index')->with('success', 'Recommendation sent!');
    }
}
