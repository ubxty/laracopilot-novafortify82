@extends('layouts.app')

@section('title', 'Submit Project - Laravel Community')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-6">
        <a href="{{ route('projects.my') }}" class="text-red-600 hover:text-red-700 font-semibold">← Back to My Projects</a>
    </div>

    <div class="bg-white rounded-lg shadow-sm p-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Submit New Project</h1>
        <p class="text-gray-600 mb-8">Share your open-source Laravel project with the community</p>

        <form action="{{ route('projects.store') }}" method="POST">
            @csrf

            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">Project Name</label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-red-500 focus:outline-none transition-colors @error('name') border-red-500 @enderror" placeholder="Laravel Awesome Package" required>
                @error('name')<span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>@enderror
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">Description</label>
                <textarea name="description" rows="6" class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-red-500 focus:outline-none transition-colors @error('description') border-red-500 @enderror" placeholder="Describe what your project does and why it's useful..." required>{{ old('description') }}</textarea>
                @error('description')<span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>@enderror
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">Repository URL</label>
                <input type="url" name="repository_url" value="{{ old('repository_url') }}" class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-red-500 focus:outline-none transition-colors @error('repository_url') border-red-500 @enderror" placeholder="https://github.com/username/project" required>
                @error('repository_url')<span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>@enderror
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">Demo URL (Optional)</label>
                <input type="url" name="demo_url" value="{{ old('demo_url') }}" class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-red-500 focus:outline-none transition-colors @error('demo_url') border-red-500 @enderror" placeholder="https://demo.example.com">
                @error('demo_url')<span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>@enderror
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">Tags (comma-separated)</label>
                <input type="text" name="tags" value="{{ old('tags') }}" class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-red-500 focus:outline-none transition-colors" placeholder="api, authentication, middleware, package">
                <p class="text-sm text-gray-500 mt-1">Example: api, authentication, middleware, package</p>
            </div>

            <div class="mb-8">
                <label class="flex items-center">
                    <input type="checkbox" name="is_published" value="1" {{ old('is_published') ? 'checked' : '' }} class="w-5 h-5 text-red-600 border-gray-300 rounded focus:ring-red-500">
                    <span class="ml-3 text-gray-700 font-semibold">Publish immediately (make visible to community)</span>
                </label>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="bg-red-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-red-700 transition-colors">
                    Submit Project
                </button>
                <a href="{{ route('projects.my') }}" class="bg-gray-100 text-gray-900 px-8 py-3 rounded-lg font-semibold hover:bg-gray-200 transition-colors">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
