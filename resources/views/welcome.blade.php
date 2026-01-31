<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Portal - Showcase Your Projects</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-2 sm:space-x-8">
                    <a href="{{ route('home') }}" class="text-xl sm:text-2xl font-bold">Laravel Portal</a>
                    <div class="hidden md:flex space-x-4">
                        <a href="{{ route('home') }}" class="bg-blue-700 px-3 py-2 rounded">Home</a>
                        <a href="{{ route('projects.public') }}" class="hover:bg-blue-700 px-3 py-2 rounded transition">Projects</a>
                        <a href="{{ route('opensource.index') }}" class="hover:bg-blue-700 px-3 py-2 rounded transition">Open Source</a>
                    </div>
                </div>
                <div class="flex items-center space-x-2 sm:space-x-4">
                    @if(session('user_id'))
                        <a href="{{ route('dashboard') }}" class="hover:bg-blue-700 px-2 sm:px-4 py-2 rounded transition text-sm sm:text-base">
                            <i class="fas fa-home mr-1 sm:mr-2"></i><span class="hidden sm:inline">Dashboard</span>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="hover:bg-blue-700 px-2 sm:px-4 py-2 rounded transition text-sm sm:text-base">
                            <i class="fas fa-sign-in-alt mr-1 sm:mr-2"></i><span class="hidden sm:inline">Login</span>
                        </a>
                        <a href="{{ route('register') }}" class="bg-white text-blue-600 hover:bg-gray-100 px-2 sm:px-4 py-2 rounded transition font-semibold text-sm sm:text-base">
                            <i class="fas fa-user-plus mr-1 sm:mr-2"></i><span class="hidden sm:inline">Register</span>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white py-12 sm:py-20">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h1 class="text-3xl sm:text-4xl md:text-6xl font-bold mb-4 sm:mb-6">Showcase Your Laravel Projects</h1>
            <p class="text-lg sm:text-xl md:text-2xl mb-6 sm:mb-8 text-blue-100">Build, Share, and Collaborate with Developers Worldwide</p>
            <div class="flex flex-col sm:flex-row justify-center gap-3 sm:gap-4">
                <a href="{{ route('register') }}" class="bg-white text-blue-600 hover:bg-gray-100 px-6 sm:px-8 py-3 sm:py-4 rounded-lg font-bold text-base sm:text-lg transition transform hover:scale-105">
                    <i class="fas fa-rocket mr-2"></i>Get Started Free
                </a>
                <a href="{{ route('projects.public') }}" class="bg-blue-700 hover:bg-blue-800 text-white px-6 sm:px-8 py-3 sm:py-4 rounded-lg font-bold text-base sm:text-lg transition transform hover:scale-105">
                    <i class="fas fa-folder-open mr-2"></i>Explore Projects
                </a>
            </div>
        </div>
    </div>

    <!-- Features Grid -->
    <div class="max-w-7xl mx-auto px-4 py-12 sm:py-16">
        <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-center mb-8 sm:mb-12">Why Choose Laravel Portal?</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
            <div class="bg-white p-6 sm:p-8 rounded-lg shadow-lg hover:shadow-xl transition">
                <div class="text-blue-600 text-4xl sm:text-5xl mb-4">
                    <i class="fas fa-code"></i>
                </div>
                <h3 class="text-xl sm:text-2xl font-bold mb-3 sm:mb-4">Project Showcase</h3>
                <p class="text-gray-600 text-sm sm:text-base">Display your Laravel projects with detailed descriptions, tech stacks, and live demos to potential clients and employers.</p>
            </div>
            <div class="bg-white p-6 sm:p-8 rounded-lg shadow-lg hover:shadow-xl transition">
                <div class="text-blue-600 text-4xl sm:text-5xl mb-4">
                    <i class="fas fa-users"></i>
                </div>
                <h3 class="text-xl sm:text-2xl font-bold mb-3 sm:mb-4">Community Connect</h3>
                <p class="text-gray-600 text-sm sm:text-base">Connect with Laravel developers worldwide, share knowledge, and collaborate on open-source projects.</p>
            </div>
            <div class="bg-white p-6 sm:p-8 rounded-lg shadow-lg hover:shadow-xl transition">
                <div class="text-blue-600 text-4xl sm:text-5xl mb-4">
                    <i class="fas fa-heart"></i>
                </div>
                <h3 class="text-xl sm:text-2xl font-bold mb-3 sm:mb-4">Open Source</h3>
                <p class="text-gray-600 text-sm sm:text-base">Contribute to open-source Laravel projects and build your reputation in the developer community.</p>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="bg-blue-600 text-white py-12 sm:py-16">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8">
                <div class="text-center">
                    <div class="text-3xl sm:text-4xl md:text-5xl font-bold mb-2">500+</div>
                    <div class="text-blue-100 text-sm sm:text-base">Active Projects</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl sm:text-4xl md:text-5xl font-bold mb-2">1,200+</div>
                    <div class="text-blue-100 text-sm sm:text-base">Developers</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl sm:text-4xl md:text-5xl font-bold mb-2">150+</div>
                    <div class="text-blue-100 text-sm sm:text-base">Open Source</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl sm:text-4xl md:text-5xl font-bold mb-2">24/7</div>
                    <div class="text-blue-100 text-sm sm:text-base">Community Support</div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="max-w-7xl mx-auto px-4 py-12 sm:py-16">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-lg shadow-2xl p-8 sm:p-12 text-center text-white">
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-4">Ready to Showcase Your Work?</h2>
            <p class="text-lg sm:text-xl mb-6 sm:mb-8 text-blue-100">Join thousands of developers sharing their Laravel projects</p>
            <a href="{{ route('register') }}" class="inline-block bg-white text-blue-600 hover:bg-gray-100 px-6 sm:px-8 py-3 sm:py-4 rounded-lg font-bold text-base sm:text-lg transition transform hover:scale-105">
                <i class="fas fa-rocket mr-2"></i>Create Free Account
            </a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-12">
        <div class="max-w-7xl mx-auto px-4 py-8 sm:py-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8">
            <div>
                <h3 class="text-lg sm:text-xl font-bold mb-4">Laravel Portal</h3>
                <p class="text-gray-400 text-sm sm:text-base">Your platform for showcasing Laravel projects and connecting with developers.</p>
            </div>
            <div>
                <h4 class="font-semibold mb-4 text-base sm:text-lg">Quick Links</h4>
                <ul class="space-y-2 text-gray-400 text-sm sm:text-base">
                    <li><a href="{{ route('home') }}" class="hover:text-white transition">Home</a></li>
                    <li><a href="{{ route('projects.public') }}" class="hover:text-white transition">Projects</a></li>
                    <li><a href="{{ route('opensource.index') }}" class="hover:text-white transition">Open Source</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold mb-4 text-base sm:text-lg">Community</h4>
                <ul class="space-y-2 text-gray-400 text-sm sm:text-base">
                    <li><a href="{{ route('register') }}" class="hover:text-white transition">Join Now</a></li>
                    <li><a href="{{ route('login') }}" class="hover:text-white transition">Login</a></li>
                    <li><a href="#" class="hover:text-white transition">Guidelines</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold mb-4 text-base sm:text-lg">Connect</h4>
                <div class="flex space-x-4 text-xl sm:text-2xl">
                    <a href="#" class="text-gray-400 hover:text-white transition"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white transition"><i class="fab fa-github"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white transition"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>
        </div>
        <div class="border-t border-gray-700 py-4 sm:py-6 text-center text-xs sm:text-sm">
            <p>© {{ date('Y') }} Laravel Portal. All rights reserved.</p>
            <p class="mt-2">Made with ❤️ by <a href="https://laracopilot.com/" target="_blank" class="hover:underline text-blue-400">LaraCopilot</a></p>
        </div>
    </footer>
</body>
</html>
