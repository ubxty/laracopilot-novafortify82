<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        if (session('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = [
            ['email' => 'admin@laravelcommunity.com', 'password' => 'admin123', 'name' => 'Admin User', 'role' => 'Administrator'],
            ['email' => 'manager@laravelcommunity.com', 'password' => 'manager123', 'name' => 'Project Manager', 'role' => 'Manager'],
            ['email' => 'moderator@laravelcommunity.com', 'password' => 'moderator123', 'name' => 'Community Moderator', 'role' => 'Moderator']
        ];

        $email = $request->input('email');
        $password = $request->input('password');

        foreach ($credentials as $user) {
            if ($user['email'] === $email && $user['password'] === $password) {
                session([
                    'admin_logged_in' => true,
                    'admin_user' => $user
                ]);
                return redirect()->route('admin.dashboard');
            }
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function logout()
    {
        session()->forget(['admin_logged_in', 'admin_user']);
        return redirect()->route('admin.login');
    }
}