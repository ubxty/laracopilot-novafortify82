<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\User;

class ProjectSeeder extends Seeder
{
    public function run()
    {
        $user = User::first();
        
        if (!$user) {
            $user = User::create([
                'name' => 'Demo User',
                'email' => 'demo@laravel.com',
                'password' => bcrypt('password')
            ]);
        }

        $projects = [
            [
                'name' => 'Laravel Breeze',
                'short_description' => 'Minimal, simple authentication scaffolding with Blade and Tailwind',
                'full_description' => 'Laravel Breeze provides a minimal, simple implementation of all of Laravel authentication features, including login, registration, password reset, email verification, and password confirmation.',
                'project_type' => 'Starter Kit',
                'github_url' => 'https://github.com/laravel/breeze',
                'demo_url' => 'https://laravel.com/docs/starter-kits',
                'stars' => 2800,
                'forks' => 450,
                'tags' => ['authentication', 'starter-kit', 'tailwind']
            ],
            [
                'name' => 'Livewire',
                'short_description' => 'A full-stack framework for Laravel that makes building dynamic interfaces simple',
                'full_description' => 'Livewire is a full-stack framework for Laravel that makes building dynamic interfaces simple, without leaving the comfort of Laravel.',
                'project_type' => 'Framework',
                'github_url' => 'https://github.com/livewire/livewire',
                'demo_url' => 'https://livewire.laravel.com',
                'stars' => 21500,
                'forks' => 1300,
                'tags' => ['frontend', 'reactive', 'components']
            ],
            [
                'name' => 'Laravel Sanctum',
                'short_description' => 'API token authentication for Laravel and simple SPA authentication',
                'full_description' => 'Laravel Sanctum provides a featherweight authentication system for SPAs and simple APIs.',
                'project_type' => 'Package',
                'github_url' => 'https://github.com/laravel/sanctum',
                'documentation_url' => 'https://laravel.com/docs/sanctum',
                'stars' => 2600,
                'forks' => 280,
                'tags' => ['authentication', 'api', 'spa']
            ],
            [
                'name' => 'Laravel Telescope',
                'short_description' => 'An elegant debug assistant for Laravel applications',
                'full_description' => 'Laravel Telescope makes a wonderful companion to your local Laravel development environment. Telescope provides insight into the requests coming into your application, exceptions, log entries, database queries, queued jobs, mail, notifications, cache operations, scheduled tasks, variable dumps and more.',
                'project_type' => 'Tool',
                'github_url' => 'https://github.com/laravel/telescope',
                'documentation_url' => 'https://laravel.com/docs/telescope',
                'stars' => 4700,
                'forks' => 580,
                'tags' => ['debugging', 'development', 'monitoring']
            ],
            [
                'name' => 'Filament',
                'short_description' => 'A collection of beautiful full-stack components for Laravel',
                'full_description' => 'Filament is a collection of beautiful full-stack components. The perfect starting point for your next app. Using Livewire, Alpine.js and Tailwind CSS.',
                'project_type' => 'Framework',
                'github_url' => 'https://github.com/filamentphp/filament',
                'demo_url' => 'https://filamentphp.com',
                'stars' => 14200,
                'forks' => 2100,
                'tags' => ['admin-panel', 'livewire', 'tailwind']
            ],
            [
                'name' => 'Laravel Horizon',
                'short_description' => 'Dashboard and configuration system for Laravel queues',
                'full_description' => 'Horizon provides a beautiful dashboard and code-driven configuration for your Laravel powered Redis queues. Horizon allows you to easily monitor key metrics of your queue system.',
                'project_type' => 'Tool',
                'github_url' => 'https://github.com/laravel/horizon',
                'documentation_url' => 'https://laravel.com/docs/horizon',
                'stars' => 3800,
                'forks' => 650,
                'tags' => ['queue', 'redis', 'monitoring']
            ],
            [
                'name' => 'Spatie Laravel Permission',
                'short_description' => 'Associate users with roles and permissions',
                'full_description' => 'This package allows you to manage user permissions and roles in a database. Once installed you can do stuff like this: $user->assignRole("writer"); $user->givePermissionTo("edit articles");',
                'project_type' => 'Package',
                'github_url' => 'https://github.com/spatie/laravel-permission',
                'documentation_url' => 'https://spatie.be/docs/laravel-permission',
                'stars' => 11800,
                'forks' => 1700,
                'tags' => ['authorization', 'permissions', 'roles']
            ],
            [
                'name' => 'Laravel Jetstream',
                'short_description' => 'Beautifully designed application scaffolding for Laravel',
                'full_description' => 'Laravel Jetstream is a beautifully designed application scaffolding for Laravel. Jetstream provides the perfect starting point for your next Laravel application and includes login, registration, email verification, two-factor authentication, session management, API support via Laravel Sanctum, and optional team management.',
                'project_type' => 'Starter Kit',
                'github_url' => 'https://github.com/laravel/jetstream',
                'documentation_url' => 'https://jetstream.laravel.com',
                'stars' => 3900,
                'forks' => 780,
                'tags' => ['starter-kit', 'authentication', 'teams']
            ],
            [
                'name' => 'Laravel Debugbar',
                'short_description' => 'PHP Debugbar integration for Laravel',
                'full_description' => 'This is a package to integrate PHP Debug Bar with Laravel. It includes a ServiceProvider to register the debugbar and attach it to the output. You can publish assets and configure it through Laravel.',
                'project_type' => 'Tool',
                'github_url' => 'https://github.com/barryvdh/laravel-debugbar',
                'stars' => 16200,
                'forks' => 1500,
                'tags' => ['debugging', 'development', 'profiling']
            ],
            [
                'name' => 'Laravel Excel',
                'short_description' => 'Supercharged Excel exports and imports',
                'full_description' => 'Laravel Excel is intended at being Laravel-flavoured PhpSpreadsheet: a simple, but elegant wrapper around PhpSpreadsheet with the goal of simplifying exports and imports.',
                'project_type' => 'Package',
                'github_url' => 'https://github.com/SpartnerNL/Laravel-Excel',
                'documentation_url' => 'https://docs.laravel-excel.com',
                'stars' => 12000,
                'forks' => 1800,
                'tags' => ['excel', 'import', 'export']
            ]
        ];

        foreach ($projects as $project) {
            Project::create(array_merge($project, [
                'user_id' => $user->id,
                'is_featured' => rand(0, 1) === 1,
                'is_published' => true
            ]));
        }
    }
}