<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Open Source Community</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-gradient-to-r from-red-600 to-black text-white shadow-lg">
        <nav class="container mx-auto px-4 py-6">
            <div class="flex items-center justify-between">
                <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                    <svg class="w-10 h-10 transform group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"/>
                    </svg>
                    <div class="hidden md:block">
                        <h1 class="text-2xl font-bold">Laravel Community</h1>
                        <p class="text-xs text-red-200">Open Source Projects</p>
                    </div>
                </a>
                
                <!-- Mobile Menu Button -->
                <button id="mobile-menu-button" class="md:hidden p-2 rounded-lg hover:bg-white/10 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                
                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-base font-medium hover:text-red-200 transition-colors border-b-2 border-transparent hover:border-red-200 pb-1">Home</a>
                    <a href="{{ route('projects.public') }}" class="text-base font-medium hover:text-red-200 transition-colors border-b-2 border-transparent hover:border-red-200 pb-1">Browse Projects</a>
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-base font-medium hover:text-red-200 transition-colors border-b-2 border-transparent hover:border-red-200 pb-1">Dashboard</a>
                        <a href="{{ route('dashboard.projects.index') }}" class="text-base font-medium hover:text-red-200 transition-colors border-b-2 border-transparent hover:border-red-200 pb-1">My Projects</a>
                        <div class="flex items-center space-x-4 ml-4 pl-4 border-l border-white/30">
                            <span class="text-sm text-red-100">{{ auth()->user()->name }}</span>
                            <form action="{{ route('logout') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="text-base font-medium hover:text-red-200 transition-colors">Logout</button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-base font-medium hover:text-red-200 transition-colors border-b-2 border-transparent hover:border-red-200 pb-1">Login</a>
                        <a href="{{ route('register') }}" class="bg-white text-red-600 px-6 py-2.5 rounded-lg hover:bg-gray-100 transition-all transform hover:scale-105 font-semibold shadow-lg">Get Started</a>
                    @endauth
                </div>
            </div>
            
            <!-- Mobile Navigation Menu -->
            <div id="mobile-menu" class="hidden md:hidden mt-4 pb-4 space-y-3">
                <a href="{{ route('home') }}" class="block px-4 py-2 rounded-lg hover:bg-white/10 transition-colors font-medium">Home</a>
                <a href="{{ route('projects.public') }}" class="block px-4 py-2 rounded-lg hover:bg-white/10 transition-colors font-medium">Projects</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="block px-4 py-2 rounded-lg hover:bg-white/10 transition-colors font-medium">Dashboard</a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 rounded-lg hover:bg-white/10 transition-colors font-medium">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="block px-4 py-2 rounded-lg hover:bg-white/10 transition-colors font-medium">Login</a>
                    <a href="{{ route('register') }}" class="block px-4 py-2 bg-white text-red-600 rounded-lg hover:bg-gray-100 transition-colors font-medium text-center">Register</a>
                @endauth
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-red-600 to-black text-white py-20">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-4xl md:text-5xl font-bold mb-6">Discover Amazing Open Source Projects</h2>
            <p class="text-xl md:text-2xl mb-8 text-red-100">Built by the Laravel community, for the community</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('projects.public') }}" class="bg-white text-red-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-all transform hover:scale-105 shadow-lg">Browse Projects</a>
                <a href="{{ route('register') }}" class="bg-red-500 text-white px-8 py-3 rounded-lg font-semibold hover:bg-red-400 transition-all transform hover:scale-105 shadow-lg">Submit Your Project</a>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 text-center">
                <div class="p-6">
                    <div class="text-4xl font-bold text-red-600 mb-2">{{ $totalProjects }}</div>
                    <div class="text-gray-600 font-medium">Open Source Projects</div>
                </div>
                <div class="p-6">
                    <div class="text-4xl font-bold text-gray-800 mb-2">{{ $totalStars }}</div>
                    <div class="text-gray-600 font-medium">GitHub Stars</div>
                </div>
                <div class="p-6">
                    <div class="text-4xl font-bold text-red-600 mb-2">{{ $totalDevelopers }}</div>
                    <div class="text-gray-600 font-medium">Active Developers</div>
                </div>
                <div class="p-6">
                    <div class="text-4xl font-bold text-gray-800 mb-2">{{ $totalForks }}</div>
                    <div class="text-gray-600 font-medium">Total Forks</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Projects -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h3 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Featured Projects</h3>
                <p class="text-lg text-gray-600">Handpicked projects from our amazing community</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($featuredProjects as $project)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-all transform hover:-translate-y-1">
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-4">
                            <h4 class="text-xl font-bold text-gray-800">{{ $project->name }}</h4>
                            <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-semibold">{{ $project->project_type }}</span>
                        </div>
                        <p class="text-gray-600 mb-4 line-clamp-2">{{ $project->short_description }}</p>
                        <div class="flex flex-wrap gap-2 mb-4">
                            @if($project->tags)
                                @foreach(json_decode($project->tags) as $tag)
                                    <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded text-xs">{{ $tag }}</span>
                                @endforeach
                            @endif
                        </div>
                        <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                            <div class="flex items-center space-x-4">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                    {{ $project->stars }}
                                </span>
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M7.707 3.293a1 1 0 010 1.414L5.414 7H11a7 7 0 017 7v2a1 1 0 11-2 0v-2a5 5 0 00-5-5H5.414l2.293 2.293a1 1 0 11-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $project->forks }}
                                </span>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ $project->github_url }}" target="_blank" class="flex-1 bg-gray-800 text-white text-center px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors font-medium">
                                <svg class="w-5 h-5 inline mr-1" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                                </svg>
                                GitHub
                            </a>
                            @if($project->demo_url)
                            <a href="{{ $project->demo_url }}" target="_blank" class="flex-1 bg-red-600 text-white text-center px-4 py-2 rounded-lg hover:bg-red-700 transition-colors font-medium">Demo</a>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-12">
                <a href="{{ route('projects.public') }}" class="inline-block bg-red-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-red-700 transition-all transform hover:scale-105 shadow-lg">View All Projects</a>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-red-600 to-black text-white">
        <div class="container mx-auto px-4 text-center">
            <h3 class="text-3xl md:text-4xl font-bold mb-6">Ready to Share Your Project?</h3>
            <p class="text-xl mb-8 text-red-100">Join thousands of developers showcasing their Laravel projects</p>
            <a href="{{ route('register') }}" class="inline-block bg-white text-red-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-all transform hover:scale-105 shadow-lg">Get Started Today</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
                <div class="lg:col-span-1">
                    <div class="flex items-center space-x-2 mb-4">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"/>
                        </svg>
                        <h4 class="text-lg font-bold">Laravel Community</h4>
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed">Discover and share amazing open source Laravel projects built by developers worldwide.</p>
                </div>
                <div>
                    <h4 class="text-lg font-bold mb-4">Platform</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white transition-colors text-sm">Home</a></li>
                        <li><a href="{{ route('projects.public') }}" class="text-gray-400 hover:text-white transition-colors text-sm">Browse Projects</a></li>
                        <li><a href="{{ route('register') }}" class="text-gray-400 hover:text-white transition-colors text-sm">Submit Project</a></li>
                        <li><a href="{{ route('login') }}" class="text-gray-400 hover:text-white transition-colors text-sm">Login</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-bold mb-4">Resources</h4>
                    <ul class="space-y-2">
                        <li><a href="https://laravel.com/docs" target="_blank" class="text-gray-400 hover:text-white transition-colors text-sm">Documentation</a></li>
                        <li><a href="https://github.com/laravel" target="_blank" class="text-gray-400 hover:text-white transition-colors text-sm">GitHub</a></li>
                        <li><a href="https://laracasts.com" target="_blank" class="text-gray-400 hover:text-white transition-colors text-sm">Laracasts</a></li>
                        <li><a href="https://laravel-news.com" target="_blank" class="text-gray-400 hover:text-white transition-colors text-sm">Laravel News</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-bold mb-4">Community</h4>
                    <ul class="space-y-2">
                        <li><a href="https://twitter.com/laravelphp" target="_blank" class="text-gray-400 hover:text-white transition-colors text-sm">Twitter</a></li>
                        <li><a href="https://discord.gg/laravel" target="_blank" class="text-gray-400 hover:text-white transition-colors text-sm">Discord</a></li>
                        <li><a href="https://laracasts.com/discuss" target="_blank" class="text-gray-400 hover:text-white transition-colors text-sm">Forum</a></li>
                        <li><a href="https://github.com/laravel/framework/discussions" target="_blank" class="text-gray-400 hover:text-white transition-colors text-sm">Discussions</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-8">
                <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                    <p class="text-gray-400 text-sm text-center md:text-left">© {{ date('Y') }} Laravel Community Platform. All rights reserved.</p>
                    <div class="flex items-center gap-6">
                        <div class="flex items-center gap-2">
                            <span class="text-gray-400 text-sm">Built with</span>
                            <a href="https://laracopilot.com/" target="_blank" class="hover:opacity-80 transition-opacity">
                                <img src="https://laracopilot.com/wp-content/uploads/2025/09/white-logo.svg" alt="LaraCopilot" class="h-6">
                            </a>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-gray-400 text-sm">Deployed with</span>
                            <a href="https://cloudpanzer.com/" target="_blank" class="hover:opacity-80 transition-opacity">
                                <img src="https://cloudpanzer.com/assets/logo/logo_dark.webp" alt="CloudPanzer" class="h-6">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>
</body>
</html>
