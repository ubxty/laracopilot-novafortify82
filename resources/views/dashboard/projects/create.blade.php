<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Project - Laravel Community</title>
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
                        <p class="text-xs text-red-200">Add Project</p>
                    </div>
                </a>
                
                <div class="flex items-center space-x-8">
                    <a href="{{ route('dashboard') }}" class="text-base font-medium hover:text-red-200 transition-colors">Dashboard</a>
                    <a href="{{ route('dashboard.projects.index') }}" class="text-base font-medium hover:text-red-200 transition-colors">My Projects</a>
                </div>
            </div>
        </nav>
    </header>

    <div class="container mx-auto px-4 py-12">
        <div class="max-w-3xl mx-auto">
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Add New Project</h2>
                <p class="text-gray-600">Share your Laravel project with the community</p>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-8">
                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('dashboard.projects.store') }}" method="POST">
                    @csrf
                    <div class="space-y-6">
                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Project Name *</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all">
                        </div>

                        <div>
                            <label for="project_type" class="block text-sm font-semibold text-gray-700 mb-2">Project Type *</label>
                            <select name="project_type" id="project_type" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all">
                                <option value="">Select Type</option>
                                <option value="Package" {{ old('project_type') == 'Package' ? 'selected' : '' }}>Package</option>
                                <option value="Framework" {{ old('project_type') == 'Framework' ? 'selected' : '' }}>Framework</option>
                                <option value="Starter Kit" {{ old('project_type') == 'Starter Kit' ? 'selected' : '' }}>Starter Kit</option>
                                <option value="Tool" {{ old('project_type') == 'Tool' ? 'selected' : '' }}>Tool</option>
                                <option value="Application" {{ old('project_type') == 'Application' ? 'selected' : '' }}>Application</option>
                            </select>
                        </div>

                        <div>
                            <label for="short_description" class="block text-sm font-semibold text-gray-700 mb-2">Short Description *</label>
                            <textarea name="short_description" id="short_description" rows="2" required
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all">{{ old('short_description') }}</textarea>
                            <p class="text-xs text-gray-500 mt-1">Brief description for listings (max 500 characters)</p>
                        </div>

                        <div>
                            <label for="full_description" class="block text-sm font-semibold text-gray-700 mb-2">Full Description</label>
                            <textarea name="full_description" id="full_description" rows="6"
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all">{{ old('full_description') }}</textarea>
                            <p class="text-xs text-gray-500 mt-1">Detailed project description, features, and usage</p>
                        </div>

                        <div>
                            <label for="github_url" class="block text-sm font-semibold text-gray-700 mb-2">GitHub URL *</label>
                            <input type="url" name="github_url" id="github_url" value="{{ old('github_url') }}" required
                                   placeholder="https://github.com/username/repository"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="demo_url" class="block text-sm font-semibold text-gray-700 mb-2">Demo URL</label>
                                <input type="url" name="demo_url" id="demo_url" value="{{ old('demo_url') }}" placeholder="https://demo.example.com"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all">
                            </div>

                            <div>
                                <label for="documentation_url" class="block text-sm font-semibold text-gray-700 mb-2">Documentation URL</label>
                                <input type="url" name="documentation_url" id="documentation_url" value="{{ old('documentation_url') }}" placeholder="https://docs.example.com"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="stars" class="block text-sm font-semibold text-gray-700 mb-2">GitHub Stars</label>
                                <input type="number" name="stars" id="stars" value="{{ old('stars', 0) }}" min="0"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all">
                            </div>

                            <div>
                                <label for="forks" class="block text-sm font-semibold text-gray-700 mb-2">GitHub Forks</label>
                                <input type="number" name="forks" id="forks" value="{{ old('forks', 0) }}" min="0"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all">
                            </div>
                        </div>

                        <div>
                            <label for="tags" class="block text-sm font-semibold text-gray-700 mb-2">Tags</label>
                            <input type="text" name="tags" id="tags" value="{{ old('tags') }}" placeholder="laravel, api, authentication"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all">
                            <p class="text-xs text-gray-500 mt-1">Comma-separated tags (e.g., laravel, api, authentication)</p>
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" name="is_published" id="is_published" {{ old('is_published', true) ? 'checked' : '' }}
                                   class="w-4 h-4 text-red-600 border-gray-300 rounded focus:ring-red-500">
                            <label for="is_published" class="ml-2 text-sm font-medium text-gray-700">Publish project immediately</label>
                        </div>

                        <div class="flex gap-4 pt-4">
                            <button type="submit" class="flex-1 bg-gradient-to-r from-red-600 to-black text-white py-3 rounded-lg font-semibold hover:from-red-700 hover:to-gray-900 transition-all transform hover:scale-105 shadow-lg">
                                Create Project
                            </button>
                            <a href="{{ route('dashboard.projects.index') }}" class="flex-1 bg-gray-100 text-gray-700 text-center py-3 rounded-lg font-semibold hover:bg-gray-200 transition-all">
                                Cancel
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
