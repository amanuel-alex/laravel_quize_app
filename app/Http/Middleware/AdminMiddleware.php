<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Ensure this import is included

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated and has the 'admin' role
        if (Auth::check() && Auth::user() && Auth::user()->role === 'admin') {
            // If the user is an admin, allow the request to proceed
            return $next($request);
        }

        // Redirect to the user dashboard if not an admin
        return redirect()->route('user.dashboard');
    }
}
