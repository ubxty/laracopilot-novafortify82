<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OpensourceProject;
use App\Models\User;
use Illuminate\Support\Str;

class OpensourceProjectSeeder extends Seeder
{
    public function run()
    {
        $user = User::first();
        
        if (!$user) {
            $user = User::create([
                'name' => 'Demo User',
                'email' => 'demo@example.com',
                'password' => bcrypt('password')
            ]);
        }

        $projects = [
            [
                'name' => 'Laravel Debugbar',
                'short_description' => 'A debug bar for Laravel applications providing detailed insights into requests, queries, and performance.',
                'full_description' => 'Laravel Debugbar integrates PHP Debug Bar with Laravel. It displays profiler data in the browser, including database queries, route information, views, mails, and much more. Essential tool for Laravel development.',
                'project_type' => 'Package',
                'github_url' => 'https://github.com/barryvdh/laravel-debugbar',
                'stars' => 15400,
                'forks' => 1520,
                'watchers' => 320,
                'tags' => json_encode(['debugging', 'profiler', 'development', 'laravel']),
                'license' => 'MIT',
                'featured' => true,
                'approved' => true
            ],
            [
                'name' => 'Laravel Permission',
                'short_description' => 'Associate users with roles and permissions in Laravel applications with an intuitive API.',
                'full_description' => 'This package allows you to manage user permissions and roles in a database. It provides a simple and consistent API to handle authorization in your Laravel app.',
                'project_type' => 'Package',
                'github_url' => 'https://github.com/spatie/laravel-permission',
                'demo_url' => 'https://spatie.be/docs/laravel-permission',
                'stars' => 11800,
                'forks' => 1680,
                'watchers' => 245,
                'tags' => json_encode(['permissions', 'roles', 'authorization', 'acl']),
                'license' => 'MIT',
                'featured' => true,
                'approved' => true
            ],
            [
                'name' => 'Laravel Horizon',
                'short_description' => 'Beautiful dashboard and configuration system for Laravel powered Redis queues.',
                'full_description' => 'Horizon provides a beautiful dashboard and code-driven configuration for your Laravel powered Redis queues. Horizon allows you to easily monitor key metrics of your queue system.',
                'project_type' => 'Package',
                'github_url' => 'https://github.com/laravel/horizon',
                'documentation_url' => 'https://laravel.com/docs/horizon',
                'stars' => 3700,
                'forks' => 658,
                'watchers' => 95,
                'tags' => json_encode(['queues', 'redis', 'monitoring', 'dashboard']),
                'license' => 'MIT',
                'featured' => true,
                'approved' => true
            ],
            [
                'name' => 'Laravel Sanctum',
                'short_description' => 'Lightweight authentication system for SPAs, mobile applications, and simple token-based APIs.',
                'full_description' => 'Laravel Sanctum provides a featherweight authentication system for SPAs (single page applications), mobile applications, and simple, token based APIs.',
                'project_type' => 'Package',
                'github_url' => 'https://github.com/laravel/sanctum',
                'documentation_url' => 'https://laravel.com/docs/sanctum',
                'stars' => 2600,
                'forks' => 298,
                'watchers' => 67,
                'tags' => json_encode(['authentication', 'api', 'spa', 'tokens']),
                'license' => 'MIT',
                'featured' => true,
                'approved' => true
            ],
            [
                'name' => 'Laravel Backup',
                'short_description' => 'Backup your Laravel app with a simple artisan command that stores backups on multiple filesystems.',
                'full_description' => 'This Laravel package creates a backup of your application. The backup is a zip file that contains all files in the directories you specify along with a dump of your database.',
                'project_type' => 'Package',
                'github_url' => 'https://github.com/spatie/laravel-backup',
                'stars' => 5400,
                'forks' => 798,
                'watchers' => 125,
                'tags' => json_encode(['backup', 'database', 'storage', 'utility']),
                'license' => 'MIT',
                'featured' => true,
                'approved' => true
            ],
            [
                'name' => 'Laravel Telescope',
                'short_description' => 'Elegant debug assistant providing insight into requests, exceptions, database queries, and more.',
                'full_description' => 'Laravel Telescope makes a wonderful companion to your local Laravel development environment. Telescope provides insight into the requests coming into your application, exceptions, log entries, database queries, queued jobs, mail, notifications, cache operations, scheduled tasks, variable dumps and more.',
                'project_type' => 'Package',
                'github_url' => 'https://github.com/laravel/telescope',
                'documentation_url' => 'https://laravel.com/docs/telescope',
                'stars' => 4700,
                'forks' => 565,
                'watchers' => 98,
                'tags' => json_encode(['debugging', 'monitoring', 'development', 'tools']),
                'license' => 'MIT',
                'featured' => true,
                'approved' => true
            ],
            [
                'name' => 'Laravel Livewire',
                'short_description' => 'Full-stack framework for Laravel that makes building dynamic interfaces simple without leaving PHP.',
                'full_description' => 'Livewire is a full-stack framework for Laravel that makes building dynamic interfaces simple, without leaving the comfort of Laravel. It is a great alternative to using Vue or React.',
                'project_type' => 'Framework',
                'github_url' => 'https://github.com/livewire/livewire',
                'demo_url' => 'https://livewire.laravel.com',
                'stars' => 21500,
                'forks' => 1320,
                'watchers' => 425,
                'tags' => json_encode(['frontend', 'reactive', 'components', 'fullstack']),
                'license' => 'MIT',
                'featured' => false,
                'approved' => true
            ],
            [
                'name' => 'Laravel Breeze',
                'short_description' => 'Minimal, simple implementation of Laravel authentication including login, registration, and more.',
                'full_description' => 'Laravel Breeze is a minimal, simple implementation of all of Laravel\'s authentication features, including login, registration, password reset, email verification, and password confirmation.',
                'project_type' => 'Starter Kit',
                'github_url' => 'https://github.com/laravel/breeze',
                'documentation_url' => 'https://laravel.com/docs/starter-kits#laravel-breeze',
                'stars' => 2600,
                'forks' => 428,
                'watchers' => 52,
                'tags' => json_encode(['authentication', 'starter-kit', 'scaffolding']),
                'license' => 'MIT',
                'featured' => false,
                'approved' => true
            ],
            [
                'name' => 'Laravel Jetstream',
                'short_description' => 'Beautifully designed application scaffolding for Laravel with authentication, teams, and more.',
                'full_description' => 'Laravel Jetstream is a beautifully designed application scaffolding for Laravel. Jetstream provides the perfect starting point for your next Laravel application and includes login, registration, email verification, two-factor authentication, session management, API support via Laravel Sanctum, and optional team management.',
                'project_type' => 'Starter Kit',
                'github_url' => 'https://github.com/laravel/jetstream',
                'documentation_url' => 'https://jetstream.laravel.com',
                'stars' => 3800,
                'forks' => 785,
                'watchers' => 89,
                'tags' => json_encode(['authentication', 'teams', 'starter-kit', 'scaffolding']),
                'license' => 'MIT',
                'featured' => false,
                'approved' => true
            ],
            [
                'name' => 'Laravel Media Library',
                'short_description' => 'Associate files with Eloquent models and generate image conversions with an elegant API.',
                'full_description' => 'This package can associate all sorts of files with Eloquent models. It provides a simple, fluent API to work with. Additionally, it can create image manipulations on images and pdfs that have been added to the media library.',
                'project_type' => 'Package',
                'github_url' => 'https://github.com/spatie/laravel-medialibrary',
                'stars' => 5600,
                'forks' => 1025,
                'watchers' => 142,
                'tags' => json_encode(['media', 'files', 'images', 'uploads']),
                'license' => 'MIT',
                'featured' => false,
                'approved' => true
            ],
            [
                'name' => 'Laravel Excel',
                'short_description' => 'Supercharged Excel exports and imports for Laravel with elegant syntax and powerful features.',
                'full_description' => 'Laravel Excel is intended at being Laravel-flavoured PhpSpreadsheet: a simple, but elegant wrapper around PhpSpreadsheet with the goal of simplifying exports and imports.',
                'project_type' => 'Package',
                'github_url' => 'https://github.com/SpartnerNL/Laravel-Excel',
                'demo_url' => 'https://laravel-excel.com',
                'stars' => 12100,
                'forks' => 1870,
                'watchers' => 265,
                'tags' => json_encode(['excel', 'export', 'import', 'spreadsheet']),
                'license' => 'MIT',
                'featured' => false,
                'approved' => true
            ],
            [
                'name' => 'Laravel Socialite',
                'short_description' => 'OAuth authentication with Facebook, Twitter, Google, LinkedIn, GitHub, GitLab and Bitbucket.',
                'full_description' => 'Laravel Socialite provides an expressive, fluent interface to OAuth authentication with various providers. It handles almost all of the boilerplate social authentication code you are dreading writing.',
                'project_type' => 'Package',
                'github_url' => 'https://github.com/laravel/socialite',
                'documentation_url' => 'https://laravel.com/docs/socialite',
                'stars' => 5400,
                'forks' => 962,
                'watchers' => 138,
                'tags' => json_encode(['oauth', 'social-login', 'authentication', 'facebook', 'google']),
                'license' => 'MIT',
                'featured' => false,
                'approved' => true
            ],
            [
                'name' => 'Laravel Cashier',
                'short_description' => 'Manage Stripe and Paddle subscription billing with expressive, fluent interface.',
                'full_description' => 'Laravel Cashier provides an expressive, fluent interface to Stripe\'s and Paddle\'s subscription billing services. It handles almost all of the boilerplate subscription billing code you are dreading writing.',
                'project_type' => 'Package',
                'github_url' => 'https://github.com/laravel/cashier',
                'documentation_url' => 'https://laravel.com/docs/billing',
                'stars' => 2300,
                'forks' => 658,
                'watchers' => 78,
                'tags' => json_encode(['billing', 'stripe', 'paddle', 'subscriptions', 'payments']),
                'license' => 'MIT',
                'featured' => false,
                'approved' => true
            ],
            [
                'name' => 'Laravel Dusk',
                'short_description' => 'Browser automation and testing API providing expressive way to test JavaScript-driven applications.',
                'full_description' => 'Laravel Dusk provides an expressive, easy-to-use browser automation and testing API. By default, Dusk does not require you to install JDK or Selenium on your local computer.',
                'project_type' => 'Package',
                'github_url' => 'https://github.com/laravel/dusk',
                'documentation_url' => 'https://laravel.com/docs/dusk',
                'stars' => 1800,
                'forks' => 412,
                'watchers' => 58,
                'tags' => json_encode(['testing', 'browser', 'automation', 'e2e']),
                'license' => 'MIT',
                'featured' => false,
                'approved' => true
            ],
            [
                'name' => 'Laravel Passport',
                'short_description' => 'Full OAuth2 server implementation providing complete authentication for API-driven applications.',
                'full_description' => 'Laravel Passport provides a full OAuth2 server implementation for your Laravel application in a matter of minutes. Passport is built on top of the League OAuth2 server.',
                'project_type' => 'Package',
                'github_url' => 'https://github.com/laravel/passport',
                'documentation_url' => 'https://laravel.com/docs/passport',
                'stars' => 3200,
                'forks' => 788,
                'watchers' => 95,
                'tags' => json_encode(['oauth2', 'authentication', 'api', 'tokens']),
                'license' => 'MIT',
                'featured' => false,
                'approved' => true
            ]
        ];

        foreach ($projects as $project) {
            OpensourceProject::create(array_merge($project, [
                'user_id' => $user->id,
                'slug' => Str::slug($project['name']),
                'last_commit_at' => now()->subDays(rand(1, 30))
            ]));
        }
    }
}