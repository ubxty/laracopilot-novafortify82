<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Community Projects</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
    <!-- Navigation -->
    <nav class="bg-gradient-to-r from-red-600 to-pink-600 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-8">
                    <a href="/" class="text-2xl font-bold hover:text-gray-200 transition">
                        <i class="fas fa-code"></i> Laravel Community
                    </a>
                    <div class="hidden md:flex space-x-6">
                        <a href="/" class="hover:text-gray-200 transition {{ request()->is('/') ? 'border-b-2 border-white' : '' }}">Home</a>
                        <a href="/projects" class="hover:text-gray-200 transition {{ request()->is('projects') ? 'border-b-2 border-white' : '' }}">Projects</a>
                        @if(session('user_logged_in'))
                            <a href="/dashboard" class="hover:text-gray-200 transition {{ request()->is('dashboard') ? 'border-b-2 border-white' : '' }}">Dashboard</a>
                            <a href="/my-projects" class="hover:text-gray-200 transition {{ request()->is('my-projects') ? 'border-b-2 border-white' : '' }}">My Projects</a>
                        @endif
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    @if(session('user_logged_in'))
                        <div class="hidden md:flex items-center space-x-4">
                            <span class="text-sm">Welcome, <strong>{{ session('user_name') }}</strong></span>
                            <form action="/logout" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="bg-white text-red-600 px-4 py-2 rounded-lg hover:bg-gray-100 transition font-semibold">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </button>
                            </form>
                        </div>
                    @else
                        <a href="/login" class="bg-white text-red-600 px-4 py-2 rounded-lg hover:bg-gray-100 transition font-semibold">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </a>
                        <a href="/register" class="bg-pink-700 text-white px-4 py-2 rounded-lg hover:bg-pink-800 transition font-semibold">
                            <i class="fas fa-user-plus"></i> Register
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white mt-16">
        <div class="max-w-7xl mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- About -->
                <div>
                    <h3 class="text-xl font-bold mb-4">
                        <i class="fas fa-code"></i> Laravel Community
                    </h3>
                    <p class="text-gray-400 mb-4">
                        A platform for Laravel developers to showcase their open-source projects and connect with the community.
                    </p>
                    <div class="flex space-x-4">
                        <a href="https://twitter.com/laravelcommunity" target="_blank" class="text-gray-400 hover:text-white transition">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                        <a href="https://github.com/laravel" target="_blank" class="text-gray-400 hover:text-white transition">
                            <i class="fab fa-github text-xl"></i>
                        </a>
                        <a href="https://discord.gg/laravel" target="_blank" class="text-gray-400 hover:text-white transition">
                            <i class="fab fa-discord text-xl"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-xl font-bold mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="/" class="text-gray-400 hover:text-white transition"><i class="fas fa-home"></i> Home</a></li>
                        <li><a href="/projects" class="text-gray-400 hover:text-white transition"><i class="fas fa-folder"></i> Browse Projects</a></li>
                        @if(session('user_logged_in'))
                            <li><a href="/dashboard" class="text-gray-400 hover:text-white transition"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                            <li><a href="/my-projects" class="text-gray-400 hover:text-white transition"><i class="fas fa-briefcase"></i> My Projects</a></li>
                        @else
                            <li><a href="/register" class="text-gray-400 hover:text-white transition"><i class="fas fa-user-plus"></i> Register</a></li>
                            <li><a href="/login" class="text-gray-400 hover:text-white transition"><i class="fas fa-sign-in-alt"></i> Login</a></li>
                        @endif
                    </ul>
                </div>

                <!-- Resources -->
                <div>
                    <h3 class="text-xl font-bold mb-4">Resources</h3>
                    <ul class="space-y-2">
                        <li><a href="https://laravel.com/docs" target="_blank" class="text-gray-400 hover:text-white transition"><i class="fas fa-book"></i> Documentation</a></li>
                        <li><a href="https://laracasts.com" target="_blank" class="text-gray-400 hover:text-white transition"><i class="fas fa-video"></i> Laracasts</a></li>
                        <li><a href="https://laravel-news.com" target="_blank" class="text-gray-400 hover:text-white transition"><i class="fas fa-newspaper"></i> Laravel News</a></li>
                        <li><a href="https://forge.laravel.com" target="_blank" class="text-gray-400 hover:text-white transition"><i class="fas fa-server"></i> Laravel Forge</a></li>
                    </ul>
                </div>

                <!-- Community -->
                <div>
                    <h3 class="text-xl font-bold mb-4">Community</h3>
                    <ul class="space-y-2">
                        <li><a href="https://laracon.net" target="_blank" class="text-gray-400 hover:text-white transition"><i class="fas fa-users"></i> Laracon</a></li>
                        <li><a href="https://larajobs.com" target="_blank" class="text-gray-400 hover:text-white transition"><i class="fas fa-briefcase"></i> Larajobs</a></li>
                        <li><a href="https://laravel.io" target="_blank" class="text-gray-400 hover:text-white transition"><i class="fas fa-comments"></i> Laravel.io</a></li>
                        <li><a href="https://github.com/laravel/laravel/discussions" target="_blank" class="text-gray-400 hover:text-white transition"><i class="fab fa-github"></i> Discussions</a></li>
                    </ul>
                </div>
            </div>

            <!-- CloudPanzer Deployment Badge -->
            <div class="border-t border-gray-800 mt-8 pt-8">
                <div class="flex flex-col md:flex-row items-center justify-between space-y-4 md:space-y-0">
                    <div class="text-center md:text-left">
                        <p class="text-gray-400 text-sm">© {{ date('Y') }} Laravel Community. All rights reserved.</p>
                        <p class="text-gray-500 text-sm mt-1">
                            Made with <span class="text-red-500">❤️</span> by 
                            <a href="https://laracopilot.com/" target="_blank" class="text-pink-400 hover:text-pink-300 transition font-semibold">LaraCopilot</a>
                        </p>
                    </div>
                    
                    <!-- CloudPanzer Badge -->
                    <div class="flex items-center space-x-3 bg-gray-800 px-6 py-3 rounded-lg border border-gray-700 hover:border-gray-600 transition">
                        <span class="text-gray-400 text-sm font-medium">Deployed by</span>
                        <a href="https://cloudpanzer.com" target="_blank" class="block">
                            <img src="https://cloudpanzer.com/assets/logo/logo_dark.webp" alt="CloudPanzer" class="h-8 w-auto hover:opacity-80 transition">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
