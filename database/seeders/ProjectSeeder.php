<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\User;

class ProjectSeeder extends Seeder
{
    public function run()
    {
        $projects = [
            [
                'name' => 'Laravel Horizon',
                'description' => 'Beautiful queue monitoring dashboard for Laravel applications with real-time metrics and job insights.',
                'repository_url' => 'https://github.com/laravel/horizon',
                'demo_url' => 'https://horizon.laravel.com',
                'tags' => 'queue,monitoring,redis,dashboard',
                'is_published' => true
            ],
            [
                'name' => 'Laravel Telescope',
                'description' => 'Elegant debug assistant for Laravel applications providing insights into requests, exceptions, database queries, and more.',
                'repository_url' => 'https://github.com/laravel/telescope',
                'demo_url' => null,
                'tags' => 'debugging,monitoring,development,tools',
                'is_published' => true
            ],
            [
                'name' => 'Spatie Laravel Permission',
                'description' => 'Associate users with roles and permissions in Laravel applications with an elegant and flexible API.',
                'repository_url' => 'https://github.com/spatie/laravel-permission',
                'demo_url' => null,
                'tags' => 'roles,permissions,authentication,authorization',
                'is_published' => true
            ],
            [
                'name' => 'Laravel Sanctum',
                'description' => 'Simple token-based API authentication for Laravel applications and SPAs.',
                'repository_url' => 'https://github.com/laravel/sanctum',
                'demo_url' => null,
                'tags' => 'api,authentication,spa,tokens',
                'is_published' => true
            ],
            [
                'name' => 'Laravel Livewire',
                'description' => 'Full-stack framework for Laravel that makes building dynamic interfaces simple without leaving PHP.',
                'repository_url' => 'https://github.com/livewire/livewire',
                'demo_url' => 'https://livewire.laravel.com',
                'tags' => 'frontend,reactive,components,full-stack',
                'is_published' => true
            ],
            [
                'name' => 'Laravel Excel',
                'description' => 'Supercharged Excel exports and imports for Laravel with support for charts, styling, and large datasets.',
                'repository_url' => 'https://github.com/spartnerpartner/laravel-excel',
                'demo_url' => null,
                'tags' => 'excel,export,import,csv',
                'is_published' => true
            ],
            [
                'name' => 'Laravel Backup',
                'description' => 'Create backups of your Laravel application including database and files with multiple storage options.',
                'repository_url' => 'https://github.com/spatie/laravel-backup',
                'demo_url' => null,
                'tags' => 'backup,database,storage,automation',
                'is_published' => true
            ],
            [
                'name' => 'Laravel Pint',
                'description' => 'Opinionated PHP code style fixer for minimalists built on top of PHP-CS-Fixer.',
                'repository_url' => 'https://github.com/laravel/pint',
                'demo_url' => null,
                'tags' => 'code-style,formatter,quality,tools',
                'is_published' => true
            ],
            [
                'name' => 'Laravel Debugbar',
                'description' => 'Integrates PHP Debug Bar with Laravel to display debug information in your browser.',
                'repository_url' => 'https://github.com/barryvdh/laravel-debugbar',
                'demo_url' => null,
                'tags' => 'debugging,development,performance,profiling',
                'is_published' => true
            ],
            [
                'name' => 'Laravel Media Library',
                'description' => 'Associate files with Eloquent models and generate conversions like thumbnails and optimized images.',
                'repository_url' => 'https://github.com/spatie/laravel-medialibrary',
                'demo_url' => null,
                'tags' => 'media,images,uploads,storage',
                'is_published' => true
            ],
            [
                'name' => 'Laravel Cashier',
                'description' => 'Expressive, fluent interface to Stripe and Paddle subscription billing services.',
                'repository_url' => 'https://github.com/laravel/cashier',
                'demo_url' => null,
                'tags' => 'billing,stripe,subscriptions,payments',
                'is_published' => true
            ],
            [
                'name' => 'Laravel Scout',
                'description' => 'Simple, driver-based solution for adding full-text search to Eloquent models.',
                'repository_url' => 'https://github.com/laravel/scout',
                'demo_url' => null,
                'tags' => 'search,algolia,elasticsearch,full-text',
                'is_published' => true
            ],
            [
                'name' => 'Laravel Dusk',
                'description' => 'Expressive, easy-to-use browser automation and testing API for Laravel applications.',
                'repository_url' => 'https://github.com/laravel/dusk',
                'demo_url' => null,
                'tags' => 'testing,browser,automation,e2e',
                'is_published' => true
            ],
            [
                'name' => 'Laravel Socialite',
                'description' => 'Simple, convenient way to authenticate with OAuth providers like Facebook, Twitter, Google, and more.',
                'repository_url' => 'https://github.com/laravel/socialite',
                'demo_url' => null,
                'tags' => 'oauth,social-login,authentication,providers',
                'is_published' => true
            ],
            [
                'name' => 'Laravel Vapor',
                'description' => 'Zero-maintenance, auto-scaling serverless deployment platform for Laravel powered by AWS.',
                'repository_url' => 'https://github.com/laravel/vapor-cli',
                'demo_url' => 'https://vapor.laravel.com',
                'tags' => 'serverless,aws,deployment,scaling',
                'is_published' => true
            ]
        ];

        $users = User::all();

        foreach ($projects as $projectData) {
            Project::create(array_merge($projectData, [
                'user_id' => $users->random()->id
            ]));
        }

        Project::factory()->count(25)->create();
    }
}