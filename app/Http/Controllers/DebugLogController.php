<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DebugLogController extends Controller
{
    private function ensureLogFileExists()
    {
        $logPath = storage_path('logs/auth.log');
        
        if (!File::exists($logPath)) {
            File::put($logPath, '');
            
            // Try to set permissions
            try {
                chmod($logPath, 0666);
            } catch (\Exception $e) {
                // Permission setting failed, but file exists
            }
        }
    }

    public function index(Request $request)
    {
        $this->ensureLogFileExists();

        $logPath = storage_path('logs/auth.log');
        $logs = [];
        $totalLines = 0;
        $filter = $request->get('filter', 'all');
        $search = $request->get('search', '');
        $fileSize = 0;

        if (File::exists($logPath)) {
            $fileSize = File::size($logPath);
            $logContent = File::get($logPath);
            
            if (empty($logContent)) {
                // File exists but is empty - add initial entry
                $initialLog = '[' . date('Y-m-d H:i:s') . '] userauthlogs.INFO: Auth logging system initialized';
                File::append($logPath, $initialLog . "\n");
                $logContent = $initialLog;
            }
            
            $logLines = explode("\n", $logContent);
            $totalLines = count($logLines);

            // Parse log entries
            foreach ($logLines as $line) {
                if (empty(trim($line))) continue;

                // Extract log level and message
                if (preg_match('/\[(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})\].*?\.(DEBUG|INFO|WARNING|ERROR|CRITICAL):(.*?)({.*})?$/s', $line, $matches)) {
                    $timestamp = $matches[1] ?? 'Unknown';
                    $level = $matches[2] ?? 'INFO';
                    $message = trim($matches[3] ?? $line);
                    $context = $matches[4] ?? '{}';

                    // Parse context JSON
                    $contextData = null;
                    if (!empty($context) && $context !== '[]') {
                        try {
                            $contextData = json_decode($context, true);
                        } catch (\Exception $e) {
                            $contextData = ['raw' => $context];
                        }
                    }

                    // Apply filters
                    if ($filter !== 'all' && strtolower($level) !== strtolower($filter)) {
                        continue;
                    }

                    if (!empty($search)) {
                        $searchLower = strtolower($search);
                        $inMessage = str_contains(strtolower($message), $searchLower);
                        $inContext = str_contains(strtolower($context), $searchLower);
                        if (!$inMessage && !$inContext) {
                            continue;
                        }
                    }

                    $logs[] = [
                        'timestamp' => $timestamp,
                        'level' => $level,
                        'message' => $message,
                        'context' => $contextData,
                        'raw' => $line
                    ];
                }
            }

            // Reverse to show newest first
            $logs = array_reverse($logs);

            // Limit to last 500 entries for performance
            $logs = array_slice($logs, 0, 500);
        }

        return view('debug.logs', [
            'logs' => $logs,
            'totalLines' => $totalLines,
            'logExists' => File::exists($logPath),
            'logPath' => $logPath,
            'fileSize' => $fileSize,
            'filter' => $filter,
            'search' => $search,
            'storagePermissions' => $this->checkPermissions()
        ]);
    }

    private function checkPermissions()
    {
        $logsDir = storage_path('logs');
        $logFile = storage_path('logs/auth.log');
        
        return [
            'logs_dir_exists' => File::isDirectory($logsDir),
            'logs_dir_writable' => File::isWritable($logsDir),
            'auth_log_exists' => File::exists($logFile),
            'auth_log_writable' => File::exists($logFile) ? File::isWritable($logFile) : null,
            'logs_dir_path' => $logsDir,
            'auth_log_path' => $logFile
        ];
    }

    public function clear()
    {
        $logPath = storage_path('logs/auth.log');
        
        if (File::exists($logPath)) {
            File::put($logPath, '');
            return redirect()->route('debug.logs')->with('success', 'Auth logs cleared successfully');
        }

        return redirect()->route('debug.logs')->with('error', 'Log file not found');
    }

    public function download()
    {
        $logPath = storage_path('logs/auth.log');
        
        if (File::exists($logPath)) {
            return response()->download($logPath, 'auth-' . date('Y-m-d-His') . '.log');
        }

        return redirect()->route('debug.logs')->with('error', 'Log file not found');
    }

    public function testLog()
    {
        $this->ensureLogFileExists();
        
        try {
            \Log::channel('userauthlogs')->info('Test log entry from debug controller', [
                'timestamp' => now()->toDateTimeString(),
                'test' => true
            ]);
            
            return redirect()->route('debug.logs')->with('success', 'Test log entry created successfully!');
        } catch (\Exception $e) {
            return redirect()->route('debug.logs')->with('error', 'Failed to create test log: ' . $e->getMessage());
        }
    }
}