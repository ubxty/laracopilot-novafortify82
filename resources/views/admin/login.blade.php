<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Laravel Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-slate-700 via-slate-800 to-slate-900 min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full">
        <!-- Login Card -->
        <div class="bg-white rounded-2xl shadow-2xl p-8">
            <div class="text-center mb-8">
                <div class="inline-block bg-gradient-to-r from-slate-700 to-slate-900 text-white rounded-full p-4 mb-4">
                    <i class="fas fa-user-shield text-4xl"></i>
                </div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Admin Login</h1>
                <p class="text-gray-600">Sign in to access admin dashboard</p>
            </div>

            <!-- Test Credentials Display -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                <h3 class="font-semibold text-blue-800 mb-2 flex items-center">
                    <i class="fas fa-info-circle mr-2"></i>Test Credentials
                </h3>
                <div class="text-sm text-blue-700 space-y-1">
                    <p><strong>Email:</strong> admin@business.com</p>
                    <p><strong>Password:</strong> admin123</p>
                </div>
            </div>

            <!-- Error Message -->
            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 flex items-center">
                    <i class="fas fa-exclamation-circle mr-3"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <!-- Login Form -->
            <form action="{{ route('admin.login') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-envelope mr-2"></i>Email Address
                    </label>
                    <input 
                        type="email" 
                        name="email" 
                        value="{{ old('email') }}" 
                        placeholder="admin@business.com" 
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:border-transparent @error('email') border-red-500 @enderror"
                        required
                        autofocus
                    >
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-lock mr-2"></i>Password
                    </label>
                    <input 
                        type="password" 
                        name="password" 
                        placeholder="Enter your password" 
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:border-transparent @error('password') border-red-500 @enderror"
                        required
                    >
                </div>

                <button 
                    type="submit" 
                    class="w-full bg-gradient-to-r from-slate-700 to-slate-900 hover:from-slate-800 hover:to-black text-white font-bold py-3 rounded-lg transition duration-300 transform hover:scale-105 shadow-lg"
                >
                    <i class="fas fa-sign-in-alt mr-2"></i>Sign In
                </button>
            </form>

            <!-- Back to Home -->
            <div class="mt-6 text-center">
                <a href="{{ route('home') }}" class="text-slate-700 hover:text-slate-900 text-sm font-semibold">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Home
                </a>
            </div>
        </div>

        <!-- Security Badge -->
        <div class="text-center mt-6 text-white">
            <div class="inline-flex items-center bg-white bg-opacity-20 backdrop-blur-sm rounded-full px-4 py-2">
                <i class="fas fa-shield-alt mr-2"></i>
                <span class="text-sm font-semibold">Secure Admin Access</span>
            </div>
        </div>
    </div>
</body>
</html>
