<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Laravel Community</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    @include('partials.header')

    <!-- Login Section -->
    <section class="py-12 md:py-16 bg-gray-50 min-h-screen flex items-center">
        <div class="container mx-auto px-4">
            <div class="max-w-md mx-auto">
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <!-- Header -->
                    <div class="bg-gradient-to-r from-red-600 to-black text-white p-6 md:p-8 text-center">
                        <h2 class="text-2xl md:text-3xl font-bold mb-2">Welcome Back</h2>
                        <p class="text-red-100 text-sm md:text-base">Login to access your Laravel Community account</p>
                    </div>

                    <div class="p-6 md:p-8">
                        @if(session('error'))
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6 text-sm">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if(session('success'))
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 text-sm">
                                {{ session('success') }}
                            </div>
                        @endif

                        <!-- Login Method Toggle -->
                        <div class="grid grid-cols-2 gap-2 mb-6 bg-gray-100 p-1 rounded-lg">
                            <button 
                                id="manual-mode-btn" 
                                class="px-4 py-3 rounded-lg font-semibold text-sm transition-all bg-gradient-to-r from-red-600 to-black text-white shadow-md"
                            >
                                🔐 Manual Login
                            </button>
                            <button 
                                id="qr-mode-btn" 
                                class="px-4 py-3 rounded-lg font-semibold text-sm transition-all text-gray-600 hover:bg-white"
                            >
                                🎫 Laracon QR
                            </button>
                        </div>

                        <!-- Manual Login Section -->
                        <div id="manual-login-section" class="">
                            <form action="{{ route('login') }}" method="POST">
                                @csrf
                                
                                <div class="mb-5">
                                    <label class="block text-gray-700 font-semibold mb-2 text-sm" for="email">Email Address</label>
                                    <input 
                                        type="email" 
                                        name="email" 
                                        id="email"
                                        value="{{ old('email') }}" 
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all @error('email') border-red-500 @enderror" 
                                        placeholder="your@email.com"
                                        required
                                    >
                                    @error('email')
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-5">
                                    <label class="block text-gray-700 font-semibold mb-2 text-sm" for="pin">6-Digit PIN</label>
                                    <div class="flex gap-2 justify-between max-w-sm mx-auto">
                                        <input type="text" maxlength="1" class="w-12 h-12 md:w-14 md:h-14 text-center text-xl md:text-2xl font-bold border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all pin-input" data-index="0" />
                                        <input type="text" maxlength="1" class="w-12 h-12 md:w-14 md:h-14 text-center text-xl md:text-2xl font-bold border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all pin-input" data-index="1" />
                                        <input type="text" maxlength="1" class="w-12 h-12 md:w-14 md:h-14 text-center text-xl md:text-2xl font-bold border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all pin-input" data-index="2" />
                                        <input type="text" maxlength="1" class="w-12 h-12 md:w-14 md:h-14 text-center text-xl md:text-2xl font-bold border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all pin-input" data-index="3" />
                                        <input type="text" maxlength="1" class="w-12 h-12 md:w-14 md:h-14 text-center text-xl md:text-2xl font-bold border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all pin-input" data-index="4" />
                                        <input type="text" maxlength="1" class="w-12 h-12 md:w-14 md:h-14 text-center text-xl md:text-2xl font-bold border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all pin-input" data-index="5" />
                                    </div>
                                    <input type="hidden" name="password" id="password-hidden" required />
                                    @error('password')
                                        <span class="text-red-500 text-xs mt-2 block text-center">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="flex items-center justify-between mb-6">
                                    <label class="flex items-center cursor-pointer">
                                        <input type="checkbox" name="remember" class="w-4 h-4 text-red-600 border-gray-300 rounded focus:ring-red-500">
                                        <span class="ml-2 text-gray-700 text-xs md:text-sm">Remember me</span>
                                    </label>
                                    <a href="#" class="text-xs md:text-sm text-red-600 hover:text-red-700 font-semibold">Forgot PIN?</a>
                                </div>

                                <button 
                                    type="submit" 
                                    class="w-full bg-gradient-to-r from-red-600 to-black text-white py-3 rounded-lg hover:from-red-700 hover:to-gray-900 transition-all transform hover:scale-105 font-semibold shadow-lg"
                                >
                                    Login to Account
                                </button>
                            </form>
                        </div>

                        <!-- QR Login Section -->
                        <div id="qr-login-section" class="hidden">
                            <div class="mb-6">
                                <div class="bg-gradient-to-br from-red-50 to-orange-50 rounded-lg p-4 border border-red-200">
                                    <p class="text-center text-sm text-gray-700 mb-4 font-medium">Scan your Laracon badge to login instantly</p>
                                    <div class="bg-white rounded-lg overflow-hidden shadow-inner">
                                        <video id="qr-video" class="w-full" style="max-height: 280px; object-fit: cover;"></video>
                                    </div>
                                    <div id="qr-result" class="mt-3 text-center text-xs text-gray-600 font-medium"></div>
                                </div>
                            </div>
                            
                            <!-- PIN Entry Modal (hidden by default) -->
                            <div id="pin-entry-modal" class="hidden">
                                <div class="bg-white rounded-lg p-6 border-2 border-red-500">
                                    <h3 class="text-lg font-bold text-gray-800 mb-2 text-center">Enter Your PIN</h3>
                                    <p class="text-sm text-gray-600 mb-4 text-center" id="pin-user-info"></p>
                                    <div class="flex gap-2 justify-center mb-4">
                                        <input type="text" maxlength="1" class="w-12 h-12 text-center text-2xl font-bold border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 qr-pin-input" data-index="0" />
                                        <input type="text" maxlength="1" class="w-12 h-12 text-center text-2xl font-bold border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 qr-pin-input" data-index="1" />
                                        <input type="text" maxlength="1" class="w-12 h-12 text-center text-2xl font-bold border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 qr-pin-input" data-index="2" />
                                        <input type="text" maxlength="1" class="w-12 h-12 text-center text-2xl font-bold border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 qr-pin-input" data-index="3" />
                                        <input type="text" maxlength="1" class="w-12 h-12 text-center text-2xl font-bold border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 qr-pin-input" data-index="4" />
                                        <input type="text" maxlength="1" class="w-12 h-12 text-center text-2xl font-bold border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 qr-pin-input" data-index="5" />
                                    </div>
                                    <div id="pin-error" class="text-red-500 text-xs text-center mb-3 hidden"></div>
                                    <button onclick="submitQRPin()" class="w-full bg-gradient-to-r from-red-600 to-black text-white py-3 rounded-lg hover:from-red-700 hover:to-gray-900 font-semibold">
                                        Login
                                    </button>
                                    <button onclick="cancelPinEntry()" class="w-full mt-2 bg-gray-200 text-gray-700 py-2 rounded-lg hover:bg-gray-300 font-semibold text-sm">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 text-center">
                            <p class="text-gray-600 text-sm">Don't have an account? <a href="{{ route('register') }}" class="text-red-600 hover:text-red-700 font-semibold">Register here</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('partials.footer')
    @include('partials.debug')

    <script src="https://unpkg.com/jsqr@1.4.0/dist/jsQR.js"></script>
    <script>
        let currentQRData = null;
        let currentUUID = null;

        // Mode Toggle
        const qrModeBtn = document.getElementById('qr-mode-btn');
        const manualModeBtn = document.getElementById('manual-mode-btn');
        const qrSection = document.getElementById('qr-login-section');
        const manualSection = document.getElementById('manual-login-section');
        let scanning = false;

        manualModeBtn.addEventListener('click', () => {
            manualModeBtn.classList.add('bg-gradient-to-r', 'from-red-600', 'to-black', 'text-white', 'shadow-md');
            manualModeBtn.classList.remove('text-gray-600', 'hover:bg-white');
            qrModeBtn.classList.remove('bg-gradient-to-r', 'from-red-600', 'to-black', 'text-white', 'shadow-md');
            qrModeBtn.classList.add('text-gray-600', 'hover:bg-white');
            manualSection.classList.remove('hidden');
            qrSection.classList.add('hidden');
            document.getElementById('pin-entry-modal').classList.add('hidden');
            stopQRScanner();
            document.getElementById('email').focus();
        });

        qrModeBtn.addEventListener('click', () => {
            qrModeBtn.classList.add('bg-gradient-to-r', 'from-red-600', 'to-black', 'text-white', 'shadow-md');
            qrModeBtn.classList.remove('text-gray-600', 'hover:bg-white');
            manualModeBtn.classList.remove('bg-gradient-to-r', 'from-red-600', 'to-black', 'text-white', 'shadow-md');
            manualModeBtn.classList.add('text-gray-600', 'hover:bg-white');
            qrSection.classList.remove('hidden');
            manualSection.classList.add('hidden');
            if (!scanning) startQRScanner();
        });

        // PIN Input Handler for manual login
        const pinInputs = document.querySelectorAll('.pin-input');
        const passwordHidden = document.getElementById('password-hidden');

        pinInputs.forEach((input, index) => {
            input.addEventListener('input', (e) => {
                const value = e.target.value;
                if (value.length === 1 && index < pinInputs.length - 1) {
                    pinInputs[index + 1].focus();
                }
                updateHiddenPassword();
            });

            input.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace' && !e.target.value && index > 0) {
                    pinInputs[index - 1].focus();
                }
            });

            input.addEventListener('paste', (e) => {
                e.preventDefault();
                const pastedData = e.clipboardData.getData('text').slice(0, 6);
                pastedData.split('').forEach((char, i) => {
                    if (pinInputs[i]) {
                        pinInputs[i].value = char;
                    }
                });
                updateHiddenPassword();
                if (pastedData.length === 6) {
                    pinInputs[5].focus();
                }
            });
        });

        function updateHiddenPassword() {
            const pin = Array.from(pinInputs).map(input => input.value).join('');
            passwordHidden.value = pin;
        }

        // PIN Input Handler for QR modal
        const qrPinInputs = document.querySelectorAll('.qr-pin-input');
        qrPinInputs.forEach((input, index) => {
            input.addEventListener('input', (e) => {
                const value = e.target.value;
                if (value.length === 1 && index < qrPinInputs.length - 1) {
                    qrPinInputs[index + 1].focus();
                }
            });

            input.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace' && !e.target.value && index > 0) {
                    qrPinInputs[index - 1].focus();
                }
                if (e.key === 'Enter') {
                    submitQRPin();
                }
            });
        });

        function submitQRPin() {
            const pin = Array.from(qrPinInputs).map(input => input.value).join('');
            if (pin.length !== 6) {
                document.getElementById('pin-error').textContent = 'Please enter all 6 digits';
                document.getElementById('pin-error').classList.remove('hidden');
                return;
            }
            processQRLogin(currentQRData, pin);
        }

        function cancelPinEntry() {
            document.getElementById('pin-entry-modal').classList.add('hidden');
            qrPinInputs.forEach(input => input.value = '');
            document.getElementById('pin-error').classList.add('hidden');
            scanning = true;
            requestAnimationFrame(scanQRCode);
        }

        // QR Code Scanner
        const video = document.getElementById('qr-video');
        const resultDiv = document.getElementById('qr-result');
        let stream = null;

        async function startQRScanner() {
            try {
                stream = await navigator.mediaDevices.getUserMedia({ 
                    video: { facingMode: 'environment' } 
                });
                video.srcObject = stream;
                video.setAttribute('playsinline', true);
                video.play();
                scanning = true;
                requestAnimationFrame(scanQRCode);
                resultDiv.textContent = '📷 Camera ready - Point at Laracon badge';
            } catch (err) {
                resultDiv.textContent = '⚠️ Camera access denied';
                if (window.logApiRequest) {
                    logApiRequest({
                        type: 'Camera Error',
                        error: err.message || err.toString(),
                        success: false
                    });
                }
                console.error('Camera error:', err);
            }
        }

        function stopQRScanner() {
            scanning = false;
            if (stream) {
                stream.getTracks().forEach(track => track.stop());
                stream = null;
            }
        }

        function scanQRCode() {
            if (!scanning) return;

            if (video.readyState === video.HAVE_ENOUGH_DATA) {
                const canvas = document.createElement('canvas');
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                const ctx = canvas.getContext('2d');
                ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
                const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
                const code = jsQR(imageData.data, imageData.width, imageData.height);

                if (code) {
                    resultDiv.textContent = '✅ QR detected! Processing...';
                    currentQRData = code.data;
                    processQRLogin(code.data);
                    return;
                }
            }
            requestAnimationFrame(scanQRCode);
        }

        function processQRLogin(qrData, pin = null) {
            scanning = false;
            const startTime = Date.now();
            
            const payload = {
                qr_code: qrData,
                laracon_login: true
            };
            
            if (pin) {
                payload.pin = pin;
            }
            
            if (window.logApiRequest) {
                logApiRequest({
                    type: 'QR Login Request',
                    url: '{{ route('login') }}',
                    method: 'POST',
                    params: payload
                });
            }
            
            fetch('{{ route('login') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(payload)
            })
            .then(response => {
                const duration = Date.now() - startTime;
                if (!response.ok && response.status !== 404 && response.status !== 401) {
                    return response.text().then(text => {
                        throw new Error(`HTTP ${response.status}: ${text}`);
                    });
                }
                return response.json().then(data => ({
                    data,
                    status: response.status,
                    duration
                }));
            })
            .then(({ data, status, duration }) => {
                if (data.success) {
                    resultDiv.textContent = '✅ Login successful! Redirecting...';
                    if (window.logApiRequest) {
                        logApiRequest({
                            type: 'QR Login Success',
                            response: data,
                            statusCode: status,
                            success: true,
                            duration
                        });
                    }
                    window.location.href = data.redirect || '{{ route('dashboard') }}';
                } else if (data.action === 'register') {
                    // First time - redirect to registration
                    resultDiv.textContent = '📝 First time badge scan - Redirecting to registration...';
                    if (window.logApiRequest) {
                        logApiRequest({
                            type: 'QR First Time Scan',
                            response: data,
                            statusCode: status,
                            success: false,
                            duration
                        });
                    }
                    setTimeout(() => {
                        window.location.href = '{{ route('register') }}?qr=' + encodeURIComponent(qrData);
                    }, 1500);
                } else if (data.action === 'enter_pin') {
                    // Show PIN entry modal
                    currentUUID = data.uuid;
                    document.getElementById('pin-user-info').textContent = `Welcome back, ${data.name}!`;
                    document.getElementById('qr-result').parentElement.classList.add('hidden');
                    document.getElementById('pin-entry-modal').classList.remove('hidden');
                    qrPinInputs[0].focus();
                    if (window.logApiRequest) {
                        logApiRequest({
                            type: 'QR Prompt PIN',
                            response: data,
                            statusCode: status,
                            success: false,
                            duration
                        });
                    }
                } else {
                    resultDiv.textContent = '❌ ' + (data.message || 'Error processing QR');
                    document.getElementById('pin-error').textContent = data.message;
                    document.getElementById('pin-error').classList.remove('hidden');
                    if (window.logApiRequest) {
                        logApiRequest({
                            type: 'QR Login Failed',
                            response: data,
                            statusCode: status,
                            success: false,
                            duration
                        });
                    }
                    if (!pin) {
                        scanning = true;
                        requestAnimationFrame(scanQRCode);
                    }
                }
            })
            .catch(error => {
                const duration = Date.now() - startTime;
                resultDiv.textContent = '❌ Error processing QR';
                if (window.logApiRequest) {
                    logApiRequest({
                        type: 'QR Login Error',
                        error: error.message || error.toString(),
                        success: false,
                        duration
                    });
                }
                console.error('QR login error:', error);
                scanning = true;
                requestAnimationFrame(scanQRCode);
            });
        }
    </script>
</body>
</html>
