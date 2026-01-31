<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artisan Command Runner - Laravel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-8">
                    <a href="{{ url('/') }}" class="text-2xl font-bold">Laravel Portal</a>
                    <div class="hidden md:flex space-x-4">
                        <a href="{{ url('/artisan') }}" class="bg-indigo-700 px-3 py-2 rounded">Artisan Terminal</a>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-sm flex items-center">
                        <i class="fas fa-user-shield mr-2"></i>Terminal Access
                    </span>
                    <form action="{{ url('/artisan/logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded transition">
                            <i class="fas fa-sign-out-alt mr-2"></i>Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-terminal text-indigo-600 mr-3"></i>
                    Artisan Command Runner
                </h1>
                <p class="text-gray-600 mt-2">Execute Laravel Artisan commands and view real-time output</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ url('/artisan/refresh') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded transition">
                    <i class="fas fa-sync-alt mr-2"></i>Refresh Logs
                </a>
                <form action="{{ url('/artisan/clear-logs') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded transition" onclick="return confirm('Clear all artisan logs?')">
                        <i class="fas fa-trash mr-2"></i>Clear Logs
                    </button>
                </form>
            </div>
        </div>

        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 flex items-center">
                <i class="fas fa-check-circle mr-3"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 flex items-center">
                <i class="fas fa-exclamation-circle mr-3"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <!-- Command Output -->
        @if(session('command_output'))
            <div class="bg-gray-900 text-green-400 rounded-lg p-6 mb-6 font-mono text-sm overflow-x-auto shadow-lg">
                <div class="flex items-center justify-between mb-3">
                    <h3 class="text-white font-bold flex items-center">
                        <i class="fas fa-code mr-2"></i>
                        Command Output
                    </h3>
                </div>
                <pre class="whitespace-pre-wrap">{{ session('command_output') }}</pre>
            </div>
        @endif

        <!-- Command Form -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-play-circle text-indigo-600 mr-2"></i>
                Execute Artisan Command
            </h2>
            <form action="{{ url('/artisan/run') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Command</label>
                    <div class="flex items-center space-x-2">
                        <span class="bg-gray-100 px-3 py-2 rounded text-gray-600 font-mono">php artisan</span>
                        <input 
                            type="text" 
                            name="command" 
                            placeholder="migrate, cache:clear, route:list, etc." 
                            class="flex-1 border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 font-mono"
                            required
                            autofocus
                        >
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded transition font-semibold">
                            <i class="fas fa-play mr-2"></i>Run
                        </button>
                    </div>
                    @error('command')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>
                <div class="bg-blue-50 border border-blue-200 rounded p-4">
                    <h3 class="font-semibold text-blue-800 mb-2 flex items-center">
                        <i class="fas fa-info-circle mr-2"></i>
                        Common Commands
                    </h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-2 text-sm">
                        <code class="bg-white px-2 py-1 rounded text-gray-700">migrate</code>
                        <code class="bg-white px-2 py-1 rounded text-gray-700">migrate:fresh</code>
                        <code class="bg-white px-2 py-1 rounded text-gray-700">cache:clear</code>
                        <code class="bg-white px-2 py-1 rounded text-gray-700">config:clear</code>
                        <code class="bg-white px-2 py-1 rounded text-gray-700">route:list</code>
                        <code class="bg-white px-2 py-1 rounded text-gray-700">queue:work</code>
                        <code class="bg-white px-2 py-1 rounded text-gray-700">db:seed</code>
                        <code class="bg-white px-2 py-1 rounded text-gray-700">storage:link</code>
                        <code class="bg-white px-2 py-1 rounded text-gray-700">optimize:clear</code>
                    </div>
                </div>
            </form>
        </div>

        <!-- Logs Display -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-file-alt text-indigo-600 mr-2"></i>
                Artisan Logs (Last 50 entries)
            </h2>
            
            @if(count($logs) > 0)
                <div class="bg-gray-900 rounded-lg p-4 overflow-x-auto">
                    <div class="font-mono text-xs space-y-1">
                        @foreach($logs as $log)
                            <div class="@if(str_contains($log, '.ERROR:')) text-red-400 @elseif(str_contains($log, '.INFO:')) text-green-400 @else text-gray-400 @endif">
                                {{ $log }}
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="text-center py-12 text-gray-500">
                    <i class="fas fa-inbox text-6xl mb-4 text-gray-300"></i>
                    <p class="text-lg">No logs available yet</p>
                    <p class="text-sm">Execute a command to see logs appear here</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-12">
        <div class="max-w-7xl mx-auto px-4 py-6 text-center">
            <p>© {{ date('Y') }} Laravel Portal. All rights reserved.</p>
            <p class="mt-2 text-sm">Made with ❤️ by <a href="https://laracopilot.com/" target="_blank" class="hover:underline text-indigo-400">LaraCopilot</a></p>
        </div>
    </footer>
</body>
</html>
