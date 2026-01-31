<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OpensourceProject;
use App\Models\User;

class OpensourceProjectSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();

        if (!$user) {
            $user = User::create([
                'name' => 'Admin User',
                'email' => 'admin@laravelcommunity.com',
                'password' => bcrypt('admin123'),
                'github_username' => 'laravelcommunity'
            ]);
        }

        $projects = [
            [
                'name' => 'Laravel API Boilerplate',
                'description' => 'A comprehensive Laravel API boilerplate with JWT authentication, role-based access control, API versioning, and comprehensive documentation. Perfect for kickstarting your next API project.',
                'github_url' => 'https://github.com/laravelcommunity/api-boilerplate',
                'demo_url' => 'https://api-boilerplate-demo.com',
                'image_url' => 'https://via.placeholder.com/600x400/3B82F6/FFFFFF?text=API+Boilerplate',
                'tags' => ['api', 'jwt', 'authentication', 'laravel', 'boilerplate'],
                'stars' => 1250,
                'forks' => 340,
                'featured' => true,
                'active' => true
            ],
            [
                'name' => 'Laravel Multi-Tenant Package',
                'description' => 'Powerful multi-tenancy package for Laravel applications. Supports database separation, subdomain routing, and tenant-specific configurations. Production-ready and fully tested.',
                'github_url' => 'https://github.com/laravelcommunity/multi-tenant',
                'demo_url' => 'https://multi-tenant-demo.com',
                'image_url' => 'https://via.placeholder.com/600x400/10B981/FFFFFF?text=Multi-Tenant',
                'tags' => ['multi-tenant', 'saas', 'laravel', 'package'],
                'stars' => 890,
                'forks' => 210,
                'featured' => true,
                'active' => true
            ],
            [
                'name' => 'Laravel Admin Dashboard',
                'description' => 'Modern and feature-rich admin dashboard built with Laravel and Livewire. Includes user management, analytics, and customizable widgets. Tailwind CSS for beautiful UI.',
                'github_url' => 'https://github.com/laravelcommunity/admin-dashboard',
                'demo_url' => 'https://admin-demo.laravelcommunity.com',
                'image_url' => 'https://via.placeholder.com/600x400/8B5CF6/FFFFFF?text=Admin+Dashboard',
                'tags' => ['admin', 'dashboard', 'livewire', 'tailwind'],
                'stars' => 2340,
                'forks' => 567,
                'featured' => true,
                'active' => true
            ],
            [
                'name' => 'Laravel E-commerce Starter',
                'description' => 'Complete e-commerce solution with product management, shopping cart, checkout, payment integration (Stripe), and order management. Built with Laravel and Vue.js.',
                'github_url' => 'https://github.com/laravelcommunity/ecommerce-starter',
                'demo_url' => 'https://shop-demo.com',
                'image_url' => 'https://via.placeholder.com/600x400/F59E0B/FFFFFF?text=E-commerce',
                'tags' => ['ecommerce', 'shop', 'stripe', 'vuejs'],
                'stars' => 1780,
                'forks' => 445,
                'featured' => false,
                'active' => true
            ],
            [
                'name' => 'Laravel Social Authentication',
                'description' => 'Easy social authentication integration for Laravel. Supports Google, Facebook, Twitter, GitHub, and more. Simple configuration and customizable callbacks.',
                'github_url' => 'https://github.com/laravelcommunity/social-auth',
                'demo_url' => null,
                'image_url' => 'https://via.placeholder.com/600x400/EF4444/FFFFFF?text=Social+Auth',
                'tags' => ['authentication', 'social', 'oauth', 'laravel'],
                'stars' => 620,
                'forks' => 156,
                'featured' => false,
                'active' => true
            ],
            [
                'name' => 'Laravel Real-time Chat',
                'description' => 'Real-time chat application built with Laravel, Pusher, and Vue.js. Includes private messaging, group chats, typing indicators, and read receipts.',
                'github_url' => 'https://github.com/laravelcommunity/realtime-chat',
                'demo_url' => 'https://chat-demo.com',
                'image_url' => 'https://via.placeholder.com/600x400/06B6D4/FFFFFF?text=Chat+App',
                'tags' => ['chat', 'realtime', 'pusher', 'websockets'],
                'stars' => 1120,
                'forks' => 289,
                'featured' => false,
                'active' => true
            ],
            [
                'name' => 'Laravel Analytics Dashboard',
                'description' => 'Beautiful analytics dashboard with charts, graphs, and real-time data visualization. Integrates with Google Analytics and custom tracking.',
                'github_url' => 'https://github.com/laravelcommunity/analytics-dashboard',
                'demo_url' => 'https://analytics-demo.com',
                'image_url' => 'https://via.placeholder.com/600x400/14B8A6/FFFFFF?text=Analytics',
                'tags' => ['analytics', 'dashboard', 'charts', 'visualization'],
                'stars' => 780,
                'forks' => 198,
                'featured' => false,
                'active' => true
            ],
            [
                'name' => 'Laravel Blog System',
                'description' => 'Complete blog system with markdown editor, categories, tags, comments, and SEO optimization. Admin panel included for content management.',
                'github_url' => 'https://github.com/laravelcommunity/blog-system',
                'demo_url' => 'https://blog-demo.com',
                'image_url' => 'https://via.placeholder.com/600x400/EC4899/FFFFFF?text=Blog+System',
                'tags' => ['blog', 'cms', 'markdown', 'seo'],
                'stars' => 945,
                'forks' => 234,
                'featured' => false,
                'active' => true
            ],
            [
                'name' => 'Laravel REST API Testing Suite',
                'description' => 'Comprehensive testing suite for Laravel REST APIs. Includes feature tests, integration tests, and API documentation generator.',
                'github_url' => 'https://github.com/laravelcommunity/api-testing',
                'demo_url' => null,
                'image_url' => 'https://via.placeholder.com/600x400/6366F1/FFFFFF?text=API+Testing',
                'tags' => ['testing', 'api', 'phpunit', 'documentation'],
                'stars' => 540,
                'forks' => 123,
                'featured' => false,
                'active' => true
            ],
            [
                'name' => 'Laravel File Manager',
                'description' => 'Powerful file manager for Laravel applications. Supports local and cloud storage (S3, Google Cloud), drag-and-drop uploads, and file sharing.',
                'github_url' => 'https://github.com/laravelcommunity/file-manager',
                'demo_url' => 'https://files-demo.com',
                'image_url' => 'https://via.placeholder.com/600x400/F97316/FFFFFF?text=File+Manager',
                'tags' => ['files', 'storage', 'cloud', 's3'],
                'stars' => 1450,
                'forks' => 367,
                'featured' => false,
                'active' => true
            ],
            [
                'name' => 'Laravel Notification System',
                'description' => 'Advanced notification system with email, SMS, push notifications, and in-app alerts. Queue support and customizable templates included.',
                'github_url' => 'https://github.com/laravelcommunity/notification-system',
                'demo_url' => null,
                'image_url' => 'https://via.placeholder.com/600x400/84CC16/FFFFFF?text=Notifications',
                'tags' => ['notifications', 'email', 'sms', 'push'],
                'stars' => 670,
                'forks' => 145,
                'featured' => false,
                'active' => true
            ],
            [
                'name' => 'Laravel Payment Gateway',
                'description' => 'Universal payment gateway integration for Laravel. Supports Stripe, PayPal, Razorpay, and more. Easy configuration and transaction management.',
                'github_url' => 'https://github.com/laravelcommunity/payment-gateway',
                'demo_url' => 'https://payment-demo.com',
                'image_url' => 'https://via.placeholder.com/600x400/A855F7/FFFFFF?text=Payment+Gateway',
                'tags' => ['payment', 'stripe', 'paypal', 'billing'],
                'stars' => 1890,
                'forks' => 478,
                'featured' => false,
                'active' => true
            ],
            [
                'name' => 'Laravel Task Scheduler UI',
                'description' => 'Beautiful web UI for managing Laravel scheduled tasks. Monitor cron jobs, view execution history, and manage task schedules from the browser.',
                'github_url' => 'https://github.com/laravelcommunity/scheduler-ui',
                'demo_url' => 'https://scheduler-demo.com',
                'image_url' => 'https://via.placeholder.com/600x400/0EA5E9/FFFFFF?text=Scheduler+UI',
                'tags' => ['scheduler', 'cron', 'tasks', 'automation'],
                'stars' => 820,
                'forks' => 201,
                'featured' => false,
                'active' => true
            ],
            [
                'name' => 'Laravel Inventory Management',
                'description' => 'Complete inventory management system with stock tracking, barcode scanning, reporting, and multi-location support. Perfect for warehouses and retail.',
                'github_url' => 'https://github.com/laravelcommunity/inventory-management',
                'demo_url' => 'https://inventory-demo.com',
                'image_url' => 'https://via.placeholder.com/600x400/D946EF/FFFFFF?text=Inventory',
                'tags' => ['inventory', 'warehouse', 'stock', 'barcode'],
                'stars' => 1340,
                'forks' => 356,
                'featured' => false,
                'active' => true
            ],
            [
                'name' => 'Laravel Learning Management System',
                'description' => 'Full-featured LMS with course creation, student enrollment, video streaming, quizzes, certificates, and progress tracking.',
                'github_url' => 'https://github.com/laravelcommunity/lms',
                'demo_url' => 'https://lms-demo.com',
                'image_url' => 'https://via.placeholder.com/600x400/F43F5E/FFFFFF?text=LMS',
                'tags' => ['education', 'lms', 'courses', 'learning'],
                'stars' => 2150,
                'forks' => 534,
                'featured' => false,
                'active' => true
            ]
        ];

        foreach ($projects as $projectData) {
            OpensourceProject::create(array_merge($projectData, ['user_id' => $user->id]));
        }
    }
}