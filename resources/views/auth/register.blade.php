<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Laravel Community</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/html5-qrcode"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-gradient-to-br from-red-500 via-pink-500 to-purple-600 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full">
        <!-- Error Message -->
        @if(session('error'))
            <div class="mb-4 bg-red-600 text-white p-4 rounded-lg shadow-lg">
                <div class="flex items-start">
                    <svg class="w-6 h-6 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <p class="font-semibold">Registration Error!</p>
                        <p class="text-sm">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if($errors->any())
            <div class="mb-4 bg-red-600 text-white p-4 rounded-lg shadow-lg">
                <div class="flex items-start">
                    <svg class="w-6 h-6 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <p class="font-semibold">Validation Errors:</p>
                        <ul class="text-sm mt-1 space-y-1">
                            @foreach($errors->all() as $error)
                                <li>• {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <!-- Success Message -->
        @if(session('success'))
            <div class="mb-4 bg-green-600 text-white p-4 rounded-lg shadow-lg">
                <div class="flex items-start">
                    <svg class="w-6 h-6 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <p class="font-semibold">Success!</p>
                        <p class="text-sm">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Auth Status Debug -->
        @auth
            <div class="mb-4 bg-green-900 text-white p-4 rounded-lg shadow-lg">
                <p class="font-bold">✓ Currently Authenticated</p>
                <p class="text-sm mt-1">User: {{ Auth::user()->name }} (ID: {{ Auth::id() }})</p>
                <p class="text-sm">Email: {{ Auth::user()->email }}</p>
                <a href="{{ route('dashboard') }}" class="mt-2 inline-block bg-white text-green-900 px-4 py-2 rounded font-semibold hover:bg-gray-100">
                    Go to Dashboard →
                </a>
            </div>
        @endauth

        <!-- Registration Card -->
        <div class="bg-white rounded-2xl shadow-2xl p-8">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Join Laravel Community</h1>
                <p class="text-gray-600">Share your amazing Laravel projects</p>
            </div>

            <!-- Registration Options -->
            <div id="registration-options" class="space-y-4">
                <!-- QR Code Registration Button -->
                <button onclick="startQRRegistration()" class="w-full bg-gradient-to-r from-red-500 to-pink-500 text-white py-4 px-6 rounded-xl font-semibold hover:from-red-600 hover:to-pink-600 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 flex items-center justify-center space-x-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                    </svg>
                    <span>Register with Laracon QR Code</span>
                </button>

                <!-- Divider -->
                <div class="flex items-center">
                    <div class="flex-1 border-t border-gray-300"></div>
                    <span class="px-4 text-gray-500 text-sm">OR</span>
                    <div class="flex-1 border-t border-gray-300"></div>
                </div>

                <!-- Manual Registration Button -->
                <button onclick="startManualRegistration()" class="w-full bg-white border-2 border-gray-300 text-gray-700 py-4 px-6 rounded-xl font-semibold hover:border-gray-400 hover:bg-gray-50 transition-all duration-300 flex items-center justify-center space-x-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <span>Register Manually</span>
                </button>
            </div>

            <!-- QR Code Scanner (Hidden by default) -->
            <div id="qr-scanner-section" class="hidden">
                <button onclick="cancelQRScan()" class="mb-4 text-gray-600 hover:text-gray-800 flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    <span>Back to options</span>
                </button>

                <div class="mb-4">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Scan Your Laracon Badge</h3>
                    <p class="text-sm text-gray-600">Position the QR code within the frame</p>
                </div>

                <div id="qr-reader" class="rounded-xl overflow-hidden border-4 border-red-500"></div>
                <div id="qr-status" class="mt-4 text-center text-sm text-gray-600"></div>
            </div>

            <!-- Email & PIN Step (After QR Scan) -->
            <div id="qr-details-form" class="hidden">
                <button onclick="restartRegistration()" class="mb-4 text-gray-600 hover:text-gray-800 flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    <span>Back</span>
                </button>

                <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                    <p class="text-sm text-green-800">✓ QR Code scanned successfully!</p>
                    <p class="text-sm text-gray-700 mt-1">Welcome, <span id="scanned-name" class="font-semibold"></span></p>
                </div>

                <form id="qr-registration-form" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" id="laracon-uuid" name="laracon_uuid">
                    <input type="hidden" id="scanned-name-input" name="name">

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Email Address</label>
                        <input type="email" name="email" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent" placeholder="your@email.com">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Create 6-Digit PIN</label>
                        <input type="tel" inputmode="numeric" pattern="[0-9]{6}" name="pin" required maxlength="6" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent text-center text-2xl tracking-widest" placeholder="000000">
                        <p class="text-xs text-gray-500 mt-1">You'll use this 6-digit PIN to login quickly (numbers only)</p>
                    </div>

                    <button type="submit" class="w-full bg-gradient-to-r from-red-500 to-pink-500 text-white py-3 px-6 rounded-lg font-semibold hover:from-red-600 hover:to-pink-600 transition-all duration-300 shadow-lg">
                        Complete Registration
                    </button>
                </form>
            </div>

            <!-- Manual Registration Form -->
            <div id="manual-registration-form" class="hidden">
                <button onclick="restartRegistration()" class="mb-4 text-gray-600 hover:text-gray-800 flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    <span>Back</span>
                </button>

                <h3 class="text-lg font-semibold text-gray-900 mb-4">Create Your Account</h3>

                <form id="manual-registration-form-element" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Full Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent" placeholder="John Doe">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Email Address</label>
                        <input type="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent" placeholder="your@email.com">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">6-Digit PIN</label>
                        <input type="tel" inputmode="numeric" pattern="[0-9]{6}" name="pin" required maxlength="6" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent text-center text-2xl tracking-widest" placeholder="000000">
                        <p class="text-xs text-gray-500 mt-1">Create a 6-digit PIN for quick login (numbers only)</p>
                    </div>

                    <button type="submit" class="w-full bg-gradient-to-r from-red-500 to-pink-500 text-white py-3 px-6 rounded-lg font-semibold hover:from-red-600 hover:to-pink-600 transition-all duration-300 shadow-lg">
                        Create Account
                    </button>
                </form>
            </div>

            <!-- Login Link -->
            <div class="mt-6 text-center">
                <p class="text-gray-600">Already have an account? <a href="{{ route('login') }}" class="text-red-500 hover:text-red-600 font-semibold">Login</a></p>
            </div>
        </div>
    </div>

    <script>
        // Get base URL from current page (handles both HTTP and HTTPS)
        const BASE_URL = window.location.origin;
        const REGISTER_URL = BASE_URL + '/register';
        
        console.log('🌐 Base URL:', BASE_URL);
        console.log('📝 Register URL:', REGISTER_URL);
        console.log('🔒 Is Secure:', window.location.protocol === 'https:');

        let html5QrcodeScanner = null;

        // Set form action dynamically
        document.addEventListener('DOMContentLoaded', function() {
            const qrForm = document.getElementById('qr-registration-form');
            const manualForm = document.getElementById('manual-registration-form-element');
            
            if (qrForm) {
                qrForm.action = REGISTER_URL;
                console.log('✓ QR form action set to:', qrForm.action);
            }
            
            if (manualForm) {
                manualForm.action = REGISTER_URL;
                console.log('✓ Manual form action set to:', manualForm.action);
            }

            // Add form submission logging
            [qrForm, manualForm].forEach(form => {
                if (form) {
                    form.addEventListener('submit', function(e) {
                        console.log('📤 Form submitting...');
                        console.log('Form action:', this.action);
                        console.log('Form method:', this.method);
                        
                        const formData = new FormData(this);
                        for (let [key, value] of formData.entries()) {
                            console.log(`  ${key}:`, key === 'pin' ? '****** (6 digits)' : value);
                        }
                    });
                }
            });

            // Enforce numeric-only input on PIN fields
            const pinInputs = document.querySelectorAll('input[name="pin"]');
            pinInputs.forEach(input => {
                input.addEventListener('input', function(e) {
                    // Remove non-numeric characters
                    this.value = this.value.replace(/[^0-9]/g, '');
                    // Limit to 6 digits
                    if (this.value.length > 6) {
                        this.value = this.value.slice(0, 6);
                    }
                });

                input.addEventListener('keypress', function(e) {
                    // Only allow numbers
                    if (e.key && !/[0-9]/.test(e.key) && e.key !== 'Backspace' && e.key !== 'Delete' && e.key !== 'Tab' && e.key !== 'Enter') {
                        e.preventDefault();
                    }
                });
            });
        });

        function startQRRegistration() {
            console.log('Starting QR registration...');
            document.getElementById('registration-options').classList.add('hidden');
            document.getElementById('qr-scanner-section').classList.remove('hidden');
            initQRScanner();
        }

        function startManualRegistration() {
            console.log('Starting manual registration...');
            document.getElementById('registration-options').classList.add('hidden');
            document.getElementById('manual-registration-form').classList.remove('hidden');
        }

        function cancelQRScan() {
            if (html5QrcodeScanner) {
                html5QrcodeScanner.clear();
            }
            document.getElementById('qr-scanner-section').classList.add('hidden');
            document.getElementById('registration-options').classList.remove('hidden');
        }

        function restartRegistration() {
            if (html5QrcodeScanner) {
                html5QrcodeScanner.clear();
            }
            document.getElementById('qr-scanner-section').classList.add('hidden');
            document.getElementById('qr-details-form').classList.add('hidden');
            document.getElementById('manual-registration-form').classList.add('hidden');
            document.getElementById('registration-options').classList.remove('hidden');
        }

        function initQRScanner() {
            const config = { fps: 10, qrbox: { width: 250, height: 250 } };
            
            html5QrcodeScanner = new Html5Qrcode("qr-reader");
            
            html5QrcodeScanner.start(
                { facingMode: "environment" },
                config,
                onScanSuccess,
                onScanError
            ).catch(err => {
                console.error('Camera error:', err);
                document.getElementById('qr-status').innerHTML = '<span class="text-red-500">Camera access denied. Please enable camera permissions.</span>';
            });
        }

        function onScanSuccess(decodedText) {
            try {
                console.log('QR Code scanned:', decodedText);
                const qrData = JSON.parse(decodedText);
                
                console.log('Parsed QR data:', qrData);
                
                if (qrData.uuid && qrData.name) {
                    html5QrcodeScanner.stop();
                    
                    document.getElementById('laracon-uuid').value = qrData.uuid;
                    document.getElementById('scanned-name-input').value = qrData.name;
                    document.getElementById('scanned-name').textContent = qrData.name;
                    
                    console.log('✓ QR data populated:', {
                        uuid: qrData.uuid,
                        name: qrData.name
                    });
                    
                    document.getElementById('qr-scanner-section').classList.add('hidden');
                    document.getElementById('qr-details-form').classList.remove('hidden');
                } else {
                    console.error('Invalid QR code - missing uuid or name:', qrData);
                    document.getElementById('qr-status').innerHTML = '<span class="text-red-500">Invalid QR code format</span>';
                }
            } catch (e) {
                console.error('QR parse error:', e, 'Raw data:', decodedText);
                document.getElementById('qr-status').innerHTML = '<span class="text-red-500">Invalid QR code</span>';
            }
        }

        function onScanError(errorMessage) {
            // Ignore scan errors (they happen constantly while scanning)
        }
    </script>
</body>
</html>
