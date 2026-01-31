<?php

namespace App\Http\Controllers;

use App\Models\OpensourceProject;
use Illuminate\Http\Request;

class OpensourceProjectController extends Controller
{
    public function index()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $projects = OpensourceProject::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'github_url' => 'required|url',
            'demo_url' => 'nullable|url',
            'image_url' => 'nullable|url',
            'tags' => 'nullable|string',
            'stars' => 'nullable|integer|min:0',
            'forks' => 'nullable|integer|min:0',
            'featured' => 'nullable|boolean',
            'active' => 'nullable|boolean'
        ]);

        // Convert tags string to array
        if (!empty($validated['tags'])) {
            $validated['tags'] = array_map('trim', explode(',', $validated['tags']));
        } else {
            $validated['tags'] = [];
        }

        $validated['user_id'] = 1; // Default admin user
        $validated['featured'] = $request->has('featured');
        $validated['active'] = $request->has('active') ? true : false;

        OpensourceProject::create($validated);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project created successfully!');
    }

    public function edit($id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $project = OpensourceProject::findOrFail($id);
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, $id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'github_url' => 'required|url',
            'demo_url' => 'nullable|url',
            'image_url' => 'nullable|url',
            'tags' => 'nullable|string',
            'stars' => 'nullable|integer|min:0',
            'forks' => 'nullable|integer|min:0',
            'featured' => 'nullable|boolean',
            'active' => 'nullable|boolean'
        ]);

        // Convert tags string to array
        if (!empty($validated['tags'])) {
            $validated['tags'] = array_map('trim', explode(',', $validated['tags']));
        } else {
            $validated['tags'] = [];
        }

        $validated['featured'] = $request->has('featured');
        $validated['active'] = $request->has('active') ? true : false;

        $project = OpensourceProject::findOrFail($id);
        $project->update($validated);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project updated successfully!');
    }

    public function destroy($id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        OpensourceProject::findOrFail($id)->delete();

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project deleted successfully!');
    }

    public function publicIndex()
    {
        $projects = OpensourceProject::with('user')
            ->where('active', true)
            ->orderBy('featured', 'desc')
            ->orderBy('stars', 'desc')
            ->paginate(12);

        return view('projects.index', compact('projects'));
    }

    public function show($id)
    {
        $project = OpensourceProject::with('user')->findOrFail($id);
        return view('projects.show', compact('project'));
    }
}