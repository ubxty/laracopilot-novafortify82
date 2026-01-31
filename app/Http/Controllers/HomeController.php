<?php

namespace App\Http\Controllers;

use App\Models\OpensourceProject;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProjects = OpensourceProject::where('featured', true)
            ->orderBy('stars', 'desc')
            ->take(6)
            ->get();
        
        // Calculate statistics
        $totalProjects = OpensourceProject::count();
        $totalStars = OpensourceProject::sum('stars');
        $totalForks = OpensourceProject::sum('forks');
        $totalDevelopers = User::count();
        
        return view('welcome', compact(
            'featuredProjects',
            'totalProjects',
            'totalStars',
            'totalForks',
            'totalDevelopers'
        ));
    }
}