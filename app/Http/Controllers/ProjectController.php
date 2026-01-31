<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function publicIndex()
    {
        $projects = Project::where('is_public', true)
            ->orderBy('created_at', 'desc')
            ->paginate(12);
        
        return view('projects.public', compact('projects'));
    }

    public function index()
    {
        if (!session('user_id')) {
            return redirect()->route('login');
        }

        $projects = Project::where('user_id', session('user_id'))
            ->orderBy('created_at', 'desc')
            ->paginate(12);
        
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        if (!session('user_id')) {
            return redirect()->route('login');
        }

        return view('projects.create');
    }

    public function store(Request $request)
    {
        if (!session('user_id')) {
            return redirect()->route('login');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'tech_stack' => 'required|string',
            'project_url' => 'nullable|url',
            'github_url' => 'nullable|url',
            'is_public' => 'boolean'
        ]);

        $validated['user_id'] = session('user_id');
        $validated['is_public'] = $request->has('is_public');

        Project::create($validated);

        return redirect()->route('projects.index')
            ->with('success', 'Project created successfully!');
    }

    public function edit($id)
    {
        if (!session('user_id')) {
            return redirect()->route('login');
        }

        $project = Project::where('id', $id)
            ->where('user_id', session('user_id'))
            ->firstOrFail();
        
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, $id)
    {
        if (!session('user_id')) {
            return redirect()->route('login');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'tech_stack' => 'required|string',
            'project_url' => 'nullable|url',
            'github_url' => 'nullable|url',
            'is_public' => 'boolean'
        ]);

        $validated['is_public'] = $request->has('is_public');

        $project = Project::where('id', $id)
            ->where('user_id', session('user_id'))
            ->firstOrFail();
        
        $project->update($validated);

        return redirect()->route('projects.index')
            ->with('success', 'Project updated successfully!');
    }

    public function destroy($id)
    {
        if (!session('user_id')) {
            return redirect()->route('login');
        }

        $project = Project::where('id', $id)
            ->where('user_id', session('user_id'))
            ->firstOrFail();
        
        $project->delete();

        return redirect()->route('projects.index')
            ->with('success', 'Project deleted successfully!');
    }
}