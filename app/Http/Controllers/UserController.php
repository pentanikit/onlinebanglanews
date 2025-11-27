<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
        /**
     * Handle a login request.
     */
    public function login(Request $request)
    {
        // Validate email & password
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        // Remember me (optional)
        $remember = $request->boolean('remember');

        // Try to log the user in
        if (Auth::attempt($credentials, $remember)) {
            // Regenerate session to prevent fixation
            $request->session()->regenerate();

            return redirect()->intended('/admin/dashboard')
                ->with('success', 'Welcome back!');
        }

        // Login failed
        return back()
            ->withErrors([
                'email' => 'These credentials do not match our records.',
            ])
            ->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidate session & regenerate CSRF token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'You have been logged out.');
    }
}
