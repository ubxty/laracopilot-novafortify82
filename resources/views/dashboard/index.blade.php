@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-12">
    <div class="max-w-6xl mx-auto px-4">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-800 mb-2">My Dashboard</h1>
            <p class="text-gray-600">Welcome back, {{ session('user_name') }}! Submit and manage your Laravel projects.</p>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg shadow-sm flex items-center">
                <i class="fas fa-check-circle text-2xl mr-3"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Project Submission Form -->
        <div class="bg-white rounded-xl shadow-lg p-8 mb-8">
            <div class="flex items-center mb-6">
                <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white p-3 rounded-lg mr-4">
                    <i class="fas fa-plus-circle text-2xl"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Submit New Project</h2>
                    <p class="text-gray-600">Share your Laravel project with the community</p>
                </div>
            </div>

            <form action="{{ route('dashboard.project.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Project Name -->
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">
                            Project Name <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="name" 
                            value="{{ old('name') }}" 
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all @error('name') border-red-500 @enderror" 
                            placeholder="My Awesome Laravel Package"
                            required
                        >
                        @error('name')
                            <p class="text-red-500 text-sm mt-1 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Project Type -->
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">
                            Project Type <span class="text-red-500">*</span>
                        </label>
                        <select 
                            name="project_type" 
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all @error('project_type') border-red-500 @enderror"
                            required
                        >
                            <option value="">Select Type</option>
                            <option value="Package" {{ old('project_type') == 'Package' ? 'selected' : '' }}>Package</option>
                            <option value="App" {{ old('project_type') == 'App' ? 'selected' : '' }}>Application</option>
                            <option value="Boilerplate" {{ old('project_type') == 'Boilerplate' ? 'selected' : '' }}>Boilerplate</option>
                            <option value="Tool" {{ old('project_type') == 'Tool' ? 'selected' : '' }}>Tool</option>
                        </select>
                        @error('project_type')
                            <p class="text-red-500 text-sm mt-1 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <!-- Short Description -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">
                        Short Description <span class="text-red-500">*</span>
                        <span class="text-gray-500 text-sm font-normal">(Max 300 characters)</span>
                    </label>
                    <input 
                        type="text" 
                        name="short_description" 
                        value="{{ old('short_description') }}" 
                        maxlength="300"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all @error('short_description') border-red-500 @enderror" 
                        placeholder="A brief one-line description of your project"
                        required
                    >
                    @error('short_description')
                        <p class="text-red-500 text-sm mt-1 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Detailed Description -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">
                        Detailed Description <span class="text-red-500">*</span>
                        <span class="text-gray-500 text-sm font-normal">(Markdown supported)</span>
                    </label>
                    <textarea 
                        name="description" 
                        rows="6" 
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all font-mono text-sm @error('description') border-red-500 @enderror" 
                        placeholder="# My Project&#10;&#10;## Features&#10;- Feature 1&#10;- Feature 2&#10;&#10;## Installation&#10;```bash&#10;composer require vendor/package&#10;```"
                        required
                    >{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- GitHub URL -->
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">
                            GitHub Repository URL <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="url" 
                            name="github_url" 
                            value="{{ old('github_url') }}" 
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all @error('github_url') border-red-500 @enderror" 
                            placeholder="https://github.com/username/repo"
                            required
                        >
                        @error('github_url')
                            <p class="text-red-500 text-sm mt-1 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Live Demo URL -->
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">
                            Live Demo URL <span class="text-gray-500 text-sm font-normal">(Optional)</span>
                        </label>
                        <input 
                            type="url" 
                            name="demo_url" 
                            value="{{ old('demo_url') }}" 
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all @error('demo_url') border-red-500 @enderror" 
                            placeholder="https://demo.example.com"
                        >
                        @error('demo_url')
                            <p class="text-red-500 text-sm mt-1 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end pt-4">
                    <button 
                        type="submit" 
                        class="bg-gradient-to-r from-blue-600 to-blue-800 text-white px-8 py-3 rounded-lg hover:from-blue-700 hover:to-blue-900 transition-all duration-300 shadow-lg hover:shadow-xl flex items-center"
                    >
                        <i class="fas fa-paper-plane mr-2"></i>
                        Submit Project
                    </button>
                </div>
            </form>
        </div>

        <!-- User's Projects List -->
        <div class="bg-white rounded-xl shadow-lg p-8">
            <div class="flex items-center mb-6">
                <div class="bg-gradient-to-r from-purple-600 to-purple-800 text-white p-3 rounded-lg mr-4">
                    <i class="fas fa-folder-open text-2xl"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">My Submitted Projects</h2>
                    <p class="text-gray-600">{{ $projects->count() }} project{{ $projects->count() != 1 ? 's' : '' }} submitted</p>
                </div>
            </div>

            @if($projects->count() > 0)
                <div class="space-y-4">
                    @foreach($projects as $project)
                        <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition-all duration-300">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <div class="flex items-center mb-2">
                                        <h3 class="text-xl font-bold text-gray-800 mr-3">{{ $project->name }}</h3>
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $project->active ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                            {{ $project->active ? '✓ Approved' : '⏳ Pending Review' }}
                                        </span>
                                        <span class="ml-2 px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">
                                            {{ $project->project_type }}
                                        </span>
                                    </div>
                                    <p class="text-gray-600 mb-3">{{ $project->short_description }}</p>
                                    <div class="flex items-center space-x-4 text-sm text-gray-500">
                                        <a href="{{ $project->github_url }}" target="_blank" class="flex items-center hover:text-blue-600 transition-colors">
                                            <i class="fab fa-github mr-1"></i>
                                            View Repository
                                        </a>
                                        @if($project->demo_url)
                                            <a href="{{ $project->demo_url }}" target="_blank" class="flex items-center hover:text-blue-600 transition-colors">
                                                <i class="fas fa-external-link-alt mr-1"></i>
                                                Live Demo
                                            </a>
                                        @endif
                                        <span class="flex items-center">
                                            <i class="far fa-calendar mr-1"></i>
                                            {{ $project->created_at->format('M d, Y') }}
                                        </span>
                                    </div>
                                </div>
                                <div>
                                    <form action="{{ route('dashboard.project.delete', $project->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button 
                                            type="submit" 
                                            class="text-red-600 hover:text-red-800 p-2 hover:bg-red-50 rounded transition-all"
                                            onclick="return confirm('Are you sure you want to delete this project?')"
                                        >
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <i class="fas fa-inbox text-6xl text-gray-300 mb-4"></i>
                    <p class="text-gray-500 text-lg">You haven't submitted any projects yet.</p>
                    <p class="text-gray-400">Use the form above to submit your first project!</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
