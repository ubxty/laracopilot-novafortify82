<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Laravel Community Projects</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-2xl font-bold bg-gradient-to-r from-red-600 to-orange-500 bg-clip-text text-transparent">
                        Laravel Community
                    </a>
                    <div class="hidden md:flex space-x-6">
                        <a href="{{ route('dashboard') }}" class="text-gray-900 font-medium border-b-2 border-red-500 pb-1">Dashboard</a>
                        <a href="{{ route('projects.index') }}" class="text-gray-600 hover:text-gray-900 transition">Projects</a>
                        <a href="{{ route('projects.create') }}" class="text-gray-600 hover:text-gray-900 transition">Submit Project</a>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-700">{{ $user->name }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-sm text-gray-600 hover:text-red-600 transition">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Welcome Section -->
        <div class="bg-gradient-to-r from-red-600 to-orange-500 rounded-2xl p-8 mb-8 text-white">
            <h1 class="text-4xl font-bold mb-2">Welcome {{ $user->name }} 👋</h1>
            <p class="text-red-100 text-lg">Ready to share your Laravel projects with the community?</p>
        </div>

        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-lg mb-6">
            {{ session('success') }}
        </div>
        @endif

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Total Projects</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_projects'] }}</p>
                    </div>
                    <div class="bg-blue-100 rounded-full p-3">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Published</p>
                        <p class="text-3xl font-bold text-green-600 mt-2">{{ $stats['published_projects'] }}</p>
                    </div>
                    <div class="bg-green-100 rounded-full p-3">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Drafts</p>
                        <p class="text-3xl font-bold text-yellow-600 mt-2">{{ $stats['draft_projects'] }}</p>
                    </div>
                    <div class="bg-yellow-100 rounded-full p-3">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Community</p>
                        <p class="text-3xl font-bold text-purple-600 mt-2">{{ $stats['community_projects'] }}</p>
                    </div>
                    <div class="bg-purple-100 rounded-full p-3">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-xl shadow-sm p-6 mb-8 border border-gray-100">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Quick Actions</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <a href="{{ route('projects.create') }}" class="flex items-center p-4 border-2 border-gray-200 rounded-lg hover:border-red-500 hover:bg-red-50 transition group">
                    <div class="bg-red-100 rounded-full p-3 mr-4 group-hover:bg-red-200 transition">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">New Project</h3>
                        <p class="text-sm text-gray-500">Submit a new project</p>
                    </div>
                </a>

                <a href="{{ route('projects.index') }}" class="flex items-center p-4 border-2 border-gray-200 rounded-lg hover:border-blue-500 hover:bg-blue-50 transition group">
                    <div class="bg-blue-100 rounded-full p-3 mr-4 group-hover:bg-blue-200 transition">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">Browse Projects</h3>
                        <p class="text-sm text-gray-500">Explore community projects</p>
                    </div>
                </a>

                <a href="{{ route('home') }}" class="flex items-center p-4 border-2 border-gray-200 rounded-lg hover:border-purple-500 hover:bg-purple-50 transition group">
                    <div class="bg-purple-100 rounded-full p-3 mr-4 group-hover:bg-purple-200 transition">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">Home</h3>
                        <p class="text-sm text-gray-500">Back to homepage</p>
                    </div>
                </a>
            </div>
        </div>

        <!-- My Projects -->
        <div class="mb-8">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold text-gray-900">My Projects</h2>
                <a href="{{ route('projects.index') }}" class="text-red-600 hover:text-red-700 font-medium">View All →</a>
            </div>

            @if($myProjects->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($myProjects as $project)
                <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100 hover:shadow-md transition">
                    @if($project->image)
                    <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" class="w-full h-48 object-cover">
                    @else
                    <div class="w-full h-48 bg-gradient-to-br from-red-500 to-orange-500 flex items-center justify-center">
                        <svg class="w-16 h-16 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    @endif
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="text-lg font-bold text-gray-900">{{ $project->title }}</h3>
                            @if($project->status === 'published')
                            <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded">Published</span>
                            @else
                            <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs font-medium rounded">Draft</span>
                            @endif
                        </div>
                        <p class="text-gray-600 text-sm mb-4">{{ Str::limit($project->description, 100) }}</p>
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-gray-500">{{ $project->created_at->diffForHumans() }}</span>
                            <a href="{{ route('projects.show', $project) }}" class="text-red-600 hover:text-red-700 text-sm font-medium">View →</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="bg-white rounded-xl shadow-sm p-12 text-center border border-gray-100">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                </svg>
                <h3 class="text-xl font-bold text-gray-900 mb-2">No projects yet</h3>
                <p class="text-gray-600 mb-6">Start by creating your first Laravel project</p>
                <a href="{{ route('projects.create') }}" class="inline-block bg-gradient-to-r from-red-600 to-orange-500 text-white px-6 py-3 rounded-lg font-semibold hover:from-red-700 hover:to-orange-600 transition">
                    Create First Project
                </a>
            </div>
            @endif
        </div>

        <!-- Community Projects -->
        @if($communityProjects->count() > 0)
        <div>
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold text-gray-900">Community Projects</h2>
                <a href="{{ route('projects.index') }}" class="text-red-600 hover:text-red-700 font-medium">Explore More →</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($communityProjects as $project)
                <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100 hover:shadow-md transition">
                    @if($project->image)
                    <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" class="w-full h-48 object-cover">
                    @else
                    <div class="w-full h-48 bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center">
                        <svg class="w-16 h-16 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    @endif
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $project->title }}</h3>
                        <p class="text-gray-600 text-sm mb-4">{{ Str::limit($project->description, 100) }}</p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-gradient-to-br from-red-500 to-orange-500 rounded-full flex items-center justify-center text-white text-xs font-bold mr-2">
                                    {{ substr($project->user->name, 0, 1) }}
                                </div>
                                <span class="text-sm text-gray-700">{{ $project->user->name }}</span>
                            </div>
                            <a href="{{ route('projects.show', $project) }}" class="text-red-600 hover:text-red-700 text-sm font-medium">View →</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white mt-16">
        <div class="max-w-7xl mx-auto px-4 py-12 grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <h3 class="text-xl font-bold mb-4 bg-gradient-to-r from-red-400 to-orange-400 bg-clip-text text-transparent">Laravel Community</h3>
                <p class="text-gray-400 text-sm">A platform to showcase and discover amazing Laravel projects from developers worldwide.</p>
            </div>
            <div>
                <h4 class="font-semibold mb-4">Quick Links</h4>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li><a href="{{ route('home') }}" class="hover:text-white transition">Home</a></li>
                    <li><a href="{{ route('projects.index') }}" class="hover:text-white transition">Projects</a></li>
                    <li><a href="{{ route('dashboard') }}" class="hover:text-white transition">Dashboard</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold mb-4">Community</h4>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li><a href="#" class="hover:text-white transition">Guidelines</a></li>
                    <li><a href="#" class="hover:text-white transition">Support</a></li>
                    <li><a href="#" class="hover:text-white transition">Blog</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold mb-4">Connect</h4>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li><a href="#" class="hover:text-white transition">Twitter</a></li>
                    <li><a href="#" class="hover:text-white transition">GitHub</a></li>
                    <li><a href="#" class="hover:text-white transition">Discord</a></li>
                </ul>
            </div>
        </div>
        <div class="border-t border-gray-800 py-6 text-center text-sm text-gray-400">
            <p>© {{ date('Y') }} Laravel Community Projects. All rights reserved.</p>
            <p class="mt-2">Made with ❤️ by <a href="https://laracopilot.com/" target="_blank" class="hover:underline text-red-400">LaraCopilot</a></p>
        </div>
    </footer>
</body>
</html>
