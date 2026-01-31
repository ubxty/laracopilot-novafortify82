<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Laravel Community</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    @include('partials.header')

    <!-- Register Section -->
    <section class="py-12 md:py-16 bg-gray-50 min-h-screen flex items-center">
        <div class="container mx-auto px-4">
            <div class="max-w-md mx-auto">
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <!-- Header -->
                    <div class="bg-gradient-to-r from-red-600 to-black text-white p-6 md:p-8 text-center">
                        <h2 class="text-2xl md:text-3xl font-bold mb-2">Join Our Community</h2>
                        <p class="text-red-100 text-sm md:text-base">Create an account to share and discover Laravel projects</p>
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

                        <!-- Register Method Toggle -->
                        <div class="grid grid-cols-2 gap-2 mb-6 bg-gray-100 p-1 rounded-lg">
                            <button 
                                id="manual-mode-btn" 
                                class="px-4 py-3 rounded-lg font-semibold text-sm transition-all bg-gradient-to-r from-red-600 to-black text-white shadow-md"
                            >
                                ✍️ Manual Register
                            </button>
                            <button 
                                id="qr-mode-btn" 
                                class="px-4 py-3 rounded-lg font-semibold text-sm transition-all text-gray-600 hover:bg-white"
                            >
                                🎫 Laracon QR
                            </button>
                        </div>

                        <!-- Manual Register Section -->
                        <div id="manual-register-section" class="">
                            <form action="{{ route('register') }}" method="POST">
                                @csrf
                                
                                <div class="mb-4">
                                    <label class="block text-gray-700 font-semibold mb-2 text-sm" for="name">Full Name</label>
                                    <input 
                                        type="text" 
                                        name="name" 
                                        id="name"
                                        value="{{ old('name') }}" 
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all @error('name') border-red-500 @enderror" 
                                        placeholder="John Doe"
                                        required
                                    >
                                    @error('name')
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-4">
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

                                <div class="mb-4">
                                    <label class="block text-gray-700 font-semibold mb-2 text-sm" for="pin">Create 6-Digit PIN</label>
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

                                <div class="mb-5">
                                    <label class="block text-gray-700 font-semibold mb-2 text-sm" for="pin-confirm">Confirm 6-Digit PIN</label>
                                    <div class="flex gap-2 justify-between max-w-sm mx-auto">
                                        <input type="text" maxlength="1" class="w-12 h-12 md:w-14 md:h-14 text-center text-xl md:text-2xl font-bold border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all pin-confirm-input" data-index="0" />
                                        <input type="text" maxlength="1" class="w-12 h-12 md:w-14 md:h-14 text-center text-xl md:text-2xl font-bold border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all pin-confirm-input" data-index="1" />
                                        <input type="text" maxlength="1" class="w-12 h-12 md:w-14 md:h-14 text-center text-xl md:text-2xl font-bold border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all pin-confirm-input" data-index="2" />
                                        <input type="text" maxlength="1" class="w-12 h-12 md:w-14 md:h-14 text-center text-xl md:text-2xl font-bold border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all pin-confirm-input" data-index="3" />
                                        <input type="text" maxlength="1" class="w-12 h-12 md:w-14 md:h-14 text-center text-xl md:text-2xl font-bold border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all pin-confirm-input" data-index="4" />
                                        <input type="text" maxlength="1" class="w-12 h-12 md:w-14 md:h-14 text-center text-xl md:text-2xl font-bold border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all pin-confirm-input" data-index="5" />
                                    </div>
                                    <input type="hidden" name="password_confirmation" id="password-confirmation-hidden" required />
                                </div>

                                <div class="mb-6">
                                    <label class="flex items-start cursor-pointer">
                                        <input type="checkbox" name="terms" class="w-4 h-4 text-red-600 border-gray-300 rounded focus:ring-red-500 mt-1" required>
                                        <span class="ml-2 text-gray-700 text-xs md:text-sm">I agree to the <a href="#" class="text-red-600 hover:text-red-700 font-semibold">Terms of Service</a> and <a href="#" class="text-red-600 hover:text-red-700 font-semibold">Privacy Policy</a></span>
                                    </label>
                                </div>

                                <button 
                                    type="submit" 
                                    class="w-full bg-gradient-to-r from-red-600 to-black text-white py-3 rounded-lg hover:from-red-700 hover:to-gray-900 transition-all transform hover:scale-105 font-semibold shadow-lg"
                                >
                                    Create Account
                                </button>
                            </form>
                        </div>

                        <!-- QR Register Section -->
                        <div id="qr-register-section" class="hidden">
                            <div id="qr-setup-form" class="hidden">
                                <div class="bg-gradient-to-br from-red-50 to-orange-50 rounded-lg p-4 border border-red-200 mb-4">
                                    <p class="text-center text-sm font-semibold text-gray-800 mb-2">✅ Badge Scanned Successfully!</p>
                                    <p class="text-center text-xs text-gray-600" id="qr-badge-name"></p>
                                </div>
                                
                                <form id="qr-registration-form">
                                    <div class="mb-4">
                                        <label class="block text-gray-700 font-semibold mb-2 text-sm">Your Email</label>
                                        <input 
                                            type="email" 
                                            id="qr-email" 
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500" 
                                            placeholder="your@email.com"
                                            required
                                        >
                                    </div>
                                    
                                    <div class="mb-5">
                                        <label class="block text-gray-700 font-semibold mb-2 text-sm">Create 6-Digit PIN</label>
                                        <div class="flex gap-2 justify-center">
                                            <input type="text" maxlength="1" class="w-12 h-12 text-center text-2xl font-bold border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 qr-pin-input" data-index="0" />
                                            <input type="text" maxlength="1" class="w-12 h-12 text-center text-2xl font-bold border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 qr-pin-input" data-index="1" />
                                            <input type="text" maxlength="1" class="w-12 h-12 text-center text-2xl font-bold border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 qr-pin-input" data-index="2" />
                                            <input type="text" maxlength="1" class="w-12 h-12 text-center text-2xl font-bold border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 qr-pin-input" data-index="3" />
                                            <input type="text" maxlength="1" class="w-12 h-12 text-center text-2xl font-bold border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 qr-pin-input" data-index="4" />
                                            <input type="text" maxlength="1" class="w-12 h-12 text-center text-2xl font-bold border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 qr-pin-input" data-index="5" />
                                        </div>
                                    </div>
                                    
                                    <div id="qr-error" class="text-red-500 text-xs text-center mb-3 hidden"></div>
                                    
                                    <button 
                                        type="submit" 
                                        class="w-full bg-gradient-to-r from-red-600 to-black text-white py-3 rounded-lg hover:from-red-700 hover:to-gray-900 font-semibold"
                                    >
                                        Complete Registration
                                    </button>
                                    <button 
                                        type="button"
                                        onclick="cancelQRSetup()"
                                        class="w-full mt-2 bg-gray-200 text-gray-700 py-2 rounded-lg hover:bg-gray-300 font-semibold text-sm"
                                    >
                                        Cancel
                                    </button>
                                </form>
                            </div>
                            
                            <div id="qr-scanner-area">
                                <div class="bg-gradient-to-br from-red-50 to-orange-50 rounded-lg p-4 border border-red-200">
                                    <p class="text-center text-sm text-gray-700 mb-4 font-medium">Scan your Laracon badge to register instantly</p>
                                    <div class="bg-white rounded-lg overflow-hidden shadow-inner">
                                        <video id="qr-video" class="w-full" style="max-height: 280px; object-fit: cover;"></video>
                                    </div>
                                    <div id="qr-result" class="mt-3 text-center text-xs text-gray-600 font-medium"></div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 text-center">
                            <p class="text-gray-600 text-sm">Already have an account? <a href="{{ route('login') }}" class="text-red-600 hover:text-red-700 font-semibold">Login here</a></p>
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
        
        // Check for QR parameter in URL
        const urlParams = new URLSearchParams(window.location.search);
        const qrParam = urlParams.get('qr');
        
        // Mode Toggle
        const qrModeBtn = document.getElementById('qr-mode-btn');
        const manualModeBtn = document.getElementById('manual-mode-btn');
        const qrSection = document.getElementById('qr-register-section');
        const manualSection = document.getElementById('manual-register-section');
        let scanning = false;

        if (qrParam) {
            // Automatically switch to QR mode and show setup form
            qrModeBtn.click();
            showQRSetupForm(qrParam);
        }

        manualModeBtn.addEventListener('click', () => {
            manualModeBtn.classList.add('bg-gradient-to-r', 'from-red-600', 'to-black', 'text-white', 'shadow-md');
            manualModeBtn.classList.remove('text-gray-600', 'hover:bg-white');
            qrModeBtn.classList.remove('bg-gradient-to-r', 'from-red-600', 'to-black', 'text-white', 'shadow-md');
            qrModeBtn.classList.add('text-gray-600', 'hover:bg-white');
            manualSection.classList.remove('hidden');
            qrSection.classList.add('hidden');
            stopQRScanner();
            document.getElementById('name').focus();
        });

        qrModeBtn.addEventListener('click', () => {
            qrModeBtn.classList.add('bg-gradient-to-r', 'from-red-600', 'to-black', 'text-white', 'shadow-md');
            qrModeBtn.classList.remove('text-gray-600', 'hover:bg-white');
            manualModeBtn.classList.remove('bg-gradient-to-r', 'from-red-600', 'to-black', 'text-white', 'shadow-md');
            manualModeBtn.classList.add('text-gray-600', 'hover:bg-white');
            qrSection.classList.remove('hidden');
            manualSection.classList.add('hidden');
            if (!scanning && !qrParam) startQRScanner();
        });

        // PIN Input Handler for manual register
        const pinInputs = document.querySelectorAll('.pin-input');
        const passwordHidden = document.getElementById('password-hidden');
        const pinConfirmInputs = document.querySelectorAll('.pin-confirm-input');
        const passwordConfirmationHidden = document.getElementById('password-confirmation-hidden');

        function setupPinInputs(inputs, hiddenInput) {
            inputs.forEach((input, index) => {
                input.addEventListener('input', (e) => {
                    const value = e.target.value;
                    if (value.length === 1 && index < inputs.length - 1) {
                        inputs[index + 1].focus();
                    }
                    updateHiddenInput(inputs, hiddenInput);
                });

                input.addEventListener('keydown', (e) => {
                    if (e.key === 'Backspace' && !e.target.value && index > 0) {
                        inputs[index - 1].focus();
                    }
                });

                input.addEventListener('paste', (e) => {
                    e.preventDefault();
                    const pastedData = e.clipboardData.getData('text').slice(0, 6);
                    pastedData.split('').forEach((char, i) => {
                        if (inputs[i]) {
                            inputs[i].value = char;
                        }
                    });
                    updateHiddenInput(inputs, hiddenInput);
                    if (pastedData.length === 6) {
                        inputs[5].focus();
                    }
                });
            });
        }

        function updateHiddenInput(inputs, hiddenInput) {
            const pin = Array.from(inputs).map(input => input.value).join('');
            if (hiddenInput) hiddenInput.value = pin;
        }

        setupPinInputs(pinInputs, passwordHidden);
        setupPinInputs(pinConfirmInputs, passwordConfirmationHidden);

        // QR PIN inputs
        const qrPinInputs = document.querySelectorAll('.qr-pin-input');
        setupPinInputs(qrPinInputs, null);

        // QR Registration Form
        document.getElementById('qr-registration-form')?.addEventListener('submit', function(e) {
            e.preventDefault();
            const email = document.getElementById('qr-email').value;
            const pin = Array.from(qrPinInputs).map(input => input.value).join('');
            
            if (pin.length !== 6) {
                document.getElementById('qr-error').textContent = 'Please enter all 6 digits';
                document.getElementById('qr-error').classList.remove('hidden');
                return;
            }
            
            processQRRegistration(currentQRData, email, pin);
        });

        function showQRSetupForm(qrData) {
            try {
                const qrParsed = JSON.parse(qrData);
                currentQRData = qrData;
                document.getElementById('qr-scanner-area').classList.add('hidden');
                document.getElementById('qr-setup-form').classList.remove('hidden');
                document.getElementById('qr-badge-name').textContent = `Badge: ${qrParsed.name || 'Laracon Attendee'}`;
                document.getElementById('qr-email').focus();
            } catch (e) {
                console.error('Error parsing QR data:', e);
            }
        }

        function cancelQRSetup() {
            document.getElementById('qr-setup-form').classList.add('hidden');
            document.getElementById('qr-scanner-area').classList.remove('hidden');
            qrPinInputs.forEach(input => input.value = '');
            document.getElementById('qr-email').value = '';
            document.getElementById('qr-error').classList.add('hidden');
            currentQRData = null;
            if (!scanning) startQRScanner();
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
                    resultDiv.textContent = '✅ QR detected! Setup your account...';
                    scanning = false;
                    stopQRScanner();
                    showQRSetupForm(code.data);
                    return;
                }
            }
            requestAnimationFrame(scanQRCode);
        }

        function processQRRegistration(qrData, email, pin) {
            const startTime = Date.now();
            
            if (window.logApiRequest) {
                logApiRequest({
                    type: 'QR Register Request',
                    url: '{{ route('register') }}',
                    method: 'POST',
                    params: { qr_code: qrData, email: email, pin: pin }
                });
            }
            
            fetch('{{ route('register') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    qr_code: qrData,
                    email: email,
                    pin: pin,
                    laracon_register: true
                })
            })
            .then(response => {
                const duration = Date.now() - startTime;
                if (!response.ok) {
                    return response.json().then(data => {
                        throw { status: response.status, data };
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
                    document.getElementById('qr-result').textContent = '✅ Registration successful! Redirecting...';
                    if (window.logApiRequest) {
                        logApiRequest({
                            type: 'QR Register Success',
                            response: data,
                            statusCode: status,
                            success: true,
                            duration
                        });
                    }
                    window.location.href = data.redirect || '{{ route('dashboard') }}';
                } else {
                    document.getElementById('qr-error').textContent = data.message || 'Registration failed';
                    document.getElementById('qr-error').classList.remove('hidden');
                    if (window.logApiRequest) {
                        logApiRequest({
                            type: 'QR Register Failed',
                            response: data,
                            statusCode: status,
                            success: false,
                            duration
                        });
                    }
                }
            })
            .catch(error => {
                const duration = Date.now() - startTime;
                const errorMessage = error.data?.message || 'Error processing registration';
                document.getElementById('qr-error').textContent = errorMessage;
                document.getElementById('qr-error').classList.remove('hidden');
                if (window.logApiRequest) {
                    logApiRequest({
                        type: 'QR Register Error',
                        error: errorMessage,
                        success: false,
                        duration
                    });
                }
                console.error('QR register error:', error);
            });
        }
    </script>
</body>
</html>
