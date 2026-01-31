@extends('layouts.app')

@section('title', 'Register - Laravel Community')

@section('content')
<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md mx-auto">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-900">Create Your Account</h2>
            <p class="mt-2 text-gray-600">Join the Laravel community</p>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-8">
            <form action="{{ route('register') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Full Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-red-500 focus:outline-none transition-colors @error('name') border-red-500 @enderror" placeholder="John Doe" required>
                    @error('name')<span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>@enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-red-500 focus:outline-none transition-colors @error('email') border-red-500 @enderror" placeholder="john@example.com" required>
                    @error('email')<span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>@enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">GitHub Username (Optional)</label>
                    <input type="text" name="github_username" value="{{ old('github_username') }}" class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-red-500 focus:outline-none transition-colors" placeholder="johndoe">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Laracon QR Code</label>
                    <input type="text" name="qr_code" value="{{ old('qr_code') }}" class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-red-500 focus:outline-none transition-colors @error('qr_code') border-red-500 @enderror" placeholder="LARACON2024" required>
                    @error('qr_code')<span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>@enderror
                    <p class="text-sm text-gray-500 mt-1">Valid codes: LARACON2024, LARACON-VIP, LARACON-SPEAKER, LARACON-ATTENDEE</p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Password</label>
                    <input type="password" name="password" class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-red-500 focus:outline-none transition-colors @error('password') border-red-500 @enderror" placeholder="••••••••" required>
                    @error('password')<span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>@enderror
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-red-500 focus:outline-none transition-colors" placeholder="••••••••" required>
                </div>

                <button type="submit" class="w-full bg-red-600 text-white py-3 rounded-lg font-semibold hover:bg-red-700 transition-colors">
                    Create Account
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-gray-600">Already have an account? <a href="{{ route('login') }}" class="text-red-600 hover:text-red-700 font-semibold">Sign in</a></p>
            </div>
        </div>
    </div>
</div>
@endsection
