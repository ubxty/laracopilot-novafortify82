<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laravel Community Projects')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-xl font-bold text-gray-900">Laravel<span class="text-red-600">Community</span></a>
                    <div class="hidden md:flex space-x-6">
                        <a href="{{ route('home') }}" class="text-gray-600 hover:text-gray-900 transition-colors">Home</a>
                        <a href="{{ route('projects.public') }}" class="text-gray-600 hover:text-gray-900 transition-colors">Projects</a>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    @if(session('user_logged_in'))
                        <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-gray-900 transition-colors">Dashboard</a>
                        <a href="{{ route('projects.my') }}" class="text-gray-600 hover:text-gray-900 transition-colors">My Projects</a>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-600 hover:text-gray-900 transition-colors">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900 transition-colors">Login</a>
                        <a href="{{ route('register') }}" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors">Register</a>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg">
                {{ session('error') }}
            </div>
        </div>
    @endif

    <!-- Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-16">
        <div class="max-w-7xl mx-auto px-4 py-12 grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <h3 class="text-lg font-bold text-gray-900 mb-4">Laravel<span class="text-red-600">Community</span></h3>
                <p class="text-gray-600 text-sm">A community-driven platform for Laravel developers to showcase their open-source projects.</p>
            </div>
            <div>
                <h4 class="text-sm font-semibold text-gray-900 mb-4">Quick Links</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('home') }}" class="text-gray-600 hover:text-gray-900">Home</a></li>
                    <li><a href="{{ route('projects.public') }}" class="text-gray-600 hover:text-gray-900">Projects</a></li>
                    <li><a href="{{ route('register') }}" class="text-gray-600 hover:text-gray-900">Register</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-sm font-semibold text-gray-900 mb-4">Resources</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="https://laravel.com" target="_blank" class="text-gray-600 hover:text-gray-900">Laravel Docs</a></li>
                    <li><a href="https://laracasts.com" target="_blank" class="text-gray-600 hover:text-gray-900">Laracasts</a></li>
                    <li><a href="https://laravel-news.com" target="_blank" class="text-gray-600 hover:text-gray-900">Laravel News</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-sm font-semibold text-gray-900 mb-4">Connect</h4>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li>📧 community@laravel.com</li>
                    <li>🐦 @laravelcommunity</li>
                    <li>💬 Join our Discord</li>
                </ul>
            </div>
        </div>
        <div class="border-t border-gray-200 py-6 text-center text-sm text-gray-600">
            <p>© {{ date('Y') }} Laravel Community. All rights reserved.</p>
            <p class="mt-2">Made with ❤️ by <a href="https://laracopilot.com/" target="_blank" class="hover:underline text-red-600">LaraCopilot</a></p>
        </div>
    </footer>
</body>
</html>
