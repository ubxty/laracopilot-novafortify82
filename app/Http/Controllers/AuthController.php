<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'pin' => 'required|digits:6',
            'laracon_uuid' => 'required|string|unique:users,laracon_uuid'
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'pin' => Hash::make($validated['pin']),
            'laracon_uuid' => $validated['laracon_uuid']
        ]);

        session([
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_email' => $user->email,
            'user_logged_in' => true
        ]);

        return redirect()->route('dashboard');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $loginType = $request->input('login_type', 'email');

        if ($loginType === 'qr') {
            // QR Code Login with UUID and PIN
            $validated = $request->validate([
                'laracon_uuid' => 'required|string',
                'pin' => 'required|digits:6'
            ]);

            $user = User::where('laracon_uuid', $validated['laracon_uuid'])->first();

            if (!$user) {
                return back()->with('error', 'QR code not found in our system. Please register first or use email login.');
            }

            if (!Hash::check($validated['pin'], $user->pin)) {
                return back()->with('error', 'Incorrect PIN. Please try again.');
            }

            session([
                'user_id' => $user->id,
                'user_name' => $user->name,
                'user_email' => $user->email,
                'user_logged_in' => true
            ]);

            return redirect()->route('dashboard');
        } else {
            // Traditional Email and PIN Login
            $validated = $request->validate([
                'email' => 'required|email',
                'pin' => 'required|digits:6'
            ]);

            $user = User::where('email', $validated['email'])->first();

            if (!$user) {
                return back()->with('error', 'Email not found. Please check your email or register.');
            }

            if (!Hash::check($validated['pin'], $user->pin)) {
                return back()->with('error', 'Incorrect PIN. Please try again.');
            }

            session([
                'user_id' => $user->id,
                'user_name' => $user->name,
                'user_email' => $user->email,
                'user_logged_in' => true
            ]);

            return redirect()->route('dashboard');
        }
    }

    public function logout()
    {
        session()->forget(['user_id', 'user_name', 'user_email', 'user_logged_in']);
        return redirect()->route('home');
    }
}