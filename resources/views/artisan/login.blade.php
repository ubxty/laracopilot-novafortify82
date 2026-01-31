<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artisan Access - Enter Passcode</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-500 min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full">
        <!-- Login Card -->
        <div class="bg-white rounded-2xl shadow-2xl p-8">
            <div class="text-center mb-8">
                <div class="inline-block bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-full p-4 mb-4">
                    <i class="fas fa-terminal text-4xl"></i>
                </div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Artisan Command Runner</h1>
                <p class="text-gray-600">Enter passcode to access terminal</p>
            </div>

            <!-- Error Message -->
            @if($errors->has('passcode'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 flex items-center">
                    <i class="fas fa-exclamation-circle mr-3"></i>
                    <span>{{ $errors->first('passcode') }}</span>
                </div>
            @endif

            <!-- Login Form -->
            <form action="{{ url('/artisan/authenticate') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-lock mr-2"></i>Passcode
                    </label>
                    <input 
                        type="password" 
                        name="passcode" 
                        placeholder="Enter access passcode" 
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('passcode') border-red-500 @enderror"
                        required
                        autofocus
                    >
                </div>

                <button 
                    type="submit" 
                    class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-bold py-3 rounded-lg transition duration-300 transform hover:scale-105 shadow-lg"
                >
                    <i class="fas fa-sign-in-alt mr-2"></i>Access Terminal
                </button>
            </form>

            <!-- Info Box -->
            <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
                <h3 class="font-semibold text-blue-800 mb-2 flex items-center">
                    <i class="fas fa-info-circle mr-2"></i>Secure Access
                </h3>
                <p class="text-sm text-blue-700">This terminal allows execution of Laravel Artisan commands. Access is restricted to authorized users with the correct passcode.</p>
            </div>

            <!-- Back to Home -->
            <div class="mt-6 text-center">
                <a href="{{ url('/') }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-semibold">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Home
                </a>
            </div>
        </div>

        <!-- Security Badge -->
        <div class="text-center mt-6 text-white">
            <div class="inline-flex items-center bg-white bg-opacity-20 backdrop-blur-sm rounded-full px-4 py-2">
                <i class="fas fa-shield-alt mr-2"></i>
                <span class="text-sm font-semibold">Protected Access</span>
            </div>
        </div>
    </div>
</body>
</html>
