<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\User;

class ProjectSeeder extends Seeder
{
    public function run()
    {
        $users = User::where('role', 'user')->get();

        $projects = [
            [
                'name' => 'Laravel E-commerce Platform',
                'description' => 'Full-featured e-commerce platform built with Laravel 11, featuring product management, shopping cart, payment integration, and order tracking.',
                'github_url' => 'https://github.com/ravdeep/laravel-ecommerce',
                'demo_url' => 'https://demo.laravel-ecommerce.test',
                'tags' => json_encode(['Laravel', 'E-commerce', 'Stripe', 'Vue.js']),
                'stars' => 324,
                'forks' => 87,
                'active' => true
            ],
            [
                'name' => 'SaaS Starter Kit',
                'description' => 'Production-ready SaaS boilerplate with multi-tenancy, subscription billing, team management, and admin dashboard.',
                'github_url' => 'https://github.com/ravdeep/saas-starter',
                'demo_url' => 'https://saas-demo.test',
                'tags' => json_encode(['SaaS', 'Multi-tenancy', 'Billing', 'Teams']),
                'stars' => 512,
                'forks' => 143,
                'active' => true
            ],
            [
                'name' => 'API Gateway',
                'description' => 'Microservices API gateway with rate limiting, authentication, request transformation, and monitoring built on Laravel.',
                'github_url' => 'https://github.com/ravdeep/api-gateway',
                'tags' => json_encode(['API', 'Microservices', 'Gateway', 'Laravel']),
                'stars' => 267,
                'forks' => 54,
                'active' => true
            ],
            [
                'name' => 'Real-time Chat Application',
                'description' => 'WebSocket-based real-time chat with private messaging, group chats, file sharing, and emoji reactions.',
                'github_url' => 'https://github.com/john/realtime-chat',
                'demo_url' => 'https://chat-demo.test',
                'tags' => json_encode(['WebSocket', 'Chat', 'Real-time', 'Pusher']),
                'stars' => 189,
                'forks' => 42,
                'active' => true
            ],
            [
                'name' => 'Task Management System',
                'description' => 'Kanban-style task manager with drag-and-drop, time tracking, team collaboration, and project analytics.',
                'github_url' => 'https://github.com/sarah/task-manager',
                'demo_url' => 'https://tasks.test',
                'tags' => json_encode(['Task Management', 'Kanban', 'Teams', 'Analytics']),
                'stars' => 421,
                'forks' => 98,
                'active' => true
            ],
            [
                'name' => 'Blog CMS',
                'description' => 'Modern content management system with markdown support, media library, SEO optimization, and multi-author support.',
                'github_url' => 'https://github.com/john/blog-cms',
                'tags' => json_encode(['CMS', 'Blog', 'Markdown', 'SEO']),
                'stars' => 156,
                'forks' => 33,
                'active' => true
            ],
            [
                'name' => 'Inventory Management',
                'description' => 'Complete inventory tracking system with barcode scanning, stock alerts, supplier management, and reporting.',
                'github_url' => 'https://github.com/sarah/inventory-system',
                'demo_url' => 'https://inventory.test',
                'tags' => json_encode(['Inventory', 'Barcode', 'Stock', 'Reports']),
                'stars' => 234,
                'forks' => 67,
                'active' => true
            ],
            [
                'name' => 'Learning Management System',
                'description' => 'Full LMS with course creation, video lessons, quizzes, certificates, and student progress tracking.',
                'github_url' => 'https://github.com/ravdeep/lms-platform',
                'demo_url' => 'https://learn.test',
                'tags' => json_encode(['LMS', 'Education', 'Courses', 'Certificates']),
                'stars' => 678,
                'forks' => 234,
                'active' => true
            ],
            [
                'name' => 'Restaurant POS',
                'description' => 'Point of sale system for restaurants with table management, kitchen display, online ordering, and reporting.',
                'github_url' => 'https://github.com/john/restaurant-pos',
                'tags' => json_encode(['POS', 'Restaurant', 'Orders', 'Kitchen']),
                'stars' => 145,
                'forks' => 38,
                'active' => true
            ],
            [
                'name' => 'Event Management Platform',
                'description' => 'Complete event platform with ticketing, QR code check-in, attendee management, and analytics.',
                'github_url' => 'https://github.com/sarah/event-platform',
                'demo_url' => 'https://events.test',
                'tags' => json_encode(['Events', 'Ticketing', 'QR Code', 'Analytics']),
                'stars' => 289,
                'forks' => 72,
                'active' => true
            ],
            [
                'name' => 'HR Management System',
                'description' => 'Employee management with attendance tracking, leave management, payroll, and performance reviews.',
                'github_url' => 'https://github.com/ravdeep/hr-system',
                'tags' => json_encode(['HR', 'Payroll', 'Attendance', 'Performance']),
                'stars' => 198,
                'forks' => 45,
                'active' => true
            ],
            [
                'name' => 'Social Media Dashboard',
                'description' => 'Multi-platform social media management tool with post scheduling, analytics, and engagement tracking.',
                'github_url' => 'https://github.com/john/social-dashboard',
                'demo_url' => 'https://social.test',
                'tags' => json_encode(['Social Media', 'Analytics', 'Scheduling', 'API']),
                'stars' => 367,
                'forks' => 89,
                'active' => true
            ],
            [
                'name' => 'CRM System',
                'description' => 'Customer relationship management with lead tracking, pipeline management, email integration, and reporting.',
                'github_url' => 'https://github.com/sarah/crm-system',
                'tags' => json_encode(['CRM', 'Sales', 'Pipeline', 'Leads']),
                'stars' => 445,
                'forks' => 123,
                'active' => true
            ],
            [
                'name' => 'Booking System',
                'description' => 'Appointment and reservation system with calendar integration, notifications, and payment processing.',
                'github_url' => 'https://github.com/ravdeep/booking-system',
                'demo_url' => 'https://book.test',
                'tags' => json_encode(['Booking', 'Calendar', 'Appointments', 'Payments']),
                'stars' => 312,
                'forks' => 78,
                'active' => true
            ],
            [
                'name' => 'Analytics Dashboard',
                'description' => 'Business intelligence dashboard with real-time metrics, custom reports, and data visualization.',
                'github_url' => 'https://github.com/john/analytics-dashboard',
                'demo_url' => 'https://analytics.test',
                'tags' => json_encode(['Analytics', 'BI', 'Reports', 'Charts']),
                'stars' => 523,
                'forks' => 156,
                'active' => true
            ]
        ];

        foreach ($projects as $projectData) {
            Project::create(array_merge($projectData, [
                'user_id' => $users->random()->id
            ]));
        }
    }
}