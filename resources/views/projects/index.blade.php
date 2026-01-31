@extends('layouts.app')

@section('title', 'Browse Projects - Laravel Community')

@section('content')
<div class="bg-gradient-to-br from-gray-900 to-gray-800 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-bold mb-4">Community Projects</h1>
        <p class="text-lg text-gray-300">Discover amazing open-source Laravel projects from developers worldwide</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    @if($projects->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($projects as $project)
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 hover:shadow-md transition-shadow">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">
                        <a href="{{ route('projects.show', $project->id) }}" class="hover:text-red-600 transition-colors">{{ $project->name }}</a>
                    </h3>
                    <p class="text-gray-600 text-sm mb-4">{{ Str::limit($project->description, 120) }}</p>
                    
                    @if($project->tags)
                    <div class="flex flex-wrap gap-2 mb-4">
                        @foreach(explode(',', $project->tags) as $tag)
                        <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded text-xs">{{ trim($tag) }}</span>
                        @endforeach
                    </div>
                    @endif

                    <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                        <div class="flex items-center text-sm text-gray-500">
                            <div class="w-8 h-8 bg-red-600 rounded-full flex items-center justify-center text-white font-bold text-sm mr-2">
                                {{ substr($project->user->name, 0, 1) }}
                            </div>
                            <span>{{ $project->user->name }}</span>
                        </div>
                        <a href="{{ route('projects.show', $project->id) }}" class="text-red-600 hover:text-red-700 font-semibold text-sm">
                            View →
                        </a>
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
            <div class="text-6xl mb-4">🔍</div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">No Projects Found</h3>
            <p class="text-gray-600">Be the first to share a project with the community!</p>
        </div>
    @endif
</div>
@endsection
