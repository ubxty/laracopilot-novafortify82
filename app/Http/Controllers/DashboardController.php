<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $totalProjects = Project::where('user_id', $user->id)->count();
        $publishedProjects = Project::where('user_id', $user->id)
            ->where('is_published', true)
            ->count();
        $totalStars = Project::where('user_id', $user->id)->sum('stars');
        $totalForks = Project::where('user_id', $user->id)->sum('forks');

        $recentProjects = Project::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('dashboard.index', compact(
            'user',
            'totalProjects',
            'publishedProjects',
            'totalStars',
            'totalForks',
            'recentProjects'
        ));
    }
}