<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('dashboard.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('dashboard.projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'short_description' => 'required|string|max:500',
            'full_description' => 'nullable|string',
            'project_type' => 'required|in:Package,Framework,Starter Kit,Tool,Application',
            'github_url' => 'required|url',
            'demo_url' => 'nullable|url',
            'documentation_url' => 'nullable|url',
            'stars' => 'nullable|integer|min:0',
            'forks' => 'nullable|integer|min:0',
            'tags' => 'nullable|string',
            'is_published' => 'boolean'
        ]);

        // Convert tags string to array
        if (!empty($validated['tags'])) {
            $validated['tags'] = array_map('trim', explode(',', $validated['tags']));
        } else {
            $validated['tags'] = [];
        }

        // Set defaults
        $validated['user_id'] = Auth::id();
        $validated['stars'] = $validated['stars'] ?? 0;
        $validated['forks'] = $validated['forks'] ?? 0;
        $validated['is_published'] = $request->has('is_published');

        Project::create($validated);

        return redirect()->route('dashboard.projects.index')
            ->with('success', 'Project created successfully! 🎉');
    }

    public function edit($id)
    {
        $project = Project::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('dashboard.projects.edit', compact('project'));
    }

    public function update(Request $request, $id)
    {
        $project = Project::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'short_description' => 'required|string|max:500',
            'full_description' => 'nullable|string',
            'project_type' => 'required|in:Package,Framework,Starter Kit,Tool,Application',
            'github_url' => 'required|url',
            'demo_url' => 'nullable|url',
            'documentation_url' => 'nullable|url',
            'stars' => 'nullable|integer|min:0',
            'forks' => 'nullable|integer|min:0',
            'tags' => 'nullable|string',
            'is_published' => 'boolean'
        ]);

        // Convert tags string to array
        if (!empty($validated['tags'])) {
            $validated['tags'] = array_map('trim', explode(',', $validated['tags']));
        } else {
            $validated['tags'] = [];
        }

        $validated['stars'] = $validated['stars'] ?? 0;
        $validated['forks'] = $validated['forks'] ?? 0;
        $validated['is_published'] = $request->has('is_published');

        $project->update($validated);

        return redirect()->route('dashboard.projects.index')
            ->with('success', 'Project updated successfully! ✅');
    }

    public function destroy($id)
    {
        $project = Project::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $project->delete();

        return redirect()->route('dashboard.projects.index')
            ->with('success', 'Project deleted successfully!');
    }
}