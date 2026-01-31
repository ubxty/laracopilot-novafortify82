<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProjects = Project::where('is_featured', true)
            ->where('is_published', true)
            ->with('user')
            ->orderBy('stars', 'desc')
            ->take(6)
            ->get();

        $totalProjects = Project::where('is_published', true)->count();
        $totalStars = Project::where('is_published', true)->sum('stars');
        $totalDevelopers = User::count();
        $totalForks = Project::where('is_published', true)->sum('forks');

        return view('welcome', compact('featuredProjects', 'totalProjects', 'totalStars', 'totalDevelopers', 'totalForks'));
    }

    public function projects(Request $request)
    {
        $query = Project::where('is_published', true)->with('user');

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('short_description', 'like', "%{$search}%")
                  ->orWhere('tags', 'like', "%{$search}%");
            });
        }

        // Filter by type
        if ($request->filled('type')) {
            $query->where('project_type', $request->type);
        }

        // Sort
        $sort = $request->get('sort', 'latest');
        switch ($sort) {
            case 'stars':
                $query->orderBy('stars', 'desc');
                break;
            case 'forks':
                $query->orderBy('forks', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        $projects = $query->paginate(12)->withQueryString();

        return view('projects.index', compact('projects'));
    }
}