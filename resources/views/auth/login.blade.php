@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-red-50 to-pink-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full">
        <div class="bg-white rounded-2xl shadow-xl p-8">
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-red-600 to-pink-600 rounded-full mb-4">
                    <i class="fas fa-sign-in-alt text-white text-3xl"></i>
                </div>
                <h2 class="text-3xl font-bold text-gray-900">Welcome Back</h2>
                <p class="mt-2 text-gray-600">Sign in to your account</p>
            </div>

            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf

                @if($errors->any())
                <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                    <div class="flex items-center space-x-2 text-red-800">
                        <i class="fas fa-exclamation-circle"></i>
                        <span>{{ $errors->first() }}</span>
                    </div>
                </div>
                @endif

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-envelope text-gray-400"></i> Email Address
                    </label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent @error('email') border-red-500 @enderror"
                        placeholder="Enter your email">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-lock text-gray-400"></i> Password
                    </label>
                    <input type="password" name="password" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                        placeholder="Enter your password">
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-red-600 to-pink-600 text-white px-6 py-3 rounded-lg hover:from-red-700 hover:to-pink-700 transition font-semibold">
                    <i class="fas fa-sign-in-alt"></i> Sign In
                </button>
            </form>

            <!-- QR Registration Option -->
            <div class="mt-8 pt-6 border-t border-gray-200">
                <div class="text-center mb-4">
                    <p class="text-sm text-gray-600">New here?</p>
                </div>
                <a href="{{ route('qr.register') }}" class="block w-full bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-6 py-3 rounded-lg hover:from-purple-700 hover:to-indigo-700 transition font-semibold text-center">
                    <i class="fas fa-qrcode"></i> Scan Your QR to Get Started
                </a>
                <div class="text-center mt-4">
                    <span class="text-sm text-gray-600">or</span>
                    <a href="{{ route('register') }}" class="ml-2 text-sm text-red-600 hover:text-red-700 font-semibold">
                        Register with Email
                    </a>
                </div>
            </div>
        </div>

        <div class="mt-6 text-center">
            <a href="/" class="text-gray-600 hover:text-gray-900">
                <i class="fas fa-home"></i> Back to home
            </a>
        </div>
    </div>
</div>
@endsection
