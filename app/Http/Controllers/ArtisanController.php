<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

class ArtisanController extends Controller
{
    private $passcode = '9041029998';

    public function index()
    {
        // Check if passcode is verified in session
        if (!session('artisan_access')) {
            return view('artisan.login');
        }

        $logs = $this->getArtisanLogs();
        return view('artisan.index', compact('logs'));
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'passcode' => 'required'
        ]);

        if ($request->input('passcode') === $this->passcode) {
            session(['artisan_access' => true]);
            return redirect()->route('artisan.index');
        }

        return back()->withErrors(['passcode' => 'Invalid passcode']);
    }

    public function run(Request $request)
    {
        if (!session('artisan_access')) {
            return redirect()->route('artisan.index');
        }

        $request->validate([
            'command' => 'required|string'
        ]);

        $command = $request->input('command');
        
        // Remove 'php artisan' prefix if user included it
        $command = preg_replace('/^php\s+artisan\s+/', '', $command);

        try {
            // Capture output
            Artisan::call($command);
            $output = Artisan::output();

            // Log to artisan channel
            Log::channel('artisan')->info('Command executed', [
                'command' => $command,
                'output' => $output,
                'timestamp' => now()->toDateTimeString()
            ]);

            return redirect()->route('artisan.index')
                ->with('success', 'Command executed successfully')
                ->with('command_output', $output);

        } catch (\Exception $e) {
            Log::channel('artisan')->error('Command failed', [
                'command' => $command,
                'error' => $e->getMessage(),
                'timestamp' => now()->toDateTimeString()
            ]);

            return redirect()->route('artisan.index')
                ->with('error', 'Command failed: ' . $e->getMessage());
        }
    }

    public function refresh()
    {
        if (!session('artisan_access')) {
            return redirect()->route('artisan.index');
        }

        $logs = $this->getArtisanLogs();
        return view('artisan.index', compact('logs'));
    }

    public function clearLogs()
    {
        if (!session('artisan_access')) {
            return redirect()->route('artisan.index');
        }

        $logPath = storage_path('logs/artisan.log');
        if (File::exists($logPath)) {
            File::put($logPath, '');
        }

        return redirect()->route('artisan.index')
            ->with('success', 'Logs cleared successfully');
    }

    public function logout()
    {
        session()->forget('artisan_access');
        return redirect()->route('artisan.index');
    }

    private function getArtisanLogs()
    {
        $logPath = storage_path('logs/artisan.log');
        
        if (!File::exists($logPath)) {
            return [];
        }

        $content = File::get($logPath);
        $lines = array_filter(explode("\n", $content));
        
        // Get last 50 log entries
        $logs = array_slice(array_reverse($lines), 0, 50);
        
        return $logs;
    }
}