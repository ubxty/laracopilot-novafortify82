<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validate request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'pin' => 'required|digits:6',
            'laracon_uuid' => 'nullable|string|unique:users,laracon_uuid'
        ]);

        // Create user
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make('default_password_' . time()),
            'pin' => Hash::make($validated['pin']),
            'laracon_uuid' => $validated['laracon_uuid'] ?? null
        ]);

        // Log the user in
        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Welcome to Laravel Community! 🎉');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.'
        ])->onlyInput('email');
    }

    public function checkQR(Request $request)
    {
        $request->validate([
            'laracon_uuid' => 'required|string'
        ]);

        $user = User::where('laracon_uuid', $request->laracon_uuid)->first();

        return response()->json([
            'exists' => $user !== null,
            'name' => $user ? $user->name : null
        ]);
    }

    public function loginWithQR(Request $request)
    {
        $request->validate([
            'laracon_uuid' => 'required|string',
            'pin' => 'required|digits:6'
        ]);

        $user = User::where('laracon_uuid', $request->laracon_uuid)->first();

        if (!$user) {
            return back()->withErrors(['pin' => 'User not found']);
        }

        if (!Hash::check($request->pin, $user->pin)) {
            return back()->withErrors(['pin' => 'Invalid PIN']);
        }

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('dashboard')->with('success', 'Welcome back, ' . $user->name . '! 👋');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('home');
    }
}