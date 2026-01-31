<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Laravel Community</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
                
                <!-- Mobile Menu Button -->
                <button id="mobile-menu-button" class="md:hidden p-2 rounded-lg hover:bg-white/10 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                
                <!-- Desktop Navigation -->
                <div class="hidden md:flex space-x-6">
                    <a href="{{ route('home') }}" class="hover:text-red-200 transition-colors font-medium">Home</a>
                    <a href="{{ route('projects.public') }}" class="hover:text-red-200 transition-colors font-medium">Projects</a>
                    <a href="{{ route('login') }}" class="hover:text-red-200 transition-colors font-medium">Login</a>
                    <a href="{{ route('register') }}" class="bg-white text-red-600 px-4 py-2 rounded-lg hover:bg-gray-100 transition-colors font-medium">Register</a>
                </div>
            </div>
            
            <!-- Mobile Navigation Menu -->
            <div id="mobile-menu" class="hidden md:hidden mt-4 pb-4 space-y-3">
                <a href="{{ route('home') }}" class="block px-4 py-2 rounded-lg hover:bg-white/10 transition-colors font-medium">Home</a>
                <a href="{{ route('projects.public') }}" class="block px-4 py-2 rounded-lg hover:bg-white/10 transition-colors font-medium">Projects</a>
                <a href="{{ route('login') }}" class="block px-4 py-2 rounded-lg hover:bg-white/10 transition-colors font-medium">Login</a>
                <a href="{{ route('register') }}" class="block px-4 py-2 bg-white text-red-600 rounded-lg hover:bg-gray-100 transition-colors font-medium text-center">Register</a>
            </div>
        </nav>
    </header>

    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full">
            <div class="bg-white rounded-xl shadow-lg p-8">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">Create Account</h2>
                    <p class="text-gray-600">Join the Laravel community today</p>
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
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Full Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all">
                        </div>

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

                        <div>
                            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all">
                        </div>

                        <button type="submit" class="w-full bg-gradient-to-r from-red-600 to-black text-white py-3 rounded-lg font-semibold hover:from-red-700 hover:to-gray-900 transition-all transform hover:scale-105 shadow-lg">
                            Create Account
                        </button>
                    </div>
                </form>

                <div class="mt-6 text-center">
                    <p class="text-gray-600">Already have an account? 
                        <a href="{{ route('login') }}" class="text-red-600 font-semibold hover:text-red-700 transition-colors">Sign in</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>
</body>
</html>
