<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Open Source Community</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    @include('partials.header')

    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-red-600 to-black text-white py-16 md:py-24">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-4xl md:text-6xl font-bold mb-6">Welcome to Laravel Community</h2>
            <p class="text-lg md:text-xl text-red-100 mb-8 max-w-3xl mx-auto">Discover, share, and collaborate on amazing Laravel open source projects. Join our vibrant community of developers building the future of web applications.</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('opensource.index') }}" class="px-8 py-4 bg-white text-red-600 rounded-lg hover:bg-red-50 transition-all transform hover:scale-105 font-semibold text-lg shadow-lg">Explore Projects</a>
                <a href="{{ route('register') }}" class="px-8 py-4 bg-red-700 text-white rounded-lg hover:bg-red-800 transition-all transform hover:scale-105 font-semibold text-lg shadow-lg">Join Community</a>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center p-6 rounded-lg bg-gradient-to-br from-red-50 to-white border border-red-100">
                    <div class="text-5xl font-bold text-red-600 mb-2">{{ $stats['total_projects'] }}</div>
                    <div class="text-gray-600 font-medium">Open Source Projects</div>
                </div>
                <div class="text-center p-6 rounded-lg bg-gradient-to-br from-red-50 to-white border border-red-100">
                    <div class="text-5xl font-bold text-red-600 mb-2">{{ $stats['total_users'] }}</div>
                    <div class="text-gray-600 font-medium">Community Members</div>
                </div>
                <div class="text-center p-6 rounded-lg bg-gradient-to-br from-red-50 to-white border border-red-100">
                    <div class="text-5xl font-bold text-red-600 mb-2">{{ $stats['active_this_week'] }}</div>
                    <div class="text-gray-600 font-medium">Active This Week</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Projects -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h3 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Featured Open Source Projects</h3>
                <p class="text-gray-600 text-lg">Discover the most popular and impactful Laravel projects</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($featured_projects as $project)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-all transform hover:-translate-y-2">
                        <div class="p-6">
                            <div class="flex items-start justify-between mb-4">
                                <h4 class="text-xl font-bold text-gray-800">{{ $project->name }}</h4>
                                @if($project->is_featured)
                                    <span class="px-3 py-1 bg-red-100 text-red-600 text-xs font-semibold rounded-full">Featured</span>
                                @endif
                            </div>
                            <p class="text-gray-600 mb-4 line-clamp-3">{{ $project->description }}</p>
                            <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                    {{ $project->github_stars ?? 0 }} stars
                                </span>
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                                    </svg>
                                    {{ $project->github_forks ?? 0 }} forks
                                </span>
                            </div>
                            <div class="flex flex-wrap gap-2 mb-4">
                                @if($project->primary_language)
                                    <span class="px-3 py-1 bg-gray-100 text-gray-700 text-xs rounded-full">{{ $project->primary_language }}</span>
                                @endif
                            </div>
                            <a href="{{ $project->github_url }}" target="_blank" class="block w-full text-center px-4 py-2 bg-gradient-to-r from-red-600 to-black text-white rounded-lg hover:from-red-700 hover:to-gray-900 transition-all font-semibold">
                                View on GitHub →
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-gray-500 text-lg">No featured projects yet. Be the first to contribute!</p>
                    </div>
                @endforelse
            </div>
            
            <div class="text-center mt-12">
                <a href="{{ route('opensource.index') }}" class="inline-block px-8 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors font-semibold text-lg">View All Projects →</a>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-gradient-to-r from-red-600 to-black text-white">
        <div class="container mx-auto px-4 text-center">
            <h3 class="text-3xl md:text-4xl font-bold mb-6">Ready to Share Your Project?</h3>
            <p class="text-lg text-red-100 mb-8 max-w-2xl mx-auto">Join our community and showcase your Laravel projects to developers worldwide. Get feedback, contributions, and recognition.</p>
            <a href="{{ route('register') }}" class="inline-block px-8 py-4 bg-white text-red-600 rounded-lg hover:bg-red-50 transition-all transform hover:scale-105 font-semibold text-lg shadow-lg">Get Started Today</a>
        </div>
    </section>

    @include('partials.footer')
</body>
</html>
