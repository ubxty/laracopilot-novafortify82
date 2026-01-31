<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProjects = [
            [
                'id' => 1,
                'name' => 'Laravel Analytics Dashboard',
                'description' => 'A comprehensive analytics dashboard built with Laravel and Chart.js for tracking application metrics.',
                'author' => 'Sarah Chen',
                'github_url' => 'https://github.com/sarahchen/laravel-analytics',
                'demo_url' => 'https://analytics-demo.laravel.com',
                'stars' => 2847,
                'forks' => 421,
                'tags' => ['Analytics', 'Dashboard', 'Charts'],
                'created_at' => '2024-01-15',
                'featured' => true
            ],
            [
                'id' => 2,
                'name' => 'API Rate Limiter',
                'description' => 'Advanced rate limiting package for Laravel APIs with Redis backend and flexible configuration.',
                'author' => 'Marcus Rodriguez',
                'github_url' => 'https://github.com/marcusr/api-rate-limiter',
                'demo_url' => null,
                'stars' => 1923,
                'forks' => 287,
                'tags' => ['API', 'Security', 'Performance'],
                'created_at' => '2024-02-08',
                'featured' => true
            ],
            [
                'id' => 3,
                'name' => 'Laravel Queue Monitor',
                'description' => 'Real-time queue monitoring and management tool with beautiful UI and detailed job tracking.',
                'author' => 'Alex Thompson',
                'github_url' => 'https://github.com/alexthompson/queue-monitor',
                'demo_url' => 'https://queue-demo.laravel.com',
                'stars' => 3156,
                'forks' => 512,
                'tags' => ['Queue', 'Monitoring', 'DevTools'],
                'created_at' => '2024-01-22',
                'featured' => true
            ]
        ];

        $stats = [
            'total_projects' => 1247,
            'total_developers' => 892,
            'github_stars' => 45621,
            'active_contributors' => 156
        ];

        return view('welcome', compact('featuredProjects', 'stats'));
    }
}