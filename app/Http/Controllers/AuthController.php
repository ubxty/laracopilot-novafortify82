<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

class AuthController extends Controller
{
    private function ensureLogFileExists()
    {
        $logPath = storage_path('logs/auth.log');
        
        if (!File::exists($logPath)) {
            File::put($logPath, '');
            try {
                chmod($logPath, 0666);
            } catch (\Exception $e) {
                // Permission setting may fail, but file exists
            }
        }
    }

    private function logAuth($level, $message, $context = [])
    {
        $this->ensureLogFileExists();
        
        try {
            Log::channel('userauthlogs')->{$level}($message, $context);
        } catch (\Exception $e) {
            error_log("Failed to write auth log: " . $e->getMessage());
        }
    }

    public function showRegister()
    {
        $this->logAuth('info', '=== SHOW REGISTER PAGE ===', [
            'step' => '1. User accessed registration page',
            'ip' => request()->ip(),
            'url' => request()->fullUrl(),
            'method' => request()->method(),
            'is_secure' => request()->secure(),
            'scheme' => request()->getScheme(),
            'host' => request()->getHost(),
            'user_agent' => request()->userAgent(),
            'already_authenticated' => Auth::check(),
            'session_id' => session()->getId(),
            'timestamp' => now()->toDateTimeString()
        ]);

        if (Auth::check()) {
            $this->logAuth('info', 'Registration page: User already authenticated, redirecting', [
                'user_id' => Auth::id(),
                'user_email' => Auth::user()->email
            ]);
            return redirect()->route('dashboard');
        }

        $this->logAuth('info', 'Registration page: Displaying form');
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $this->logAuth('info', '=== REGISTRATION FORM SUBMISSION RECEIVED ===', [
            'step' => '2A. POST request received',
            'ip' => $request->ip(),
            'url' => $request->fullUrl(),
            'method' => $request->method(),
            'is_secure' => $request->secure(),
            'scheme' => $request->getScheme(),
            'content_type' => $request->header('Content-Type'),
            'user_agent' => $request->userAgent(),
            'session_id' => session()->getId(),
            'has_csrf' => $request->hasHeader('X-CSRF-TOKEN') || $request->has('_token'),
            'csrf_token_length' => $request->has('_token') ? strlen($request->input('_token')) : 0,
            'all_input_keys' => array_keys($request->all()),
            'timestamp' => now()->toDateTimeString()
        ]);

        $this->logAuth('info', '=== STEP 2B: Extracting Form Data ===', [
            'request_data' => [
                'name' => $request->name,
                'name_length' => $request->name ? strlen($request->name) : 0,
                'email' => $request->email,
                'email_length' => $request->email ? strlen($request->email) : 0,
                'has_pin' => !empty($request->pin),
                'pin_length' => $request->pin ? strlen($request->pin) : 0,
                'pin_is_numeric' => $request->pin ? ctype_digit($request->pin) : false,
                'has_laracon_uuid' => !empty($request->laracon_uuid),
                'laracon_uuid' => $request->laracon_uuid,
                'laracon_uuid_length' => $request->laracon_uuid ? strlen($request->laracon_uuid) : 0
            ]
        ]);

        $this->logAuth('info', '=== STEP 3: Starting Validation ===', [
            'fields_to_validate' => ['name', 'email', 'pin', 'laracon_uuid'],
            'validation_rules' => [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'pin' => 'required|digits:6',
                'laracon_uuid' => 'nullable|string|unique:users,laracon_uuid'
            ]
        ]);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'pin' => 'required|digits:6',
            'laracon_uuid' => 'nullable|string|unique:users,laracon_uuid'
        ]);

        if ($validator->fails()) {
            $this->logAuth('error', '=== STEP 3: VALIDATION FAILED ===', [
                'errors' => $validator->errors()->toArray(),
                'failed_rules' => $validator->failed(),
                'email_attempted' => $request->email,
                'all_input' => $request->except(['pin', '_token'])
            ]);
            
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->except(['pin']))
                ->with('error', 'Validation failed: ' . implode(', ', $validator->errors()->all()));
        }

        $this->logAuth('info', '=== STEP 3: Validation Passed ✓ ===');

        try {
            $this->logAuth('info', '=== STEP 4A: Preparing to Create User ===', [
                'name' => $request->name,
                'email' => $request->email,
                'pin_will_be_stored_as' => 'password (hashed)',
                'note' => 'PIN is stored in password field as 6-digit numeric password'
            ]);

            $hashedPassword = Hash::make($request->pin);

            $this->logAuth('info', '=== STEP 4B: PIN Hashed Successfully ===', [
                'password_hash_length' => strlen($hashedPassword),
                'original_pin_length' => strlen($request->pin)
            ]);

            $this->logAuth('info', '=== STEP 4C: Executing User::create() ===', [
                'data' => [
                    'name' => $request->name,
                    'email' => $request->email,
                    'has_laracon_uuid' => !empty($request->laracon_uuid),
                    'password_field' => 'Using PIN as password'
                ]
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $hashedPassword,
                'laracon_uuid' => $request->laracon_uuid
            ]);

            $this->logAuth('info', '=== STEP 4D: User Created in Database ✓ ===', [
                'user_id' => $user->id,
                'email' => $user->email,
                'name' => $user->name,
                'has_laracon_uuid' => !empty($user->laracon_uuid),
                'created_at' => $user->created_at->toDateTimeString()
            ]);

            $this->logAuth('info', '=== STEP 5A: Attempting to Login User ===', [
                'user_id' => $user->id,
                'before_auth_check' => Auth::check(),
                'before_auth_id' => Auth::id(),
                'login_method' => 'Auth::login()'
            ]);

            Auth::login($user);
            
            $this->logAuth('info', '=== STEP 5B: Auth::login() Executed ===', [
                'user_id' => $user->id,
                'after_auth_check' => Auth::check(),
                'after_auth_id' => Auth::id(),
                'auth_user_email' => Auth::check() ? Auth::user()->email : null
            ]);

            if (!Auth::check()) {
                $this->logAuth('error', '=== STEP 5C: AUTH CHECK FAILED AFTER LOGIN ===', [
                    'user_id' => $user->id,
                    'auth_check' => Auth::check(),
                    'session_id' => session()->getId(),
                    'session_data' => session()->all()
                ]);
                throw new \Exception('Authentication failed after login attempt');
            }

            $this->logAuth('info', '=== STEP 5C: Login Successful ✓ ===', [
                'user_id' => Auth::id(),
                'session_id_before' => session()->getId()
            ]);

            $this->logAuth('info', '=== STEP 6A: Regenerating Session ===', [
                'old_session_id' => session()->getId()
            ]);

            $request->session()->regenerate();

            $this->logAuth('info', '=== STEP 6B: Session Regenerated ✓ ===', [
                'new_session_id' => session()->getId(),
                'auth_still_valid' => Auth::check(),
                'current_user_id' => Auth::id(),
                'session_driver' => config('session.driver')
            ]);

            $successMessage = 'Welcome to Laravel Community, ' . $user->name . '!';
            session()->flash('success', $successMessage);

            $this->logAuth('info', '=== STEP 7: Preparing Redirect ===', [
                'user_id' => $user->id,
                'redirect_route' => 'dashboard',
                'redirect_url' => route('dashboard'),
                'session_has_success' => session()->has('success'),
                'success_message' => $successMessage
            ]);

            $this->logAuth('info', '=== REGISTRATION COMPLETED SUCCESSFULLY ✓ ===', [
                'user_id' => $user->id,
                'email' => $user->email,
                'name' => $user->name,
                'redirecting_to' => route('dashboard'),
                'final_auth_check' => Auth::check(),
                'timestamp' => now()->toDateTimeString()
            ]);

            return redirect()->route('dashboard');

        } catch (\Exception $e) {
            $this->logAuth('error', '=== REGISTRATION EXCEPTION ===', [
                'error_message' => $e->getMessage(),
                'error_file' => $e->getFile(),
                'error_line' => $e->getLine(),
                'stack_trace' => $e->getTraceAsString(),
                'request_data' => [
                    'name' => $request->name,
                    'email' => $request->email
                ]
            ]);
            
            return redirect()->back()
                ->withInput($request->except(['pin']))
                ->with('error', 'Registration failed: ' . $e->getMessage());
        }
    }

    public function showLogin()
    {
        $this->logAuth('info', '=== SHOW LOGIN PAGE ===', [
            'step' => '1. User accessed login page',
            'ip' => request()->ip(),
            'url' => request()->fullUrl(),
            'is_secure' => request()->secure(),
            'user_agent' => request()->userAgent(),
            'already_authenticated' => Auth::check(),
            'session_id' => session()->getId(),
            'timestamp' => now()->toDateTimeString()
        ]);

        if (Auth::check()) {
            $this->logAuth('info', 'Login page: User already authenticated, redirecting', [
                'user_id' => Auth::id(),
                'user_email' => Auth::user()->email
            ]);
            return redirect()->route('dashboard');
        }

        $this->logAuth('info', 'Login page: Displaying form');
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->logAuth('info', '=== LOGIN ATTEMPT STARTED ===', [
            'step' => '2. Login form submitted',
            'ip' => $request->ip(),
            'url' => $request->fullUrl(),
            'email' => $request->email,
            'has_password' => !empty($request->password),
            'password_length' => $request->password ? strlen($request->password) : 0,
            'password_is_numeric' => $request->password ? ctype_digit($request->password) : false,
            'remember_me' => $request->has('remember'),
            'session_id' => session()->getId(),
            'timestamp' => now()->toDateTimeString()
        ]);

        $this->logAuth('info', 'Step 3: Validating login credentials');

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            $this->logAuth('warning', 'Step 3: Login validation failed', [
                'errors' => $validator->errors()->toArray()
            ]);
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $this->logAuth('info', 'Step 3: Validation passed ✓');

        $this->logAuth('info', 'Step 4: Checking if user exists in database', [
            'email' => $request->email
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            $this->logAuth('warning', 'Step 4: User not found', [
                'email' => $request->email
            ]);
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->withInput();
        }

        $this->logAuth('info', 'Step 4: User found ✓', [
            'user_id' => $user->id,
            'user_name' => $user->name
        ]);

        $this->logAuth('info', 'Step 5: Attempting authentication', [
            'user_id' => $user->id,
            'email' => $request->email,
            'note' => 'Using password field (which contains hashed 6-digit PIN)'
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            $this->logAuth('info', 'Step 5: Authentication successful ✓', [
                'user_id' => Auth::id(),
                'auth_check' => Auth::check()
            ]);

            $this->logAuth('info', 'Step 6: Regenerating session');
            $request->session()->regenerate();

            $this->logAuth('info', 'Step 6: Session regenerated ✓', [
                'new_session_id' => session()->getId()
            ]);

            $this->logAuth('info', '=== LOGIN COMPLETED SUCCESSFULLY ===', [
                'user_id' => Auth::id(),
                'email' => Auth::user()->email,
                'redirecting_to' => route('dashboard')
            ]);

            return redirect()->intended(route('dashboard'));
        }

        $this->logAuth('warning', '=== LOGIN FAILED ===', [
            'reason' => 'Invalid PIN/password',
            'email' => $request->email,
            'user_id' => $user->id
        ]);

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput();
    }

    public function checkQr(Request $request)
    {
        $this->logAuth('info', 'QR Check: Checking if UUID exists', [
            'uuid' => $request->uuid
        ]);

        $validator = Validator::make($request->all(), [
            'uuid' => 'required|string'
        ]);

        if ($validator->fails()) {
            $this->logAuth('warning', 'QR Check: Invalid UUID format');
            return response()->json([
                'success' => false,
                'message' => 'Invalid UUID'
            ], 422);
        }

        $user = User::where('laracon_uuid', $request->uuid)->first();

        if ($user) {
            $this->logAuth('info', 'QR Check: User found', [
                'user_id' => $user->id,
                'name' => $user->name
            ]);
            return response()->json([
                'success' => true,
                'exists' => true,
                'name' => $user->name
            ]);
        }

        $this->logAuth('info', 'QR Check: User not found, new registration');
        return response()->json([
            'success' => true,
            'exists' => false
        ]);
    }

    public function loginQr(Request $request)
    {
        $this->logAuth('info', '=== QR LOGIN ATTEMPT ===', [
            'uuid' => $request->uuid,
            'has_pin' => !empty($request->pin)
        ]);

        $validator = Validator::make($request->all(), [
            'uuid' => 'required|string',
            'pin' => 'required|digits:6'
        ]);

        if ($validator->fails()) {
            $this->logAuth('warning', 'QR Login: Validation failed');
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials'
            ], 422);
        }

        $user = User::where('laracon_uuid', $request->uuid)->first();

        if (!$user) {
            $this->logAuth('warning', 'QR Login: User not found', [
                'uuid' => $request->uuid
            ]);
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 404);
        }

        if (!Hash::check($request->pin, $user->password)) {
            $this->logAuth('warning', 'QR Login: Invalid PIN', [
                'user_id' => $user->id
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Invalid PIN'
            ], 401);
        }

        Auth::login($user);
        $request->session()->regenerate();

        $this->logAuth('info', '=== QR LOGIN SUCCESSFUL ===', [
            'user_id' => $user->id,
            'email' => $user->email
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Login successful',
            'redirect' => route('dashboard')
        ]);
    }

    public function logout(Request $request)
    {
        $userId = Auth::id();
        $userEmail = Auth::user()->email ?? 'unknown';

        $this->logAuth('info', '=== LOGOUT INITIATED ===', [
            'user_id' => $userId,
            'email' => $userEmail,
            'ip' => $request->ip()
        ]);

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $this->logAuth('info', '=== LOGOUT COMPLETED ===', [
            'former_user_id' => $userId
        ]);

        return redirect()->route('login')->with('success', 'Logged out successfully');
    }
}