<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $projects = Project::with('user')
            ->where('status', 'published')
            ->latest()
            ->take(6)
            ->get();

        return view('welcome', compact('projects'));
    }

    public function dashboard()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        
        // Get user's projects
        $myProjects = Project::where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        // Get community projects
        $communityProjects = Project::with('user')
            ->where('status', 'published')
            ->where('user_id', '!=', $user->id)
            ->latest()
            ->take(6)
            ->get();

        // Statistics
        $stats = [
            'total_projects' => Project::where('user_id', $user->id)->count(),
            'published_projects' => Project::where('user_id', $user->id)->where('status', 'published')->count(),
            'draft_projects' => Project::where('user_id', $user->id)->where('status', 'draft')->count(),
            'community_projects' => Project::where('status', 'published')->count(),
        ];

        return view('dashboard', compact('user', 'myProjects', 'communityProjects', 'stats'));
    }
}