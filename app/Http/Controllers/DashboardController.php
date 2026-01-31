<?php

namespace App\Http\Controllers;

use App\Models\OpensourceProject;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if (!session('user_logged_in')) {
            return redirect()->route('login');
        }

        $userId = session('user_id');
        $projects = OpensourceProject::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dashboard.index', compact('projects'));
    }

    public function storeProject(Request $request)
    {
        if (!session('user_logged_in')) {
            return redirect()->route('login');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'short_description' => 'required|string|max:300',
            'description' => 'required|string',
            'github_url' => 'required|url',
            'demo_url' => 'nullable|url',
            'project_type' => 'required|in:Package,App,Boilerplate,Tool'
        ]);

        $validated['user_id'] = session('user_id');
        $validated['tags'] = [$validated['project_type']];
        $validated['active'] = false; // Requires admin approval
        $validated['featured'] = false;
        $validated['stars'] = 0;
        $validated['forks'] = 0;

        OpensourceProject::create($validated);

        return redirect()->route('dashboard')
            ->with('success', 'Project submitted successfully! It will be reviewed by our team.');
    }

    public function deleteProject($id)
    {
        if (!session('user_logged_in')) {
            return redirect()->route('login');
        }

        $project = OpensourceProject::where('id', $id)
            ->where('user_id', session('user_id'))
            ->firstOrFail();

        $project->delete();

        return redirect()->route('dashboard')
            ->with('success', 'Project deleted successfully!');
    }
}