<!-- Debug Console - Only visible in development -->
@if(config('app.debug'))
<div id="debug-console" class="fixed bottom-0 right-0 left-0 md:bottom-4 md:right-4 md:left-auto md:w-96 w-full bg-gray-900 text-white rounded-t-lg md:rounded-lg shadow-2xl z-50 hidden max-h-[80vh] md:max-h-[500px] flex flex-col">
    <div class="bg-red-600 px-3 py-2 md:px-4 md:py-3 rounded-t-lg flex justify-between items-center flex-shrink-0">
        <div class="flex items-center gap-2">
            <span class="text-base md:text-lg">🐛</span>
            <span class="font-bold text-xs md:text-sm">API Debug Console</span>
        </div>
        <button onclick="toggleDebugConsole()" class="text-white hover:text-gray-200 p-1">
            <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
    <div id="debug-content" class="p-3 md:p-4 overflow-y-auto text-xs font-mono flex-1">
        <div class="text-gray-400 text-center py-4 text-xs md:text-sm">Waiting for API requests...</div>
    </div>
    <div class="bg-gray-800 px-3 py-2 md:px-4 md:py-2 rounded-b-lg md:rounded-b-lg flex justify-between items-center gap-2 flex-shrink-0">
        <button onclick="clearDebugLog()" class="text-xs bg-red-600 hover:bg-red-700 px-2 py-1 md:px-3 md:py-1 rounded flex-1 md:flex-initial">
            Clear
        </button>
        <button onclick="downloadDebugLog()" class="text-xs bg-blue-600 hover:bg-blue-700 px-2 py-1 md:px-3 md:py-1 rounded flex-1 md:flex-initial">
            Download
        </button>
    </div>
</div>

<!-- Debug Toggle Button - Responsive positioning -->
<button 
    id="debug-toggle-btn"
    onclick="toggleDebugConsole()" 
    class="fixed bottom-4 right-4 bg-red-600 text-white p-2 md:p-3 rounded-full shadow-lg hover:bg-red-700 z-40 transition-all active:scale-95"
    title="Toggle Debug Console"
>
    <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
    </svg>
</button>

<script>
let debugLogs = [];

function toggleDebugConsole() {
    const console = document.getElementById('debug-console');
    const toggleBtn = document.getElementById('debug-toggle-btn');
    if (console.classList.contains('hidden')) {
        console.classList.remove('hidden');
        toggleBtn.classList.add('hidden');
        // Prevent body scroll on mobile when console is open
        if (window.innerWidth < 768) {
            document.body.style.overflow = 'hidden';
        }
    } else {
        console.classList.add('hidden');
        toggleBtn.classList.remove('hidden');
        // Restore body scroll
        document.body.style.overflow = '';
    }
}

function logApiRequest(data) {
    const timestamp = new Date().toISOString();
    const logEntry = {
        timestamp,
        ...data
    };
    debugLogs.push(logEntry);
    
    const debugContent = document.getElementById('debug-content');
    const logHtml = `
        <div class="mb-3 md:mb-4 pb-3 md:pb-4 border-b border-gray-700">
            <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-1 md:gap-0 mb-2">
                <span class="text-yellow-400 font-bold text-xs md:text-sm">${data.type || 'API Request'}</span>
                <span class="text-gray-500 text-xs">${new Date(timestamp).toLocaleTimeString()}</span>
            </div>
            
            ${data.url ? `
            <div class="mb-2">
                <span class="text-blue-400 text-xs">URL:</span>
                <div class="text-white break-all text-xs mt-1">${data.url}</div>
            </div>
            ` : ''}
            
            ${data.method ? `
            <div class="mb-2">
                <span class="text-blue-400 text-xs">Method:</span>
                <span class="text-white text-xs ml-2">${data.method}</span>
            </div>
            ` : ''}
            
            ${data.params ? `
            <div class="mb-2">
                <span class="text-blue-400 text-xs">Params:</span>
                <pre class="text-white bg-gray-800 p-2 rounded mt-1 text-xs overflow-x-auto">${JSON.stringify(data.params, null, 2)}</pre>
            </div>
            ` : ''}
            
            ${data.headers ? `
            <div class="mb-2">
                <span class="text-blue-400 text-xs">Headers:</span>
                <pre class="text-white bg-gray-800 p-2 rounded mt-1 text-xs overflow-x-auto">${JSON.stringify(data.headers, null, 2)}</pre>
            </div>
            ` : ''}
            
            ${data.response ? `
            <div class="mb-2">
                <span class="${data.success ? 'text-green-400' : 'text-red-400'} text-xs">Response:</span>
                <pre class="text-white bg-gray-800 p-2 rounded mt-1 text-xs overflow-x-auto">${JSON.stringify(data.response, null, 2)}</pre>
            </div>
            ` : ''}
            
            ${data.error ? `
            <div class="mb-2">
                <span class="text-red-400 text-xs">Error:</span>
                <pre class="text-red-300 bg-red-900/30 p-2 rounded mt-1 text-xs overflow-x-auto">${typeof data.error === 'object' ? JSON.stringify(data.error, null, 2) : data.error}</pre>
            </div>
            ` : ''}
            
            ${data.statusCode ? `
            <div class="mb-2">
                <span class="text-blue-400 text-xs">Status Code:</span>
                <span class="${data.statusCode >= 200 && data.statusCode < 300 ? 'text-green-400' : 'text-red-400'} text-xs ml-2">${data.statusCode}</span>
            </div>
            ` : ''}
            
            ${data.duration ? `
            <div class="mb-2">
                <span class="text-blue-400 text-xs">Duration:</span>
                <span class="text-white text-xs ml-2">${data.duration}ms</span>
            </div>
            ` : ''}
        </div>
    `;
    
    if (debugContent.querySelector('.text-center')) {
        debugContent.innerHTML = '';
    }
    debugContent.insertAdjacentHTML('afterbegin', logHtml);
    
    // Auto-open console on error
    if (data.error || (data.statusCode && data.statusCode >= 400)) {
        const console = document.getElementById('debug-console');
        const toggleBtn = document.getElementById('debug-toggle-btn');
        console.classList.remove('hidden');
        toggleBtn.classList.add('hidden');
        if (window.innerWidth < 768) {
            document.body.style.overflow = 'hidden';
        }
    }
}

