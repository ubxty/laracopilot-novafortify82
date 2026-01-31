@extends('layouts.app')

@section('title', 'Laravel Community Projects - Home')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-br from-red-600 to-red-800 text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-5xl md:text-6xl font-bold mb-6">Laravel Community Projects</h1>
        <p class="text-xl md:text-2xl text-red-100 mb-8 max-w-3xl mx-auto">Discover and share amazing open-source Laravel projects built by the community</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('projects.public') }}" class="bg-white text-red-600 px-8 py-4 rounded-lg font-semibold hover:bg-gray-100 transition-colors">Browse Projects</a>
            <a href="{{ route('register') }}" class="border-2 border-white text-white px-8 py-4 rounded-lg font-semibold hover:bg-white hover:text-red-600 transition-colors">Submit Your Project</a>
        </div>
        <div class="mt-12 bg-white bg-opacity-10 backdrop-blur-sm rounded-lg p-6 inline-block">
            <p class="text-sm text-red-100 mb-2">Valid Laracon QR Codes for Testing:</p>
            <div class="flex flex-wrap gap-2 justify-center text-sm font-mono">
                <span class="bg-white bg-opacity-20 px-3 py-1 rounded">LARACON2024</span>
                <span class="bg-white bg-opacity-20 px-3 py-1 rounded">LARACON-VIP</span>
                <span class="bg-white bg-opacity-20 px-3 py-1 rounded">LARACON-SPEAKER</span>
                <span class="bg-white bg-opacity-20 px-3 py-1 rounded">LARACON-ATTENDEE</span>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
            <div>
                <div class="text-4xl font-bold text-red-600 mb-2">500+</div>
                <div class="text-gray-600">Open Source Projects</div>
            </div>
            <div>
                <div class="text-4xl font-bold text-red-600 mb-2">1,200+</div>
                <div class="text-gray-600">Laravel Developers</div>
            </div>
            <div>
                <div class="text-4xl font-bold text-red-600 mb-2">50+</div>
                <div class="text-gray-600">Countries Represented</div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">How It Works</h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">Join the Laravel community and share your projects in three simple steps</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white rounded-lg p-8 shadow-sm">
                <div class="text-4xl mb-4">🎫</div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">1. Register with QR Code</h3>
                <p class="text-gray-600">Use your Laracon QR code to verify your attendance and create your account</p>
            </div>
            <div class="bg-white rounded-lg p-8 shadow-sm">
                <div class="text-4xl mb-4">📝</div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">2. Submit Your Project</h3>
                <p class="text-gray-600">Share your open-source Laravel projects with the community</p>
            </div>
            <div class="bg-white rounded-lg p-8 shadow-sm">
                <div class="text-4xl mb-4">🌟</div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">3. Get Discovered</h3>
                <p class="text-gray-600">Your projects appear in the public directory for others to discover and use</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 bg-gradient-to-br from-gray-900 to-gray-800 text-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-6">Ready to Share Your Work?</h2>
        <p class="text-lg text-gray-300 mb-8">Join hundreds of Laravel developers showcasing their open-source contributions</p>
        <a href="{{ route('register') }}" class="inline-block bg-red-600 text-white px-8 py-4 rounded-lg font-semibold hover:bg-red-700 transition-colors">Get Started Today</a>
    </div>
</section>
@endsection
