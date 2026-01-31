<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Projects - Laravel Portal</title>
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
                        <a href="{{ route('dashboard') }}" class="hover:bg-blue-700 px-3 py-2 rounded transition">Dashboard</a>
                        <a href="{{ route('dashboard.projects.index') }}" class="bg-blue-700 px-3 py-2 rounded">My Projects</a>
                        <a href="{{ route('opensource.index') }}" class="hover:bg-blue-700 px-3 py-2 rounded transition">Open Source</a>
                    </div>
                </div>
                <div class="flex items-center space-x-2 sm:space-x-4">
                    <span class="text-blue-100 text-sm hidden sm:inline">{{ session('user_name') }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-600 px-2 sm:px-4 py-2 rounded transition text-sm sm:text-base">
                            <i class="fas fa-sign-out-alt mr-1 sm:mr-2"></i><span class="hidden sm:inline">Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 py-6 sm:py-8">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 sm:mb-8 gap-4">
            <h1 class="text-2xl sm:text-3xl font-bold">My Projects</h1>
            <a href="{{ route('dashboard.projects.create') }}" class="w-full sm:w-auto bg-blue-600 text-white px-4 sm:px-6 py-2 sm:py-3 rounded-lg hover:bg-blue-700 transition text-center">
                <i class="fas fa-plus mr-2"></i>New Project
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 text-sm sm:text-base">
                {{ session('success') }}
            </div>
        @endif

        @if($projects->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                @foreach($projects as $project)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300">
                        <div class="bg-gradient-to-r from-blue-500 to-indigo-500 h-2"></div>
                        <div class="p-4 sm:p-6">
                            <div class="flex items-start justify-between mb-4">
                                <h3 class="text-lg sm:text-xl font-bold text-gray-800 flex-1 pr-2">{{ $project->title }}</h3>
                                @if($project->is_public)
                                    <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full whitespace-nowrap">
                                        <i class="fas fa-globe mr-1"></i>Public
                                    </span>
                                @else
                                    <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded-full whitespace-nowrap">
                                        <i class="fas fa-lock mr-1"></i>Private
                                    </span>
                                @endif
                            </div>
                            
                            <p class="text-gray-600 mb-4 line-clamp-3 text-sm sm:text-base">{{ $project->description }}</p>
                            
                            <div class="mb-4">
                                <div class="flex flex-wrap gap-2">
                                    @foreach(array_slice(explode(',', $project->tech_stack), 0, 4) as $tech)
                                        <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">{{ trim($tech) }}</span>
                                    @endforeach
                                </div>
                            </div>
                            
                            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between pt-4 border-t border-gray-200 gap-3">
                                <div class="flex space-x-3">
                                    @if($project->project_url)
                                        <a href="{{ $project->project_url }}" target="_blank" class="text-blue-600 hover:text-blue-800 transition" title="View Project">
                                            <i class="fas fa-external-link-alt"></i>
                                        </a>
                                    @endif
                                    @if($project->github_url)
                                        <a href="{{ $project->github_url }}" target="_blank" class="text-gray-700 hover:text-gray-900 transition" title="View on GitHub">
                                            <i class="fab fa-github"></i>
                                        </a>
                                    @endif
                                </div>
                                <div class="flex space-x-3 w-full sm:w-auto">
                                    <a href="{{ route('dashboard.projects.edit', $project->id) }}" class="flex-1 sm:flex-none text-blue-600 hover:text-blue-800 text-sm">
                                        <i class="fas fa-edit mr-1"></i>Edit
                                    </a>
                                    <form action="{{ route('dashboard.projects.destroy', $project->id) }}" method="POST" class="inline flex-1 sm:flex-none">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full sm:w-auto text-red-600 hover:text-red-800 text-sm" onclick="return confirm('Delete this project?')">
                                            <i class="fas fa-trash mr-1"></i>Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6 sm:mt-8">
                {{ $projects->links() }}
            </div>
        @else
            <div class="text-center py-12 sm:py-16 bg-white rounded-lg shadow">
                <i class="fas fa-folder-open text-gray-300 text-5xl sm:text-6xl mb-4"></i>
                <h3 class="text-xl sm:text-2xl font-bold text-gray-600 mb-2">No Projects Yet</h3>
                <p class="text-gray-500 mb-6 text-sm sm:text-base px-4">Start showcasing your work by creating your first project!</p>
                <a href="{{ route('dashboard.projects.create') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition">
                    <i class="fas fa-plus mr-2"></i>Create Your First Project
                </a>
            </div>
        @endif
    </div>

    <footer class="bg-gray-800 text-white mt-8 sm:mt-12">
        <div class="max-w-7xl mx-auto px-4 py-6 text-center text-xs sm:text-sm">
            <p>© {{ date('Y') }} Laravel Portal. All rights reserved.</p>
            <p class="mt-2">Made with ❤️ by <a href="https://laracopilot.com/" target="_blank" class="hover:underline text-blue-400">LaraCopilot</a></p>
        </div>
    </footer>
</body>
</html>
