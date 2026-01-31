@extends('layouts.app')

@section('title', 'Login - Laravel Community')

@section('content')
<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md mx-auto">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-900">Welcome Back</h2>
            <p class="mt-2 text-gray-600">Sign in to your account</p>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-8">
            <form action="{{ route('login') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-red-500 focus:outline-none transition-colors @error('email') border-red-500 @enderror" placeholder="john@example.com" required>
                    @error('email')<span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>@enderror
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2">Password</label>
                    <input type="password" name="password" class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-red-500 focus:outline-none transition-colors @error('password') border-red-500 @enderror" placeholder="••••••••" required>
                    @error('password')<span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>@enderror
                </div>

                <button type="submit" class="w-full bg-red-600 text-white py-3 rounded-lg font-semibold hover:bg-red-700 transition-colors">
                    Sign In
                </button>
            </form>

            <div class="mt-6">
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <p class="text-sm text-blue-900 font-semibold mb-2">Test Credentials:</p>
                    <p class="text-sm text-blue-800">Email: taylor@laravel.com</p>
                    <p class="text-sm text-blue-800">Password: password</p>
                </div>
            </div>

            <div class="mt-6 text-center">
                <p class="text-gray-600">Don't have an account? <a href="{{ route('register') }}" class="text-red-600 hover:text-red-700 font-semibold">Register now</a></p>
            </div>
        </div>
    </div>
</div>
@endsection
