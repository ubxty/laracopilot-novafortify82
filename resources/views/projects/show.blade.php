@extends('layouts.app')

@section('title', $project->name . ' - Laravel Community')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-6">
        <a href="{{ route('projects.public') }}" class="text-red-600 hover:text-red-700 font-semibold">← Back to Projects</a>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $project->name }}</h1>
            
            @if($project->tags)
            <div class="flex flex-wrap gap-2 mb-4">
                @foreach(explode(',', $project->tags) as $tag)
                <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">{{ trim($tag) }}</span>
                @endforeach
            </div>
            @endif

            <div class="flex items-center text-gray-600 mb-6">
                <div class="w-10 h-10 bg-red-600 rounded-full flex items-center justify-center text-white font-bold mr-3">
                    {{ substr($project->user->name, 0, 1) }}
                </div>
                <div>
                    <div class="font-semibold text-gray-900">{{ $project->user->name }}</div>
                    @if($project->user->github_username)
                    <div class="text-sm">
                        <a href="https://github.com/{{ $project->user->github_username }}" target="_blank" class="text-red-600 hover:text-red-700">@{{ $project->user->github_username }}</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="prose max-w-none mb-8">
            <h2 class="text-xl font-bold text-gray-900 mb-3">Description</h2>
            <p class="text-gray-700 leading-relaxed">{{ $project->description }}</p>
        </div>

        <div class="border-t border-gray-200 pt-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div>
                    <h3 class="text-sm font-semibold text-gray-600 mb-2">Repository</h3>
                    <a href="{{ $project->repository_url }}" target="_blank" class="text-red-600 hover:text-red-700 font-semibold break-all">
                        {{ $project->repository_url }}
                    </a>
                </div>
                @if($project->demo_url)
                <div>
                    <h3 class="text-sm font-semibold text-gray-600 mb-2">Live Demo</h3>
                    <a href="{{ $project->demo_url }}" target="_blank" class="text-red-600 hover:text-red-700 font-semibold break-all">
                        {{ $project->demo_url }}
                    </a>
                </div>
                @endif
            </div>

            <div class="flex gap-4">
                <a href="{{ $project->repository_url }}" target="_blank" class="bg-gray-900 text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-800 transition-colors">
                    View on GitHub →
                </a>
                @if($project->demo_url)
                <a href="{{ $project->demo_url }}" target="_blank" class="bg-red-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-red-700 transition-colors">
                    View Demo →
                </a>
                @endif
            </div>
        </div>

        <div class="border-t border-gray-200 mt-6 pt-6 text-sm text-gray-500">
            <div class="flex justify-between">
                <span>Published {{ $project->created_at->diffForHumans() }}</span>
                <span>Last updated {{ $project->updated_at->diffForHumans() }}</span>
            </div>
        </div>
    </div>
</div>
@endsection
