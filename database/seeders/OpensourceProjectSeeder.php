<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OpensourceProject;
use App\Models\User;

class OpensourceProjectSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        $projects = [
            [
                'name' => 'Laravel Admin Panel',
                'short_description' => 'A beautiful and feature-rich admin panel built with Laravel and Tailwind CSS',
                'description' => '# Laravel Admin Panel\n\nA comprehensive admin panel solution for Laravel applications.\n\n## Features\n- User management\n- Role-based access control\n- Dashboard analytics\n- RESTful API\n\n## Installation\n```bash\ncomposer require vendor/laravel-admin-panel\n```',
                'github_url' => 'https://github.com/laravel/framework',
                'demo_url' => 'https://demo-admin.laravel.com',
                'project_type' => 'Package',
                'tags' => ['admin', 'dashboard', 'crud'],
                'stars' => 1250,
                'forks' => 340,
                'featured' => true,
                'active' => true
            ],
            [
                'name' => 'API Boilerplate',
                'short_description' => 'Production-ready Laravel API boilerplate with authentication and API versioning',
                'description' => '# Laravel API Boilerplate\n\nJumpstart your API development with this comprehensive boilerplate.\n\n## Features\n- JWT Authentication\n- API Versioning\n- Rate Limiting\n- Comprehensive documentation\n\n## Quick Start\n```bash\ncomposer create-project vendor/api-boilerplate\n```',
                'github_url' => 'https://github.com/laravel/laravel',
                'demo_url' => null,
                'project_type' => 'Boilerplate',
                'tags' => ['api', 'jwt', 'boilerplate'],
                'stars' => 890,
                'forks' => 220,
                'featured' => true,
                'active' => true
            ],
            [
                'name' => 'E-commerce Starter Kit',
                'short_description' => 'Complete e-commerce solution with payment integration and inventory management',
                'description' => '# E-commerce Starter Kit\n\nFull-featured e-commerce platform built on Laravel.\n\n## Features\n- Product catalog\n- Shopping cart\n- Payment gateway integration\n- Order management\n- Inventory tracking\n\n## Installation\n```bash\ngit clone https://github.com/vendor/ecommerce-starter\n```',
                'github_url' => 'https://github.com/example/ecommerce',
                'demo_url' => 'https://ecommerce-demo.com',
                'project_type' => 'App',
                'tags' => ['ecommerce', 'shop', 'payment'],
                'stars' => 2100,
                'forks' => 580,
                'featured' => true,
                'active' => true
            ],
            [
                'name' => 'Social Media Manager',
                'short_description' => 'Manage multiple social media accounts from one Laravel-powered dashboard',
                'description' => '# Social Media Manager\n\nStreamline your social media management workflow.\n\n## Features\n- Multi-platform support\n- Schedule posts\n- Analytics dashboard\n- Team collaboration\n\n## Getting Started\n```bash\ncomposer require vendor/social-manager\n```',
                'github_url' => 'https://github.com/example/social-manager',
                'demo_url' => 'https://social-demo.com',
                'project_type' => 'Tool',
                'tags' => ['social-media', 'scheduler', 'analytics'],
                'stars' => 670,
                'forks' => 150,
                'featured' => false,
                'active' => true
            ],
            [
                'name' => 'Laravel QR Generator',
                'short_description' => 'Generate beautiful and customizable QR codes in your Laravel applications',
                'description' => '# Laravel QR Generator\n\nEasily generate QR codes in Laravel.\n\n## Features\n- Multiple formats\n- Customizable colors\n- Logo embedding\n- Batch generation\n\n## Usage\n```php\nQRCode::generate("https://example.com");\n```',
                'github_url' => 'https://github.com/example/qr-generator',
                'demo_url' => null,
                'project_type' => 'Package',
                'tags' => ['qr-code', 'generator', 'utility'],
                'stars' => 450,
                'forks' => 90,
                'featured' => false,
                'active' => true
            ],
            [
                'name' => 'Task Management System',
                'short_description' => 'Collaborative task management tool with teams, projects, and real-time updates',
                'description' => '# Task Management System\n\nPowerful task management for teams.\n\n## Features\n- Team collaboration\n- Project organization\n- Task assignments\n- Real-time updates\n- Progress tracking\n\n## Installation\n```bash\ngit clone https://github.com/example/task-manager\n```',
                'github_url' => 'https://github.com/example/task-manager',
                'demo_url' => 'https://tasks-demo.com',
                'project_type' => 'App',
                'tags' => ['tasks', 'project-management', 'collaboration'],
                'stars' => 1420,
                'forks' => 310,
                'featured' => true,
                'active' => true
            ],
            [
                'name' => 'Laravel SEO Toolkit',
                'short_description' => 'Comprehensive SEO tools and meta tag management for Laravel applications',
                'description' => '# Laravel SEO Toolkit\n\nOptimize your Laravel app for search engines.\n\n## Features\n- Meta tag management\n- Sitemap generation\n- Open Graph tags\n- Schema markup\n\n## Quick Start\n```bash\ncomposer require vendor/seo-toolkit\n```',
                'github_url' => 'https://github.com/example/seo-toolkit',
                'demo_url' => null,
                'project_type' => 'Package',
                'tags' => ['seo', 'meta-tags', 'sitemap'],
                'stars' => 580,
                'forks' => 120,
                'featured' => false,
                'active' => true
            ],
            [
                'name' => 'Notification Center',
                'short_description' => 'Multi-channel notification system supporting email, SMS, and push notifications',
                'description' => '# Notification Center\n\nUnified notification system for Laravel.\n\n## Features\n- Email notifications\n- SMS integration\n- Push notifications\n- Notification history\n- Template management\n\n## Installation\n```bash\ncomposer require vendor/notification-center\n```',
                'github_url' => 'https://github.com/example/notification-center',
                'demo_url' => 'https://notifications-demo.com',
                'project_type' => 'Package',
                'tags' => ['notifications', 'email', 'sms'],
                'stars' => 920,
                'forks' => 210,
                'featured' => false,
                'active' => true
            ],
            [
                'name' => 'Blog Platform',
                'short_description' => 'Modern blogging platform with markdown support and comment system',
                'description' => '# Blog Platform\n\nFull-featured blogging solution built with Laravel.\n\n## Features\n- Markdown editor\n- Comment system\n- Categories and tags\n- SEO optimized\n- Social sharing\n\n## Getting Started\n```bash\ngit clone https://github.com/example/blog-platform\n```',
                'github_url' => 'https://github.com/example/blog-platform',
                'demo_url' => 'https://blog-demo.com',
                'project_type' => 'App',
                'tags' => ['blog', 'cms', 'markdown'],
                'stars' => 1680,
                'forks' => 420,
                'featured' => true,
                'active' => true
            ],
            [
                'name' => 'Laravel Debugger Pro',
                'short_description' => 'Advanced debugging and profiling tool for Laravel development',
                'description' => '# Laravel Debugger Pro\n\nPowerful debugging tools for Laravel developers.\n\n## Features\n- Query profiling\n- Request/Response logging\n- Performance metrics\n- Error tracking\n\n## Installation\n```bash\ncomposer require vendor/debugger-pro --dev\n```',
                'github_url' => 'https://github.com/example/debugger-pro',
                'demo_url' => null,
                'project_type' => 'Tool',
                'tags' => ['debugging', 'profiling', 'development'],
                'stars' => 760,
                'forks' => 180,
                'featured' => false,
                'active' => true
            ],
            [
                'name' => 'Multi-tenant SaaS Kit',
                'short_description' => 'Build multi-tenant SaaS applications with tenant isolation and subscription management',
                'description' => '# Multi-tenant SaaS Kit\n\nComplete SaaS boilerplate with multi-tenancy.\n\n## Features\n- Tenant isolation\n- Subscription management\n- Billing integration\n- User management\n- API access\n\n## Installation\n```bash\ncomposer create-project vendor/saas-kit\n```',
                'github_url' => 'https://github.com/example/saas-kit',
                'demo_url' => 'https://saas-demo.com',
                'project_type' => 'Boilerplate',
                'tags' => ['saas', 'multi-tenant', 'subscription'],
                'stars' => 1950,
                'forks' => 490,
                'featured' => true,
                'active' => true
            ],
            [
                'name' => 'Image Optimizer',
                'short_description' => 'Automatic image optimization and resizing for Laravel applications',
                'description' => '# Image Optimizer\n\nOptimize images automatically in Laravel.\n\n## Features\n- Automatic compression\n- Multiple format support\n- Responsive images\n- CDN integration\n\n## Usage\n```php\nImage::optimize("path/to/image.jpg");\n```',
                'github_url' => 'https://github.com/example/image-optimizer',
                'demo_url' => null,
                'project_type' => 'Package',
                'tags' => ['images', 'optimization', 'performance'],
                'stars' => 540,
                'forks' => 110,
                'featured' => false,
                'active' => true
            ],
            [
                'name' => 'Learning Management System',
                'short_description' => 'Complete LMS with courses, quizzes, and student progress tracking',
                'description' => '# Learning Management System\n\nBuild online courses with Laravel.\n\n## Features\n- Course management\n- Video hosting\n- Quiz system\n- Progress tracking\n- Certificates\n\n## Installation\n```bash\ngit clone https://github.com/example/lms\n```',
                'github_url' => 'https://github.com/example/lms',
                'demo_url' => 'https://lms-demo.com',
                'project_type' => 'App',
                'tags' => ['education', 'lms', 'courses'],
                'stars' => 2340,
                'forks' => 620,
                'featured' => true,
                'active' => true
            ],
            [
                'name' => 'API Rate Limiter',
                'short_description' => 'Flexible rate limiting solution for Laravel APIs with Redis support',
                'description' => '# API Rate Limiter\n\nAdvanced rate limiting for Laravel APIs.\n\n## Features\n- Redis support\n- Custom rules\n- IP-based limiting\n- User-based limiting\n\n## Installation\n```bash\ncomposer require vendor/rate-limiter\n```',
                'github_url' => 'https://github.com/example/rate-limiter',
                'demo_url' => null,
                'project_type' => 'Package',
                'tags' => ['api', 'rate-limiting', 'security'],
                'stars' => 390,
                'forks' => 75,
                'featured' => false,
                'active' => true
            ],
            [
                'name' => 'CRM Dashboard',
                'short_description' => 'Customer relationship management system with lead tracking and sales pipeline',
                'description' => '# CRM Dashboard\n\nManage customer relationships effectively.\n\n## Features\n- Contact management\n- Lead tracking\n- Sales pipeline\n- Email integration\n- Reporting\n\n## Getting Started\n```bash\ngit clone https://github.com/example/crm-dashboard\n```',
                'github_url' => 'https://github.com/example/crm-dashboard',
                'demo_url' => 'https://crm-demo.com',
                'project_type' => 'App',
                'tags' => ['crm', 'sales', 'management'],
                'stars' => 1820,
                'forks' => 440,
                'featured' => true,
                'active' => true
            ]
        ];

        foreach ($projects as $projectData) {
            OpensourceProject::create(array_merge($projectData, [
                'user_id' => $users->random()->id
            ]));
        }
    }
}