<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (session('user_logged_in')) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            session([
                'user_logged_in' => true,
                'user_id' => $user->id,
                'user_name' => $user->name,
                'user_full_name' => $user->full_name ?? $user->name,
                'user_email' => $user->email,
                'user_role' => $user->role
            ]);
            
            // Redirect based on role
            if ($user->isAdmin()) {
                return redirect()->route('admin.dashboard');
            }
            
            return redirect()->route('dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }

    public function showRegister()
    {
        if (session('user_logged_in')) {
            return redirect()->route('dashboard');
        }
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed'
        ]);

        $user = User::create([
            'name' => $request->name,
            'full_name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user'
        ]);

        session([
            'user_logged_in' => true,
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_full_name' => $user->full_name,
            'user_email' => $user->email,
            'user_role' => $user->role
        ]);

        return redirect()->route('dashboard')->with('success', 'Account created successfully!');
    }

    public function showQrRegister()
    {
        if (session('user_logged_in')) {
            return redirect()->route('dashboard');
        }
        return view('auth.qr-register');
    }

    public function verifyQr(Request $request)
    {
        $request->validate([
            'qr_data' => 'required|string'
        ]);

        try {
            $qrData = json_decode($request->qr_data, true);

            if (!isset($qrData['uuid']) || !isset($qrData['name'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid QR code format'
                ], 422);
            }

            // Check if UUID already exists in laracon_uuid field
            $existingUser = User::where('laracon_uuid', $qrData['uuid'])->first();
            if ($existingUser) {
                return response()->json([
                    'success' => false,
                    'message' => 'This QR code has already been registered'
                ], 422);
            }

            // Store QR data in session for next step
            session([
                'qr_uuid' => $qrData['uuid'],
                'qr_name' => $qrData['name']
            ]);

            return response()->json([
                'success' => true,
                'name' => $qrData['name']
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to parse QR code data'
            ], 422);
        }
    }

    public function completeQrRegistration(Request $request)
    {
        // Verify QR session data exists
        if (!session('qr_uuid') || !session('qr_name')) {
            return back()->withErrors(['error' => 'QR session expired. Please scan again.']);
        }

        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed'
        ]);

        $user = User::create([
            'name' => session('qr_name'),
            'full_name' => session('qr_name'),
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'laracon_uuid' => session('qr_uuid'),
            'role' => 'user'
        ]);

        // Clear QR session data
        session()->forget(['qr_uuid', 'qr_name']);

        // Auto login
        session([
            'user_logged_in' => true,
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_full_name' => $user->full_name,
            'user_email' => $user->email,
            'user_role' => $user->role
        ]);

        return redirect()->route('dashboard')->with('success', 'Welcome! Your account has been created successfully.');
    }

    public function logout()
    {
        session()->flush();
        return redirect()->route('home');
    }
}