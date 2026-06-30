<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class Login extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $key = Str::lower($request->email).'|'.$request->ip();

        if (RateLimiter::tooManyAttempts($key, 5)) {
            throw ValidationException::withMessages([
            'email' => 'Too many login attempts. Please try again in 1 minute.',
            ]);
        }

        if (Auth::attempt($validated, $request->boolean('remember'))) {
            RateLimiter::clear($key);
            $request->session()->regenerate();
            return redirect()->route('dashboard'); 
        }

        RateLimiter::hit($key, 20); 
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->OnlyInput('email');
    }
}
