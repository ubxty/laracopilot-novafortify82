<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Public Projects - Laravel Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-2xl font-bold">Laravel Portal</a>
                    <div class="hidden md:flex space-x-4">
                        <a href="{{ route('home') }}" class="hover:bg-blue-700 px-3 py-2 rounded transition">Home</a>
                        <a href="{{ route('projects.public') }}" class="bg-blue-700 px-3 py-2 rounded">Projects</a>
                        <a href="{{ route('opensource.index') }}" class="hover:bg-blue-700 px-3 py-2 rounded transition">Open Source</a>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    @if(session('user_id'))
                        <a href="{{ route('dashboard') }}" class="hover:bg-blue-700 px-4 py-2 rounded transition">
                            <i class="fas fa-home mr-2"></i>Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="hover:bg-blue-700 px-4 py-2 rounded transition">
                            <i class="fas fa-sign-in-alt mr-2"></i>Login
                        </a>
                        <a href="{{ route('register') }}" class="bg-white text-blue-600 hover:bg-gray-100 px-4 py-2 rounded transition font-semibold">
                            <i class="fas fa-user-plus mr-2"></i>Register
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h1 class="text-5xl font-bold mb-4 flex items-center justify-center">
                <i class="fas fa-folder-open mr-4"></i>
                Public Projects
            </h1>
            <p class="text-xl text-blue-100">Explore amazing projects shared by our community</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-12">
        @if($projects->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($projects as $project)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        <div class="bg-gradient-to-r from-blue-500 to-indigo-500 h-2"></div>
                        <div class="p-6">
                            <div class="flex items-start justify-between mb-4">
                                <h3 class="text-xl font-bold text-gray-800 flex-1">{{ $project->title }}</h3>
                                <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">
                                    <i class="fas fa-globe mr-1"></i>Public
                                </span>
                            </div>
                            
                            <p class="text-gray-600 mb-4 line-clamp-3">{{ $project->description }}</p>
                            
                            <div class="mb-4">
                                <div class="flex flex-wrap gap-2">
                                    @foreach(explode(',', $project->tech_stack) as $tech)
                                        <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">{{ trim($tech) }}</span>
                                    @endforeach
                                </div>
                            </div>
                            
                            <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                                <div class="flex space-x-3">
                                    @if($project->project_url)
                                        <a href="{{ $project->project_url }}" target="_blank" class="text-blue-600 hover:text-blue-800 transition">
                                            <i class="fas fa-external-link-alt"></i>
                                        </a>
                                    @endif
                                    @if($project->github_url)
                                        <a href="{{ $project->github_url }}" target="_blank" class="text-gray-700 hover:text-gray-900 transition">
                                            <i class="fab fa-github"></i>
                                        </a>
                                    @endif
                                </div>
                                <span class="text-xs text-gray-500">
                                    <i class="far fa-calendar mr-1"></i>{{ $project->created_at->format('M d, Y') }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $projects->links() }}
            </div>
        @else
            <div class="text-center py-16">
                <i class="fas fa-folder-open text-gray-300 text-6xl mb-4"></i>
                <h3 class="text-2xl font-bold text-gray-600 mb-2">No Public Projects Yet</h3>
                <p class="text-gray-500">Be the first to share a project with the community!</p>
                @if(session('user_id'))
                    <a href="{{ route('projects.create') }}" class="inline-block mt-6 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition">
                        <i class="fas fa-plus mr-2"></i>Create Project
                    </a>
                @else
                    <a href="{{ route('register') }}" class="inline-block mt-6 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition">
                        <i class="fas fa-user-plus mr-2"></i>Join Now
                    </a>
                @endif
            </div>
        @endif
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-12">
        <div class="max-w-7xl mx-auto px-4 py-12 grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <h3 class="text-xl font-bold mb-4">Laravel Portal</h3>
                <p class="text-gray-400">Your platform for showcasing Laravel projects and connecting with developers.</p>
            </div>
            <div>
                <h4 class="font-semibold mb-4">Quick Links</h4>
                <ul class="space-y-2 text-gray-400">
                    <li><a href="{{ route('home') }}" class="hover:text-white transition">Home</a></li>
                    <li><a href="{{ route('projects.public') }}" class="hover:text-white transition">Projects</a></li>
                    <li><a href="{{ route('opensource.index') }}" class="hover:text-white transition">Open Source</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold mb-4">Community</h4>
                <ul class="space-y-2 text-gray-400">
                    <li><a href="{{ route('register') }}" class="hover:text-white transition">Join Now</a></li>
                    <li><a href="{{ route('login') }}" class="hover:text-white transition">Login</a></li>
                    <li><a href="#" class="hover:text-white transition">Guidelines</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold mb-4">Connect</h4>
                <div class="flex space-x-4 text-2xl">
                    <a href="#" class="text-gray-400 hover:text-white transition"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white transition"><i class="fab fa-github"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white transition"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>
        </div>
        <div class="border-t border-gray-700 py-6 text-center text-sm">
            <p>© {{ date('Y') }} Laravel Portal. All rights reserved.</p>
            <p class="mt-2">Made with ❤️ by <a href="https://laracopilot.com/" target="_blank" class="hover:underline text-blue-400">LaraCopilot</a></p>
        </div>
    </footer>
</body>
</html>
