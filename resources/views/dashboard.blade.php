@extends('layouts.app')

@section('title', 'Dashboard - Laravel Community')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Welcome back, {{ $user->name }}! 👋</h1>
        <p class="text-gray-600 mt-2">Manage your projects and profile</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-red-600">
            <div class="text-gray-600 text-sm font-semibold">Total Projects</div>
            <div class="text-3xl font-bold text-gray-900 mt-2">{{ $projectsCount }}</div>
        </div>
        <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-green-600">
            <div class="text-gray-600 text-sm font-semibold">Account Status</div>
            <div class="text-lg font-semibold text-green-600 mt-2">✓ QR Verified</div>
        </div>
        <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-blue-600">
            <div class="text-gray-600 text-sm font-semibold">Member Since</div>
            <div class="text-lg font-semibold text-gray-900 mt-2">{{ $user->created_at->format('M Y') }}</div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
        <h2 class="text-xl font-bold text-gray-900 mb-4">Quick Actions</h2>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('projects.create') }}" class="bg-red-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-red-700 transition-colors">
                ➕ Submit New Project
            </a>
            <a href="{{ route('projects.my') }}" class="bg-gray-100 text-gray-900 px-6 py-3 rounded-lg font-semibold hover:bg-gray-200 transition-colors">
                📁 My Projects
            </a>
            <a href="{{ route('projects.public') }}" class="bg-gray-100 text-gray-900 px-6 py-3 rounded-lg font-semibold hover:bg-gray-200 transition-colors">
                🌍 Browse Community
            </a>
        </div>
    </div>

    <!-- Recent Projects -->
    @if($recentProjects->count() > 0)
    <div class="bg-white rounded-lg shadow-sm p-6">
        <h2 class="text-xl font-bold text-gray-900 mb-4">Recent Projects</h2>
        <div class="space-y-3">
            @foreach($recentProjects as $project)
            <div class="border border-gray-200 rounded-lg p-4 hover:border-red-300 transition-colors">
                <div class="flex justify-between items-start">
                    <div class="flex-1">
                        <h3 class="font-semibold text-gray-900">{{ $project->name }}</h3>
                        <p class="text-gray-600 text-sm mt-1">{{ Str::limit($project->description, 100) }}</p>
                        <div class="flex items-center gap-4 mt-2 text-sm text-gray-500">
                            <span>{{ $project->created_at->diffForHumans() }}</span>
                            @if($project->is_published)
                                <span class="text-green-600">✓ Published</span>
                            @else
                                <span class="text-gray-400">Draft</span>
                            @endif
                        </div>
                    </div>
                    <a href="{{ route('projects.edit', $project->id) }}" class="text-red-600 hover:text-red-700 font-semibold text-sm">
                        Edit →
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        <div class="mt-4">
            <a href="{{ route('projects.my') }}" class="text-red-600 hover:text-red-700 font-semibold">View all projects →</a>
        </div>
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
