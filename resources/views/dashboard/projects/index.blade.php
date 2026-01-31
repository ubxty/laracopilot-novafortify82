<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Projects - Laravel Community</title>
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
                        <p class="text-xs text-red-200">My Projects</p>
                    </div>
                </a>
                
                <!-- Desktop Navigation -->
                <div class="flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-base font-medium hover:text-red-200 transition-colors">Home</a>
                    <a href="{{ route('projects.public') }}" class="text-base font-medium hover:text-red-200 transition-colors">Browse Projects</a>
                    <a href="{{ route('dashboard') }}" class="text-base font-medium hover:text-red-200 transition-colors">Dashboard</a>
                    <a href="{{ route('dashboard.projects.index') }}" class="text-base font-medium hover:text-red-200 transition-colors border-b-2 border-red-200 pb-1">My Projects</a>
                    <div class="flex items-center space-x-4 ml-4 pl-4 border-l border-white/30">
                        <span class="text-sm text-red-100">{{ auth()->user()->name }}</span>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-base font-medium hover:text-red-200 transition-colors">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <div class="container mx-auto px-4 py-12">
        @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-lg mb-8">
            {{ session('success') }}
        </div>
        @endif

        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-3xl font-bold text-gray-800 mb-2">My Projects</h2>
                <p class="text-gray-600">Manage and showcase your Laravel projects</p>
            </div>
            <a href="{{ route('dashboard.projects.create') }}" class="bg-gradient-to-r from-red-600 to-black text-white px-6 py-3 rounded-lg font-semibold hover:from-red-700 hover:to-gray-900 transition-all transform hover:scale-105 shadow-lg">
                + Add New Project
            </a>
        </div>

        @if($projects->isEmpty())
            <div class="bg-white rounded-xl shadow-lg p-12 text-center">
                <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <h3 class="text-2xl font-bold text-gray-700 mb-2">No projects yet</h3>
                <p class="text-gray-500 mb-6">Start sharing your amazing Laravel projects with the community</p>
                <a href="{{ route('dashboard.projects.create') }}" class="inline-block bg-red-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-red-700 transition-all transform hover:scale-105 shadow-lg">
                    Create Your First Project
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($projects as $project)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-all">
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $project->name }}</h3>
                                <div class="flex flex-wrap gap-2 mb-3">
                                    <span class="bg-red-100 text-red-800 px-2 py-1 rounded text-xs font-semibold">{{ $project->project_type }}</span>
                                    @if($project->is_published)
                                        <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs font-semibold">Published</span>
                                    @else
                                        <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded text-xs font-semibold">Draft</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $project->short_description }}</p>
                        <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                            <div class="flex items-center space-x-4">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                    {{ number_format($project->stars) }}
                                </span>
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M7.707 3.293a1 1 0 010 1.414L5.414 7H11a7 7 0 017 7v2a1 1 0 11-2 0v-2a5 5 0 00-5-5H5.414l2.293 2.293a1 1 0 11-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ number_format($project->forks) }}
                                </span>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('dashboard.projects.edit', $project->id) }}" class="flex-1 bg-red-600 text-white text-center px-4 py-2 rounded-lg hover:bg-red-700 transition-colors font-medium">
                                Edit
                            </a>
                            <form action="{{ route('dashboard.projects.destroy', $project->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Delete this project?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 transition-colors font-medium">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $projects->links() }}
            </div>
        @endif
    </div>
</body>
</html>
