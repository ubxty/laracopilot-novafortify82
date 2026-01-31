@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-red-50 to-pink-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl mx-auto">
        <!-- Step 1: QR Scanner -->
        <div id="step-scanner" class="bg-white rounded-2xl shadow-xl p-8">
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-red-600 to-pink-600 rounded-full mb-4">
                    <i class="fas fa-qrcode text-white text-3xl"></i>
                </div>
                <h2 class="text-3xl font-bold text-gray-900">Scan Your QR Code</h2>
                <p class="mt-2 text-gray-600">Position your QR code in front of the camera to get started</p>
            </div>

            <!-- Camera Preview -->
            <div class="relative mb-6">
                <video id="qr-video" class="w-full h-96 bg-gray-900 rounded-lg object-cover" autoplay playsinline></video>
                <div class="absolute inset-0 border-4 border-red-500 rounded-lg pointer-events-none opacity-50"></div>
                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-64 h-64 border-4 border-white rounded-lg pointer-events-none"></div>
            </div>

            <!-- Scanner Status -->
            <div id="scanner-status" class="text-center">
                <div class="inline-flex items-center space-x-2 text-gray-600">
                    <div class="animate-pulse w-2 h-2 bg-red-500 rounded-full"></div>
                    <span>Camera active - scanning...</span>
                </div>
            </div>

            <!-- Error Message -->
            <div id="scanner-error" class="hidden mt-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                <div class="flex items-center space-x-2 text-red-800">
                    <i class="fas fa-exclamation-circle"></i>
                    <span id="error-message"></span>
                </div>
            </div>

            <!-- Manual Input (Fallback) -->
            <div class="mt-6 pt-6 border-t border-gray-200">
                <button onclick="toggleManualInput()" class="text-sm text-gray-600 hover:text-gray-900">
                    <i class="fas fa-keyboard"></i> Can't scan? Enter QR data manually
                </button>
                <div id="manual-input" class="hidden mt-4">
                    <textarea id="manual-qr-data" rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-2" placeholder='Paste QR JSON here, e.g.: {"uuid":"...","name":"..."}'></textarea>
                    <button onclick="processManualInput()" class="mt-2 w-full bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-gray-900">
                        Continue
                    </button>
                </div>
            </div>
        </div>

        <!-- Step 2: Welcome & Email Input -->
        <div id="step-email" class="hidden bg-white rounded-2xl shadow-xl p-8">
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-green-500 to-emerald-600 rounded-full mb-4">
                    <i class="fas fa-check text-white text-3xl"></i>
                </div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Hi <span id="user-name" class="text-red-600"></span> 👋</h2>
                <p class="text-gray-600">Let's complete your registration</p>
            </div>

            <form id="email-form" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-envelope text-gray-400"></i> Email Address
                    </label>
                    <input type="email" id="email" name="email" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                        placeholder="Enter your email address">
                    <div id="email-error" class="hidden mt-2 text-sm text-red-600"></div>
                </div>
                <button type="submit" class="w-full bg-gradient-to-r from-red-600 to-pink-600 text-white px-6 py-3 rounded-lg hover:from-red-700 hover:to-pink-700 transition font-semibold">
                    Continue <i class="fas fa-arrow-right ml-2"></i>
                </button>
            </form>
        </div>

        <!-- Step 3: Password Setup -->
        <div id="step-password" class="hidden bg-white rounded-2xl shadow-xl p-8">
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-full mb-4">
                    <i class="fas fa-lock text-white text-3xl"></i>
                </div>
                <h2 class="text-3xl font-bold text-gray-900">Set Your Password</h2>
                <p class="mt-2 text-gray-600">Choose a secure password for your account</p>
            </div>

            <form action="{{ route('qr.complete') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" id="final-email" name="email">
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-key text-gray-400"></i> Password
                    </label>
                    <input type="password" name="password" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Enter password (min. 6 characters)">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-key text-gray-400"></i> Confirm Password
                    </label>
                    <input type="password" name="password_confirmation" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Confirm your password">
                </div>

                @if($errors->any())
                <div class="p-4 bg-red-50 border border-red-200 rounded-lg">
                    <div class="flex items-center space-x-2 text-red-800">
                        <i class="fas fa-exclamation-circle"></i>
                        <span>{{ $errors->first() }}</span>
                    </div>
                </div>
                @endif

                <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-6 py-3 rounded-lg hover:from-blue-700 hover:to-indigo-700 transition font-semibold">
                    <i class="fas fa-user-check"></i> Create Account
                </button>
            </form>
        </div>

        <!-- Back to Login Link -->
        <div class="mt-6 text-center">
            <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900">
                <i class="fas fa-arrow-left"></i> Back to login
            </a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jsqr@1.4.0/dist/jsQR.js"></script>
<script>
let video = document.getElementById('qr-video');
let canvas = document.createElement('canvas');
let context = canvas.getContext('2d');
let scanning = false;

// Start camera
async function startCamera() {
    try {
        const stream = await navigator.mediaDevices.getUserMedia({ 
            video: { facingMode: 'environment' } 
        });
        video.srcObject = stream;
        video.play();
        scanning = true;
        requestAnimationFrame(scanQR);
    } catch (err) {
        showError('Camera access denied. Please enable camera permissions.');
    }
}

// Scan QR code from video
function scanQR() {
    if (!scanning) return;

    if (video.readyState === video.HAVE_ENOUGH_DATA) {
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        context.drawImage(video, 0, 0, canvas.width, canvas.height);
        
        const imageData = context.getImageData(0, 0, canvas.width, canvas.height);
        const code = jsQR(imageData.data, imageData.width, imageData.height);
        
        if (code) {
            processQRData(code.data);
            return;
        }
    }
    
    requestAnimationFrame(scanQR);
}

// Process QR data
function processQRData(qrData) {
    scanning = false;
    stopCamera();
    
    fetch('{{ route('qr.verify') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ qr_data: qrData })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showEmailStep(data.name);
        } else {
            showError(data.message);
            setTimeout(() => {
                scanning = true;
                startCamera();
            }, 3000);
        }
    })
    .catch(error => {
        showError('Failed to verify QR code');
        setTimeout(() => {
            scanning = true;
            startCamera();
        }, 3000);
    });
}

// Stop camera
function stopCamera() {
    if (video.srcObject) {
        video.srcObject.getTracks().forEach(track => track.stop());
    }
}

// Show error
function showError(message) {
    document.getElementById('error-message').textContent = message;
    document.getElementById('scanner-error').classList.remove('hidden');
    setTimeout(() => {
        document.getElementById('scanner-error').classList.add('hidden');
    }, 5000);
}

// Show email step
function showEmailStep(name) {
    document.getElementById('step-scanner').classList.add('hidden');
    document.getElementById('step-email').classList.remove('hidden');
    document.getElementById('user-name').textContent = name;
}

// Handle email form
document.getElementById('email-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const email = document.getElementById('email').value;
    document.getElementById('final-email').value = email;
    document.getElementById('step-email').classList.add('hidden');
    document.getElementById('step-password').classList.remove('hidden');
});

// Toggle manual input
function toggleManualInput() {
    document.getElementById('manual-input').classList.toggle('hidden');
}

// Process manual input
function processManualInput() {
    const manualData = document.getElementById('manual-qr-data').value;
    if (manualData) {
        processQRData(manualData);
    }
}

// Start camera on page load
startCamera();
</script>
@endsection
