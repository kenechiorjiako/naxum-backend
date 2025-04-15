<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    /**
     * Show the admin login form.
     */
    public function showLogin()
    {
        return view('auth.login'); // Assuming the same view is used
    }

    /**
     * Handle an admin login attempt.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to authenticate the user using the 'web' guard implicitly
        if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            // Get the authenticated user
            $user = Auth::user();

            // Check if the user is an admin
            if ($user->isAdmin) {
                // Regenerate session to prevent session fixation
                $request->session()->regenerate();
                return redirect()->intended('dashboard'); // Redirect to intended page or dashboard
            }

            // If user is not an admin, log them out and return error
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return back()->withErrors([
                'email' => 'You do not have admin privileges.',
            ])->onlyInput('email');
        }

        // If authentication fails
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    // Note: The web logout logic will remain in the original AuthController for now, as per web.php
}
