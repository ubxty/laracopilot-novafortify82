<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Laravel Community</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-gradient-to-r from-red-600 to-black text-white shadow-lg">
        <nav class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"/>
                    </svg>
                    <h1 class="text-xl md:text-2xl font-bold">Laravel Community</h1>
                </div>
                
                <div class="flex space-x-4">
                    <a href="{{ route('home') }}" class="hover:text-red-200 transition-colors font-medium">Home</a>
                    <a href="{{ route('register') }}" class="hover:text-red-200 transition-colors font-medium">Register</a>
                </div>
            </div>
        </nav>
    </header>

    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full">
            <div class="bg-white rounded-xl shadow-lg p-8">
                <!-- Step 1: Login Options -->
                <div id="step-options" class="step-content">
                    <div class="text-center mb-8">
                        <h2 class="text-3xl font-bold text-gray-800 mb-2">Welcome Back</h2>
                        <p class="text-gray-600">Choose how you'd like to sign in</p>
                    </div>

                    <div class="space-y-4">
                        <button id="btn-qr-login" class="w-full bg-gradient-to-r from-red-600 to-black text-white py-4 rounded-lg font-semibold hover:from-red-700 hover:to-gray-900 transition-all transform hover:scale-105 shadow-lg flex items-center justify-center space-x-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                            </svg>
                            <span>Login with QR Code</span>
                        </button>

                        <div class="relative">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-300"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="px-2 bg-white text-gray-500">Or</span>
                            </div>
                        </div>

                        <button id="btn-email-login" class="w-full bg-gray-100 text-gray-700 py-4 rounded-lg font-semibold hover:bg-gray-200 transition-all">
                            Login with Email
                        </button>
                    </div>

                    <div class="mt-6 text-center">
                        <p class="text-gray-600">Don't have an account? 
                            <a href="{{ route('register') }}" class="text-red-600 font-semibold hover:text-red-700 transition-colors">Register</a>
                        </p>
                    </div>
                </div>

                <!-- Step 2: QR Scanner -->
                <div id="step-qr-scanner" class="step-content hidden">
                    <div class="text-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-800 mb-2">Scan Your QR Code</h2>
                        <p class="text-gray-600">Position your Laracon QR badge within the frame</p>
                    </div>

                    <div id="qr-reader" class="rounded-lg overflow-hidden mb-4"></div>

                    <div id="scan-result" class="hidden mb-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg">
                        <p class="text-center font-semibold">✓ QR Code Scanned</p>
                    </div>

                    <button id="btn-cancel-qr" class="w-full bg-gray-100 text-gray-700 py-3 rounded-lg font-semibold hover:bg-gray-200 transition-all">
                        ← Back
                    </button>
                </div>

                <!-- Step 3: QR PIN Entry -->
                <div id="step-qr-pin" class="step-content hidden">
                    <div class="text-center mb-6">
                        <div class="bg-green-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800 mb-2" id="qr-user-name"></h2>
                        <p class="text-gray-600">Enter your PIN to continue</p>
                    </div>

                    @if ($errors->has('pin'))
                        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6">
                            {{ $errors->first('pin') }}
                        </div>
                    @endif

                    <form action="{{ route('login.qr') }}" method="POST" class="space-y-6">
                        @csrf
                        <input type="hidden" name="laracon_uuid" id="qr-uuid">

                        <div>
                            <label for="qr-pin" class="block text-sm font-semibold text-gray-700 mb-2">Enter Your PIN</label>
                            <input type="text" name="pin" id="qr-pin" required maxlength="6" pattern="[0-9]{6}"
                                   class="w-full px-4 py-4 text-center text-2xl tracking-widest border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all"
                                   placeholder="● ● ● ● ● ●" autofocus>
                        </div>

                        <button type="submit" class="w-full bg-gradient-to-r from-red-600 to-black text-white py-3 rounded-lg font-semibold hover:from-red-700 hover:to-gray-900 transition-all transform hover:scale-105 shadow-lg">
                            Login →
                        </button>
                    </form>

                    <button id="btn-back-from-qr-pin" class="w-full mt-4 text-gray-600 hover:text-gray-800 transition-colors font-medium">
                        ← Back
                    </button>
                </div>

                <!-- Step 4: Email/Password Login -->
                <div id="step-email-login" class="step-content hidden">
                    <div class="text-center mb-8">
                        <h2 class="text-3xl font-bold text-gray-800 mb-2">Sign In</h2>
                        <p class="text-gray-600">Enter your credentials to continue</p>
                    </div>

                    @if ($errors->has('email'))
                        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6">
                            {{ $errors->first('email') }}
                        </div>
                    @endif

                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="space-y-6">
                            <div>
                                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all">
                            </div>

                            <div>
                                <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                                <input type="password" name="password" id="password" required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all">
                            </div>

                            <div class="flex items-center">
                                <input type="checkbox" name="remember" id="remember"
                                       class="w-4 h-4 text-red-600 border-gray-300 rounded focus:ring-red-500">
                                <label for="remember" class="ml-2 text-sm font-medium text-gray-700">Remember me</label>
                            </div>

                            <button type="submit" class="w-full bg-gradient-to-r from-red-600 to-black text-white py-3 rounded-lg font-semibold hover:from-red-700 hover:to-gray-900 transition-all transform hover:scale-105 shadow-lg">
                                Sign In
                            </button>
                        </div>
                    </form>

                    <button id="btn-back-from-email" class="w-full mt-4 text-gray-600 hover:text-gray-800 transition-colors font-medium">
                        ← Back
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // State management
        let qrData = null;
        let html5QrCode = null;

        // Show/hide steps
        function showStep(stepId) {
            document.querySelectorAll('.step-content').forEach(step => step.classList.add('hidden'));
            document.getElementById(stepId).classList.remove('hidden');
        }

        // Button: QR Login
        document.getElementById('btn-qr-login').addEventListener('click', function() {
            showStep('step-qr-scanner');
            startQRScanner();
        });

        // Button: Email Login
        document.getElementById('btn-email-login').addEventListener('click', function() {
            showStep('step-email-login');
        });

        // Button: Cancel QR
        document.getElementById('btn-cancel-qr').addEventListener('click', function() {
            stopQRScanner();
            showStep('step-options');
        });

        // Button: Back from QR PIN
        document.getElementById('btn-back-from-qr-pin').addEventListener('click', function() {
            showStep('step-qr-scanner');
            startQRScanner();
        });

        // Button: Back from Email
        document.getElementById('btn-back-from-email').addEventListener('click', function() {
            showStep('step-options');
        });

        // QR Scanner
        function startQRScanner() {
            html5QrCode = new Html5Qrcode("qr-reader");
            
            html5QrCode.start(
                { facingMode: "environment" },
                {
                    fps: 10,
                    qrbox: { width: 250, height: 250 }
                },
                onScanSuccess,
                onScanError
            ).catch(err => {
                console.error('QR Scanner error:', err);
                alert('Unable to access camera. Please use email login instead.');
                showStep('step-options');
            });
        }

        function stopQRScanner() {
            if (html5QrCode) {
                html5QrCode.stop().then(() => {
                    html5QrCode.clear();
                }).catch(err => console.error('Stop scanner error:', err));
            }
        }

        async function onScanSuccess(decodedText, decodedResult) {
            try {
                qrData = JSON.parse(decodedText);
                
                // Validate QR data structure
                if (!qrData.uuid || !qrData.name) {
                    throw new Error('Invalid QR code format');
                }

                // Show success message
                document.getElementById('scan-result').classList.remove('hidden');
                
                // Stop scanner
                stopQRScanner();

                // Check if user exists
                const response = await fetch('{{ route("check.qr") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ laracon_uuid: qrData.uuid })
                });

                const result = await response.json();

                if (result.exists) {
                    // User exists, ask for PIN
                    setTimeout(() => {
                        document.getElementById('qr-user-name').textContent = `Welcome back, ${result.name}! 👋`;
                        document.getElementById('qr-uuid').value = qrData.uuid;
                        showStep('step-qr-pin');
                    }, 1000);
                } else {
                    // User doesn't exist, redirect to registration
                    alert('Account not found. Please register first.');
                    window.location.href = '{{ route("register") }}';
                }
                
            } catch (error) {
                console.error('QR Parse error:', error);
                alert('Invalid QR code. Please scan a valid Laracon QR badge.');
                stopQRScanner();
                showStep('step-options');
            }
        }

        function onScanError(errorMessage) {
            // Ignore scan errors (camera still searching for QR code)
        }

        // PIN input formatting
        const pinInput = document.getElementById('qr-pin');
        if (pinInput) {
            pinInput.addEventListener('input', function(e) {
                this.value = this.value.replace(/[^0-9]/g, '');
            });
        }

        // Check if there were validation errors and show email form
        @if ($errors->has('email'))
            showStep('step-email-login');
        @elseif ($errors->has('pin'))
            showStep('step-qr-pin');
        @endif
    </script>
</body>
</html>
