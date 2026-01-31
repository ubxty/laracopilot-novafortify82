<?php

namespace App\Http\Controllers;

use App\Models\OpensourceProject;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Get statistics
        $stats = [
            'total_projects' => OpensourceProject::count(),
            'total_users' => User::count(),
            'active_this_week' => OpensourceProject::where('created_at', '>=', now()->subWeek())->count()
        ];

        // Get featured projects
        $featured_projects = OpensourceProject::where('is_featured', true)
            ->orderBy('github_stars', 'desc')
            ->take(6)
            ->get();

        return view('welcome', compact('stats', 'featured_projects'));
    }
}