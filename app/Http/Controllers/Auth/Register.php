<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Register extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create a new user
        $user = \App\Models\User::create([
            'name' => $validated['name'], 
            'email' => $validated['email'], 
            'password' => Hash::make($validated['password']),
        ]);

        // Log the user in
        Auth::login($user);
        $request->session()->regenerate();
        // Redirect to the dashboard or any other page
        return redirect()->route('dashboard'); 
    }
}
