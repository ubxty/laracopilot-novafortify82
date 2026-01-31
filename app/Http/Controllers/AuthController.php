<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
            'password' => 'required|min:8|confirmed',
            'github_username' => 'nullable|string|max:255',
            'qr_code' => 'required|string|max:255'
        ]);

        // Validate QR code (in production, this would verify against Laracon database)
        $validQrCodes = ['LARACON2024', 'LARACON-VIP', 'LARACON-SPEAKER', 'LARACON-ATTENDEE'];
        if (!in_array(strtoupper($validated['qr_code']), $validQrCodes)) {
            return back()->withErrors(['qr_code' => 'Invalid Laracon QR code'])->withInput();
        }

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'github_username' => $validated['github_username'] ?? null,
            'qr_code_verified' => true
        ]);

        session([
            'user_logged_in' => true,
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_email' => $user->email
        ]);

        return redirect()->route('dashboard')->with('success', 'Welcome to Laravel Community! 🎉');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
        }

        session([
            'user_logged_in' => true,
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_email' => $user->email
        ]);

        return redirect()->route('dashboard')->with('success', 'Welcome back!');
    }

    public function logout()
    {
        session()->forget(['user_logged_in', 'user_id', 'user_name', 'user_email']);
        return redirect()->route('home')->with('success', 'Logged out successfully');
    }

    public function dashboard()
    {
        if (!session('user_logged_in')) {
            return redirect()->route('login');
        }

        $userId = session('user_id');
        $user = User::find($userId);
        $projectsCount = Project::where('user_id', $userId)->count();
        $recentProjects = Project::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('dashboard', compact('user', 'projectsCount', 'recentProjects'));
    }
}