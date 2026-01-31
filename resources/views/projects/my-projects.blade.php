@extends('layouts.app')

@section('title', 'My Projects - Laravel Community')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">My Projects</h1>
            <p class="text-gray-600 mt-2">Manage your submitted projects</p>
        </div>
        <a href="{{ route('projects.create') }}" class="bg-red-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-red-700 transition-colors">
            ➕ New Project
        </a>
    </div>

    @if($projects->count() > 0)
        <div class="space-y-4">
            @foreach($projects as $project)
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex justify-between items-start">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-2">
                            <h3 class="text-xl font-bold text-gray-900">{{ $project->name }}</h3>
                            @if($project->is_published)
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs font-semibold">Published</span>
                            @else
                                <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs font-semibold">Draft</span>
                            @endif
                        </div>
                        <p class="text-gray-600 mb-3">{{ Str::limit($project->description, 150) }}</p>
                        
                        @if($project->tags)
                        <div class="flex flex-wrap gap-2 mb-3">
                            @foreach(explode(',', $project->tags) as $tag)
                            <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded text-xs">{{ trim($tag) }}</span>
                            @endforeach
                        </div>
                        @endif

                        <div class="flex items-center gap-4 text-sm text-gray-500">
                            <span>Created {{ $project->created_at->diffForHumans() }}</span>
                            <span>•</span>
                            <a href="{{ $project->repository_url }}" target="_blank" class="text-red-600 hover:text-red-700">GitHub →</a>
                            @if($project->is_published)
                                <span>•</span>
                                <a href="{{ route('projects.show', $project->id) }}" class="text-red-600 hover:text-red-700">Public View →</a>
                            @endif
                        </div>
                    </div>
                    <div class="flex gap-2 ml-4">
                        <a href="{{ route('projects.edit', $project->id) }}" class="bg-gray-100 text-gray-900 px-4 py-2 rounded-lg font-semibold hover:bg-gray-200 transition-colors">
                            Edit
                        </a>
                        <form action="{{ route('projects.destroy', $project->id) }}" method="POST" onsubmit="return confirm('Delete this project?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-50 text-red-600 px-4 py-2 rounded-lg font-semibold hover:bg-red-100 transition-colors">
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
    @else
        <div class="bg-white rounded-lg shadow-sm p-12 text-center">
            <div class="text-6xl mb-4">📦</div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">No Projects Yet</h3>
            <p class="text-gray-600 mb-6">Start sharing your Laravel projects with the community</p>
            <a href="{{ route('projects.create') }}" class="inline-block bg-red-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-red-700 transition-colors">
                Submit Your First Project
            </a>
        </div>
    @endif
</div>
@endsection
