<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auth Debug Logs - Laravel Community</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .log-entry { transition: all 0.3s; }
        .log-entry:hover { transform: translateX(4px); }
        .context-json { max-height: 0; overflow: hidden; transition: max-height 0.3s ease; }
        .context-json.expanded { max-height: 2000px; }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">🔍 Auth Debug Logs</h1>
                    <p class="text-gray-600 mt-1">Real-time authentication and registration debugging</p>
                    @if($fileSize > 0)
                        <p class="text-xs text-gray-500 mt-1">File size: {{ number_format($fileSize / 1024, 2) }} KB</p>
                    @endif
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('home') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors">
                        ← Home
                    </a>
                    <a href="{{ route('debug.logs.test') }}" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition-colors">
                        🧪 Test Log
                    </a>
                    <form action="{{ route('debug.logs.download') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors">
                            📥 Download
                        </button>
                    </form>
                    <form action="{{ route('debug.logs.clear') }}" method="POST" class="inline" onsubmit="return confirm('Clear all auth logs?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition-colors">
                            🗑️ Clear
                        </button>
                    </form>
                </div>
            </div>

            <!-- Permission Status -->
            @if($storagePermissions)
                <div class="mb-4 p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <p class="text-sm font-semibold text-gray-700 mb-2">📁 Storage Status:</p>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-2 text-xs">
                        <div class="flex items-center">
                            <span class="mr-2">{{ $storagePermissions['logs_dir_exists'] ? '✅' : '❌' }}</span>
                            <span>Logs Directory</span>
                        </div>
                        <div class="flex items-center">
                            <span class="mr-2">{{ $storagePermissions['logs_dir_writable'] ? '✅' : '❌' }}</span>
                            <span>Directory Writable</span>
                        </div>
                        <div class="flex items-center">
                            <span class="mr-2">{{ $storagePermissions['auth_log_exists'] ? '✅' : '❌' }}</span>
                            <span>Auth Log File</span>
                        </div>
                        <div class="flex items-center">
                            <span class="mr-2">{{ $storagePermissions['auth_log_writable'] ? '✅' : '❌' }}</span>
                            <span>File Writable</span>
                        </div>
                    </div>
                    @if(!$storagePermissions['logs_dir_writable'])
                        <div class="mt-3 p-3 bg-red-50 border border-red-200 rounded">
                            <p class="text-sm text-red-800 font-semibold">⚠️ Permission Issue Detected</p>
                            <p class="text-xs text-red-700 mt-1">Run: <code class="bg-red-100 px-2 py-1 rounded">chmod -R 775 storage/logs</code></p>
                            <p class="text-xs text-red-700">Or: <code class="bg-red-100 px-2 py-1 rounded">sudo chown -R www-data:www-data storage</code></p>
                        </div>
                    @endif
                </div>
            @endif

            <!-- Stats -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded">
                    <p class="text-blue-600 text-sm font-semibold">Total Entries</p>
                    <p class="text-2xl font-bold text-blue-900">{{ count($logs) }}</p>
                </div>
                <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded">
                    <p class="text-green-600 text-sm font-semibold">Info Logs</p>
                    <p class="text-2xl font-bold text-green-900">{{ collect($logs)->where('level', 'INFO')->count() }}</p>
                </div>
                <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 rounded">
                    <p class="text-yellow-600 text-sm font-semibold">Warnings</p>
                    <p class="text-2xl font-bold text-yellow-900">{{ collect($logs)->where('level', 'WARNING')->count() }}</p>
                </div>
                <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded">
                    <p class="text-red-600 text-sm font-semibold">Errors</p>
                    <p class="text-2xl font-bold text-red-900">{{ collect($logs)->where('level', 'ERROR')->count() }}</p>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
            <form method="GET" action="{{ route('debug.logs') }}" class="flex flex-wrap gap-4">
                <div class="flex-1 min-w-[200px]">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Filter by Level</label>
                    <select name="filter" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" onchange="this.form.submit()">
                        <option value="all" {{ $filter === 'all' ? 'selected' : '' }}>All Levels</option>
                        <option value="debug" {{ $filter === 'debug' ? 'selected' : '' }}>Debug</option>
                        <option value="info" {{ $filter === 'info' ? 'selected' : '' }}>Info</option>
                        <option value="warning" {{ $filter === 'warning' ? 'selected' : '' }}>Warning</option>
                        <option value="error" {{ $filter === 'error' ? 'selected' : '' }}>Error</option>
                    </select>
                </div>
                <div class="flex-1 min-w-[300px]">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Search Logs</label>
                    <div class="flex">
                        <input type="text" name="search" value="{{ $search }}" placeholder="Search by email, user ID, message..." class="flex-1 px-4 py-2 border border-gray-300 rounded-l-lg focus:ring-2 focus:ring-blue-500">
                        <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-r-lg hover:bg-blue-600">
                            🔍 Search
                        </button>
                    </div>
                </div>
                @if($filter !== 'all' || $search)
                    <div class="flex items-end">
                        <a href="{{ route('debug.logs') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">
                            Clear Filters
                        </a>
                    </div>
                @endif
            </form>
        </div>

        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
                ✓ {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                ✗ {{ session('error') }}
            </div>
        @endif

        <!-- Log Entries -->
        @if(!$logExists)
            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-6 rounded-lg">
                <p class="font-bold">⚠️ No log file found</p>
                <p class="text-sm mt-1">Log file will be created automatically on first authentication event.</p>
                <p class="text-xs mt-2 text-gray-600">Expected path: {{ $logPath }}</p>
                <a href="{{ route('debug.logs.test') }}" class="mt-3 inline-block bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">
                    Create Test Log Entry
                </a>
            </div>
        @elseif(count($logs) === 0)
            <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-6 rounded-lg">
                <p class="font-bold">ℹ️ No logs found</p>
                @if($filter !== 'all' || $search)
                    <p class="text-sm mt-1">Try adjusting your filters or search terms.</p>
                @else
                    <p class="text-sm mt-1">Log file exists but is empty. Start by registering or logging in to see authentication logs here.</p>
                    <a href="{{ route('register') }}" class="mt-3 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Go to Registration
                    </a>
                @endif
            </div>
        @else
            <div class="space-y-3">
                @foreach($logs as $index => $log)
                    <div class="log-entry bg-white rounded-lg shadow hover:shadow-md border-l-4 
                        @if($log['level'] === 'ERROR') border-red-500
                        @elseif($log['level'] === 'WARNING') border-yellow-500
                        @elseif($log['level'] === 'INFO') border-blue-500
                        @else border-gray-500
                        @endif">
                        <div class="p-4">
                            <div class="flex justify-between items-start mb-2">
                                <div class="flex items-center space-x-3">
                                    <span class="px-3 py-1 rounded-full text-xs font-bold
                                        @if($log['level'] === 'ERROR') bg-red-100 text-red-800
                                        @elseif($log['level'] === 'WARNING') bg-yellow-100 text-yellow-800
                                        @elseif($log['level'] === 'INFO') bg-blue-100 text-blue-800
                                        @else bg-gray-100 text-gray-800
                                        @endif">
                                        {{ $log['level'] }}
                                    </span>
                                    <span class="text-sm text-gray-600">{{ $log['timestamp'] }}</span>
                                </div>
                                @if($log['context'])
                                    <button onclick="toggleContext({{ $index }})" class="text-blue-500 hover:text-blue-700 text-sm font-semibold">
                                        <span id="toggle-text-{{ $index }}">Show Details ▼</span>
                                    </button>
                                @endif
                            </div>
                            <p class="text-gray-800 font-medium">{{ $log['message'] }}</p>
                            @if($log['context'])
                                <div id="context-{{ $index }}" class="context-json mt-3 p-3 bg-gray-50 rounded border border-gray-200">
                                    <pre class="text-xs text-gray-700 overflow-x-auto">{{ json_encode($log['context'], JSON_PRETTY_PRINT) }}</pre>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Auto-refresh notice -->
        <div class="mt-6 text-center text-sm text-gray-600">
            <p>💡 Tip: This page shows the last 500 log entries. Refresh the page to see new logs.</p>
            <button onclick="location.reload()" class="mt-2 text-blue-500 hover:text-blue-700 font-semibold">
                🔄 Refresh Now
            </button>
        </div>
    </div>

    <script>
        function toggleContext(index) {
            const context = document.getElementById('context-' + index);
            const toggleText = document.getElementById('toggle-text-' + index);
            
            if (context.classList.contains('expanded')) {
                context.classList.remove('expanded');
                toggleText.textContent = 'Show Details ▼';
            } else {
                context.classList.add('expanded');
                toggleText.textContent = 'Hide Details ▲';
            }
        }

        // Auto-refresh every 10 seconds if there are logs
        @if(count($logs) > 0)
        setTimeout(function() {
            location.reload();
        }, 10000);
        @endif
    </script>
</body>
</html>
