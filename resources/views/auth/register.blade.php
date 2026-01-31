<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Laravel Community</title>
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
                    <a href="{{ route('login') }}" class="hover:text-red-200 transition-colors font-medium">Login</a>
                </div>
            </div>
        </nav>
    </header>

    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full">
            <div class="bg-white rounded-xl shadow-lg p-8">
                <!-- Step 1: QR Scanner -->
                <div id="step-qr-scanner" class="step-content">
                    <div class="text-center mb-6">
                        <h2 class="text-3xl font-bold text-gray-800 mb-2">Scan Your QR Code</h2>
                        <p class="text-gray-600">Position your Laracon QR badge within the frame</p>
                    </div>

                    <div id="qr-reader" class="rounded-lg overflow-hidden mb-4"></div>

                    <div id="scan-result" class="hidden mb-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg">
                        <p class="text-center font-semibold">✓ QR Code Scanned Successfully!</p>
                    </div>

                    <div class="relative my-6">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white text-gray-500">Don't have a QR code?</span>
                        </div>
                    </div>

                    <button id="btn-manual-register" class="w-full bg-gray-100 text-gray-700 py-3 rounded-lg font-semibold hover:bg-gray-200 transition-all">
                        Register Manually
                    </button>

                    <div class="mt-6 text-center">
                        <p class="text-gray-600">Already have an account? 
                            <a href="{{ route('login') }}" class="text-red-600 font-semibold hover:text-red-700 transition-colors">Sign in</a>
                        </p>
                    </div>
                </div>

                <!-- Step 2: Email Entry (After QR Scan) -->
                <div id="step-email" class="step-content hidden">
                    <div class="text-center mb-6">
                        <div class="bg-green-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800 mb-2" id="greeting-message"></h2>
                        <p class="text-gray-600">Let's set up your account</p>
                    </div>

                    @if ($errors->any())
                        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6">
                            <ul class="list-disc list-inside space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form id="email-form" class="space-y-6">
                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                            <input type="email" id="email" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all"
                                   placeholder="you@example.com">
                        </div>

                        <button type="submit" class="w-full bg-gradient-to-r from-red-600 to-black text-white py-3 rounded-lg font-semibold hover:from-red-700 hover:to-gray-900 transition-all transform hover:scale-105 shadow-lg">
                            Continue →
                        </button>
                    </form>

                    <button id="btn-back-from-email" class="w-full mt-4 text-gray-600 hover:text-gray-800 transition-colors font-medium">
                        ← Scan Again
                    </button>
                </div>

                <!-- Step 3: PIN Entry -->
                <div id="step-pin" class="step-content hidden">
                    <div class="text-center mb-6">
                        <div class="bg-red-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800 mb-2">Create Your 6-Digit PIN</h2>
                        <p class="text-gray-600" id="email-display"></p>
                    </div>

                    <form action="{{ route('register') }}" method="POST" class="space-y-6">
                        @csrf
                        <input type="hidden" name="laracon_uuid" id="hidden-uuid">
                        <input type="hidden" name="name" id="hidden-name">
                        <input type="hidden" name="email" id="hidden-email">

                        <div>
                            <label for="pin" class="block text-sm font-semibold text-gray-700 mb-2">6-Digit PIN</label>
                            <input type="text" name="pin" id="pin" required maxlength="6" pattern="[0-9]{6}"
                                   class="w-full px-4 py-4 text-center text-2xl tracking-widest border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all"
                                   placeholder="● ● ● ● ● ●">
                            <p class="text-xs text-gray-500 mt-2 text-center">Enter a 6-digit PIN you'll remember for quick login</p>
                        </div>

                        <button type="submit" class="w-full bg-gradient-to-r from-red-600 to-black text-white py-3 rounded-lg font-semibold hover:from-red-700 hover:to-gray-900 transition-all transform hover:scale-105 shadow-lg">
                            Create Account 🎉
                        </button>
                    </form>

                    <button id="btn-back-from-pin" class="w-full mt-4 text-gray-600 hover:text-gray-800 transition-colors font-medium">
                        ← Back
                    </button>
                </div>

                <!-- Step 4: Manual Registration -->
                <div id="step-manual" class="step-content hidden">
                    <div class="text-center mb-8">
                        <h2 class="text-3xl font-bold text-gray-800 mb-2">Create Account</h2>
                        <p class="text-gray-600">Fill in your details to register</p>
                    </div>

                    @if ($errors->any())
                        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6">
                            <ul class="list-disc list-inside space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="space-y-6">
                            <div>
                                <label for="manual-name" class="block text-sm font-semibold text-gray-700 mb-2">Full Name</label>
                                <input type="text" name="name" id="manual-name" value="{{ old('name') }}" required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all">
                            </div>

                            <div>
                                <label for="manual-email" class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                                <input type="email" name="email" id="manual-email" value="{{ old('email') }}" required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all">
                            </div>

                            <div>
                                <label for="manual-pin" class="block text-sm font-semibold text-gray-700 mb-2">6-Digit PIN</label>
                                <input type="text" name="pin" id="manual-pin" required maxlength="6" pattern="[0-9]{6}"
                                       class="w-full px-4 py-4 text-center text-2xl tracking-widest border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all"
                                       placeholder="● ● ● ● ● ●">
                                <p class="text-xs text-gray-500 mt-2">Enter a 6-digit PIN for quick login</p>
                            </div>

                            <button type="submit" class="w-full bg-gradient-to-r from-red-600 to-black text-white py-3 rounded-lg font-semibold hover:from-red-700 hover:to-gray-900 transition-all transform hover:scale-105 shadow-lg">
                                Create Account
                            </button>
                        </div>
                    </form>

                    <button id="btn-back-from-manual" class="w-full mt-4 text-gray-600 hover:text-gray-800 transition-colors font-medium">
                        ← Back to QR Scan
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

        // Auto-start QR scanner on page load
        window.addEventListener('DOMContentLoaded', function() {
            startQRScanner();
        });

        // Button: Manual Register
        document.getElementById('btn-manual-register').addEventListener('click', function() {
            stopQRScanner();
            showStep('step-manual');
        });

        // Button: Back from Email
        document.getElementById('btn-back-from-email').addEventListener('click', function() {
            showStep('step-qr-scanner');
            startQRScanner();
        });

        // Button: Back from PIN
        document.getElementById('btn-back-from-pin').addEventListener('click', function() {
            showStep('step-email');
        });

        // Button: Back from Manual
        document.getElementById('btn-back-from-manual').addEventListener('click', function() {
            showStep('step-qr-scanner');
            startQRScanner();
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
                alert('Unable to access camera. Please check permissions or use manual registration.');
            });
        }

        function stopQRScanner() {
            if (html5QrCode) {
                html5QrCode.stop().then(() => {
                    html5QrCode.clear();
                }).catch(err => console.error('Stop scanner error:', err));
            }
        }

        function onScanSuccess(decodedText, decodedResult) {
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
                
                // Wait a moment then proceed to email step
                setTimeout(() => {
                    document.getElementById('greeting-message').textContent = `Hi ${qrData.name} 👋`;
                    showStep('step-email');
                }, 1000);
                
            } catch (error) {
                console.error('QR Parse error:', error);
                alert('Invalid QR code. Please scan a valid Laracon QR badge.');
            }
        }

        function onScanError(errorMessage) {
            // Ignore scan errors (camera still searching for QR code)
        }

        // Email Form Submit
        document.getElementById('email-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const email = document.getElementById('email').value;
            
            // Store data in hidden fields
            document.getElementById('hidden-uuid').value = qrData.uuid;
            document.getElementById('hidden-name').value = qrData.name;
            document.getElementById('hidden-email').value = email;
            document.getElementById('email-display').textContent = email;
            
            // Move to PIN step
            showStep('step-pin');
        });

        // PIN input formatting
        const pinInputs = document.querySelectorAll('input[name="pin"]');
        pinInputs.forEach(input => {
            input.addEventListener('input', function(e) {
                this.value = this.value.replace(/[^0-9]/g, '');
            });
        });

        // Check if there were validation errors and show manual form
        @if ($errors->any() && old('name'))
            showStep('step-manual');
        @endif
    </script>
</body>
</html>