function clearDebugLog() {
    debugLogs = [];
    document.getElementById('debug-content').innerHTML = '<div class="text-gray-400 text-center py-4 text-xs md:text-sm">Waiting for API requests...</div>';
}

function downloadDebugLog() {
    const logText = debugLogs.map(log => {
        return `[${log.timestamp}] ${log.type || 'API Request'}\n` +
               `URL: ${log.url || 'N/A'}\n` +
               `Method: ${log.method || 'N/A'}\n` +
               `Params: ${JSON.stringify(log.params, null, 2)}\n` +
               `Response: ${JSON.stringify(log.response, null, 2)}\n` +
               `Error: ${log.error || 'None'}\n` +
               `Status: ${log.statusCode || 'N/A'}\n` +
               `Duration: ${log.duration || 'N/A'}ms\n` +
               '\n---\n\n';
    }).join('');
    
    const blob = new Blob([logText], { type: 'text/plain' });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = `debug-log-${new Date().toISOString()}.txt`;
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    window.URL.revokeObjectURL(url);
}

// Close debug console when clicking outside on mobile
document.addEventListener('click', function(event) {
    const console = document.getElementById('debug-console');
    const toggleBtn = document.getElementById('debug-toggle-btn');
    
    if (!console.classList.contains('hidden') && 
        !console.contains(event.target) && 
        !toggleBtn.contains(event.target) &&
        window.innerWidth < 768) {
        console.classList.add('hidden');
        toggleBtn.classList.remove('hidden');
        document.body.style.overflow = '';
    }
});

// Handle window resize
window.addEventListener('resize', function() {
    const console = document.getElementById('debug-console');
    if (!console.classList.contains('hidden') && window.innerWidth >= 768) {
        document.body.style.overflow = '';
    }
});

// Fetch interceptor for automatic logging
const originalFetch = window.fetch;
window.fetch = function(...args) {
    const startTime = Date.now();
    const [url, options = {}] = args;
    
    const logData = {
        type: 'Fetch Request',
        url: url,
        method: options.method || 'GET',
        params: options.body ? JSON.parse(options.body) : null,
        headers: options.headers || {}
    };
    
    return originalFetch.apply(this, args)
        .then(response => {
            const duration = Date.now() - startTime;
            return response.clone().json()
                .then(data => {
                    logApiRequest({
                        ...logData,
                        response: data,
                        statusCode: response.status,
                        success: response.ok,
                        duration
                    });
                    return response;
                })
                .catch(() => {
                    logApiRequest({
                        ...logData,
                        response: 'Non-JSON response',
                        statusCode: response.status,
                        success: response.ok,
                        duration
                    });
                    return response;
                });
        })
        .catch(error => {
            const duration = Date.now() - startTime;
            logApiRequest({
                ...logData,
                error: error.message || error.toString(),
                success: false,
                duration
            });
            throw error;
        });
};
</script>
@endif
