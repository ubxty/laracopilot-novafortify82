<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function publicIndex()
    {
        $projects = Project::with('user')
            ->where('is_published', true)
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('projects.index', compact('projects'));
    }

    public function show($id)
    {
        $project = Project::with('user')->findOrFail($id);
        
        if (!$project->is_published && (!session('user_logged_in') || session('user_id') != $project->user_id)) {
            abort(404);
        }

        return view('projects.show', compact('project'));
    }

    public function myProjects()
    {
        if (!session('user_logged_in')) {
            return redirect()->route('login');
        }

        $projects = Project::where('user_id', session('user_id'))
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('projects.my-projects', compact('projects'));
    }

    public function create()
    {
        if (!session('user_logged_in')) {
            return redirect()->route('login');
        }

        return view('projects.create');
    }

    public function store(Request $request)
    {
        if (!session('user_logged_in')) {
            return redirect()->route('login');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'repository_url' => 'required|url',
            'demo_url' => 'nullable|url',
            'tags' => 'nullable|string',
            'is_published' => 'boolean'
        ]);

        $project = Project::create([
            'user_id' => session('user_id'),
            'name' => $validated['name'],
            'description' => $validated['description'],
            'repository_url' => $validated['repository_url'],
            'demo_url' => $validated['demo_url'] ?? null,
            'tags' => $validated['tags'] ?? null,
            'is_published' => $request->has('is_published')
        ]);

        return redirect()->route('projects.my')->with('success', 'Project created successfully!');
    }

    public function edit($id)
    {
        if (!session('user_logged_in')) {
            return redirect()->route('login');
        }

        $project = Project::findOrFail($id);

        if ($project->user_id != session('user_id')) {
            abort(403);
        }

        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, $id)
    {
        if (!session('user_logged_in')) {
            return redirect()->route('login');
        }

        $project = Project::findOrFail($id);

        if ($project->user_id != session('user_id')) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'repository_url' => 'required|url',
            'demo_url' => 'nullable|url',
            'tags' => 'nullable|string',
            'is_published' => 'boolean'
        ]);

        $project->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'repository_url' => $validated['repository_url'],
            'demo_url' => $validated['demo_url'] ?? null,
            'tags' => $validated['tags'] ?? null,
            'is_published' => $request->has('is_published')
        ]);

        return redirect()->route('projects.my')->with('success', 'Project updated successfully!');
    }

    public function destroy($id)
    {
        if (!session('user_logged_in')) {
            return redirect()->route('login');
        }

        $project = Project::findOrFail($id);

        if ($project->user_id != session('user_id')) {
            abort(403);
        }

        $project->delete();

        return redirect()->route('projects.my')->with('success', 'Project deleted successfully');
    }
}