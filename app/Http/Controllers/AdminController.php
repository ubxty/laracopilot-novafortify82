<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    private function checkAuth()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        return null;
    }

    public function dashboard()
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $stats = [
            'total_projects' => 1247,
            'pending_approval' => 23,
            'total_users' => 892,
            'active_today' => 156,
            'qr_scans_today' => 47,
            'new_registrations' => 12
        ];

        $recentProjects = [
            ['name' => 'Laravel Notification Center', 'author' => 'Emma Wilson', 'status' => 'pending', 'submitted_at' => '2024-03-15 10:30'],
            ['name' => 'API Response Builder', 'author' => 'David Kim', 'status' => 'approved', 'submitted_at' => '2024-03-15 09:15'],
            ['name' => 'Form Validation Helper', 'author' => 'Lisa Garcia', 'status' => 'pending', 'submitted_at' => '2024-03-15 08:45'],
            ['name' => 'Cache Management Tool', 'author' => 'Ryan Foster', 'status' => 'approved', 'submitted_at' => '2024-03-14 16:20']
        ];

        $chartData = [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            'projects' => [45, 67, 89, 112, 134, 156],
            'users' => [123, 145, 178, 201, 234, 267]
        ];

        return view('admin.dashboard', compact('stats', 'recentProjects', 'chartData'));
    }

    public function users()
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $users = [
            ['id' => 1, 'name' => 'Sarah Chen', 'email' => 'sarah@example.com', 'projects_count' => 5, 'laracon_verified' => true, 'joined_at' => '2024-01-15', 'last_active' => '2024-03-15 10:30'],
            ['id' => 2, 'name' => 'Marcus Rodriguez', 'email' => 'marcus@example.com', 'projects_count' => 3, 'laracon_verified' => true, 'joined_at' => '2024-02-08', 'last_active' => '2024-03-14 15:20'],
            ['id' => 3, 'name' => 'Alex Thompson', 'email' => 'alex@example.com', 'projects_count' => 7, 'laracon_verified' => true, 'joined_at' => '2024-01-22', 'last_active' => '2024-03-15 09:45'],
            ['id' => 4, 'name' => 'Emma Wilson', 'email' => 'emma@example.com', 'projects_count' => 2, 'laracon_verified' => false, 'joined_at' => '2024-03-01', 'last_active' => '2024-03-15 11:15'],
            ['id' => 5, 'name' => 'David Kim', 'email' => 'david@example.com', 'projects_count' => 4, 'laracon_verified' => true, 'joined_at' => '2024-02-14', 'last_active' => '2024-03-13 14:30']
        ];

        return view('admin.users', compact('users'));
    }

    public function projects()
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $projects = [
            ['id' => 1, 'name' => 'Laravel Analytics Dashboard', 'author' => 'Sarah Chen', 'status' => 'approved', 'stars' => 2847, 'forks' => 421, 'submitted_at' => '2024-01-15', 'category' => 'Analytics'],
            ['id' => 2, 'name' => 'API Rate Limiter', 'author' => 'Marcus Rodriguez', 'status' => 'approved', 'stars' => 1923, 'forks' => 287, 'submitted_at' => '2024-02-08', 'category' => 'Security'],
            ['id' => 3, 'name' => 'Laravel Queue Monitor', 'author' => 'Alex Thompson', 'status' => 'approved', 'stars' => 3156, 'forks' => 512, 'submitted_at' => '2024-01-22', 'category' => 'DevTools'],
            ['id' => 4, 'name' => 'Laravel Notification Center', 'author' => 'Emma Wilson', 'status' => 'pending', 'stars' => , 'forks' => 0, 'submitted_at' => '2024-03-15', 'category' => 'Notifications'],
            ['id' => 5, 'name' => 'Form Validation Helper', 'author' => 'Lisa Garcia', 'status' => 'pending', 'stars' => 0, 'forks' => 0, 'submitted_at' => '2024-03-15', 'category' => 'Forms']
        ];

        return view('admin.projects', compact('projects'));
    }

    public function qrCodes()
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $qrCodes = [
            ['id' => 1, 'event' => 'Laracon US 2024', 'code' => 'LC2024-US-001', 'scans' => 234, 'registrations' => 187, 'created_at' => '2024-01-10', 'status' => 'active'],
            ['id' => 2, 'event' => 'Laracon EU 2024', 'code' => 'LC2024-EU-001', 'scans' => 156, 'registrations' => 123, 'created_at' => '2024-02-15', 'status' => 'active'],
            ['id' => 3, 'event' => 'Laracon Online 2024', 'code' => 'LC2024-ON-001', 'scans' => 89, 'registrations' => 67, 'created_at' => '2024-03-01', 'status' => 'active'],
            ['id' => 4, 'event' => 'Laracon AU 2024', 'code' => 'LC2024-AU-001', 'scans' => 45, 'registrations' => 34, 'created_at' => '2024-03-10', 'status' => 'active']
        ];

        return view('admin.qr-codes', compact('qrCodes'));
    }

    public function analytics()
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $analytics = [
            'overview' => [
                'total_page_views' => 45621,
                'unique_visitors' => 12847,
                'bounce_rate' => 23.5,
                'avg_session_duration' => '4:32'
            ],
            'top_projects' => [
                ['name' => 'Laravel Queue Monitor', 'views' => 3456, 'clicks' => 892],
                ['name' => 'Laravel Analytics Dashboard', 'views' => 2847, 'clicks' => 721],
                ['name' => 'API Rate Limiter', 'views' => 1923, 'clicks' => 456]
            ],
            'traffic_sources' => [
                ['source' => 'GitHub', 'visitors' => 5621, 'percentage' => 43.7],
                ['source' => 'Laravel.com', 'visitors' => 3247, 'percentage' => 25.3],
                ['source' => 'Direct', 'visitors' => 2156, 'percentage' => 16.8],
                ['source' => 'Twitter', 'visitors' => 1823, 'percentage' => 14.2]
            ]
        ];

        return view('admin.analytics', compact('analytics'));
    }

    public function settings()
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $settings = [
            'site' => [
                'name' => 'Laravel Community Projects',
                'description' => 'A community-driven platform for Laravel developers',
                'url' => 'https://community.laravel.com',
                'email' => 'hello@laravelcommunity.com'
            ],
            'features' => [
                'auto_approval' => false,
                'email_notifications' => true,
                'qr_registration' => true,
                'github_integration' => true
            ],
            'moderation' => [
                'require_approval' => true,
                'min_stars' => 5,
                'check_duplicates' => true,
                'spam_detection' => true
            ]
        ];

        return view('admin.settings', compact('settings'));
    }
}