<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials do not match our records.'],
            ]);
        }

        // Check if user was registered via QR code (has uuid but password might not be set yet)
        if ($user->uuid && !$user->password) {
            throw ValidationException::withMessages([
                'email' => ['Please set your password first. Check your email for instructions.'],
            ]);
        }

        // Attempt authentication with email and password
        if (!Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials do not match our records.'],
            ]);
        }

        // Log the user in
        Auth::login($user, $request->boolean('remember'));

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard'));
    }

    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user);

        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function showQrLogin($uuid)
    {
        $user = User::where('uuid', $uuid)->first();

        if (!$user) {
            abort(404, 'Invalid QR code');
        }

        // Auto-login user who scanned QR code
        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Welcome back, ' . $user->name . '!');
    }

    public function showSetPassword($uuid)
    {
        $user = User::where('uuid', $uuid)->first();

        if (!$user) {
            abort(404, 'Invalid link');
        }

        return view('auth.set-password', compact('user'));
    }

    public function setPassword(Request $request, $uuid)
    {
        $user = User::where('uuid', $uuid)->first();

        if (!$user) {
            abort(404, 'Invalid link');
        }

        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Password set successfully!');
    }
}