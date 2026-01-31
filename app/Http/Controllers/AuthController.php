<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        // Handle QR code login
        if ($request->has('laracon_login') && $request->laracon_login) {
            try {
                $qrData = json_decode($request->qr_code, true);
                
                if (!$qrData || !isset($qrData['uuid'])) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Invalid QR code format'
                    ], 400);
                }
                
                // Check if user exists with this UUID
                $user = User::where('laracon_uuid', $qrData['uuid'])->first();
                
                if (!$user) {
                    // First time scanning - prompt for registration
                    return response()->json([
                        'success' => false,
                        'action' => 'register',
                        'message' => 'First time scanning badge. Please set up your account.',
                        'uuid' => $qrData['uuid'],
                        'name' => $qrData['name'] ?? 'User'
                    ], 404);
                }
                
                // User exists - check if PIN provided
                if (!$request->has('pin')) {
                    return response()->json([
                        'success' => false,
                        'action' => 'enter_pin',
                        'message' => 'Please enter your 6-digit PIN',
                        'uuid' => $qrData['uuid'],
                        'name' => $user->name,
                        'email' => $user->email
                    ], 200);
                }
                
                // Verify PIN
                if (!Hash::check($request->pin, $user->password)) {
                    return response()->json([
                        'success' => false,
                        'action' => 'enter_pin',
                        'message' => 'Incorrect PIN. Please try again.',
                        'uuid' => $qrData['uuid'],
                        'name' => $user->name,
                        'email' => $user->email
                    ], 401);
                }
                
                // PIN correct - login
                session([
                    'user_logged_in' => true,
                    'user_id' => $user->id,
                    'user_name' => $user->name,
                    'user_email' => $user->email
                ]);
                
                return response()->json([
                    'success' => true,
                    'message' => 'Login successful',
                    'redirect' => route('dashboard')
                ]);
                
            } catch (\Exception $e) {
                Log::error('QR Login Error: ' . $e->getMessage());
                return response()->json([
                    'success' => false,
                    'message' => 'Error processing QR code',
                    'error' => $e->getMessage()
                ], 500);
            }
        }
        
        // Handle manual login
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6'
        ]);
        
        $user = User::where('email', $validated['email'])->first();
        
        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return back()->withErrors([
                'email' => 'Invalid credentials. Please check your email and PIN.'
            ])->withInput();
        }
        
        session([
            'user_logged_in' => true,
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_email' => $user->email
        ]);
        
        return redirect()->route('dashboard');
    }

    public function register(Request $request)
    {
        // Handle QR code registration (first-time setup)
        if ($request->has('laracon_register') && $request->laracon_register) {
            try {
                $qrData = json_decode($request->qr_code, true);
                
                if (!$qrData || !isset($qrData['uuid'])) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Invalid QR code format. Missing UUID.'
                    ], 400);
                }
                
                // Check if UUID already registered
                $existingUser = User::where('laracon_uuid', $qrData['uuid'])->first();
                if ($existingUser) {
                    return response()->json([
                        'success' => false,
                        'message' => 'This badge is already registered. Please use login instead.'
                    ], 409);
                }
                
                // Validate email and PIN from request
                if (!$request->has('email') || !$request->has('pin')) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Email and PIN are required for registration.'
                    ], 400);
                }
                
                // Check if email already exists
                $emailExists = User::where('email', $request->email)->first();
                if ($emailExists) {
                    return response()->json([
                        'success' => false,
                        'message' => 'This email is already registered. Please use a different email.'
                    ], 409);
                }
                
                // Validate PIN format (6 digits)
                if (!preg_match('/^\d{6}$/', $request->pin)) {
                    return response()->json([
                        'success' => false,
                        'message' => 'PIN must be exactly 6 digits.'
                    ], 400);
                }
                
                // Create user
                $user = User::create([
                    'name' => $qrData['name'] ?? 'Laracon Attendee',
                    'email' => $request->email,
                    'password' => Hash::make($request->pin),
                    'laracon_uuid' => $qrData['uuid']
                ]);
                
                // Auto-login after registration
                session([
                    'user_logged_in' => true,
                    'user_id' => $user->id,
                    'user_name' => $user->name,
                    'user_email' => $user->email
                ]);
                
                return response()->json([
                    'success' => true,
                    'message' => 'Registration successful',
                    'redirect' => route('dashboard')
                ]);
                
            } catch (\Exception $e) {
                Log::error('QR Registration Error: ' . $e->getMessage());
                Log::error('Stack trace: ' . $e->getTraceAsString());
                return response()->json([
                    'success' => false,
                    'message' => 'Error processing registration',
                    'error' => $e->getMessage()
                ], 500);
            }
        }
        
        // Handle manual registration
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed'
        ]);
        
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password'])
        ]);
        
        session([
            'user_logged_in' => true,
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_email' => $user->email
        ]);
        
        return redirect()->route('dashboard');
    }

    public function logout()
    {
        session()->forget(['user_logged_in', 'user_id', 'user_name', 'user_email']);
        return redirect()->route('home');
    }
}