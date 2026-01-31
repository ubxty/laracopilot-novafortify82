<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $features = [
            [
                'icon' => '🚀',
                'title' => 'Fast Performance',
                'description' => 'Built with modern technologies for lightning-fast load times and optimal user experience.'
            ],
            [
                'icon' => '🎨',
                'title' => 'Beautiful Design',
                'description' => 'Carefully crafted interfaces with attention to detail and user-centered design principles.'
            ],
            [
                'icon' => '🔒',
                'title' => 'Secure & Reliable',
                'description' => 'Enterprise-grade security measures to protect your data and ensure business continuity.'
            ],
            [
                'icon' => '📱',
                'title' => 'Mobile Responsive',
                'description' => 'Fully responsive design that works seamlessly across all devices and screen sizes.'
            ]
        ];

        $services = [
            [
                'title' => 'Web Development',
                'description' => 'Custom web applications built with Laravel, React, and modern web technologies.',
                'color' => 'from-blue-500 to-blue-700'
            ],
            [
                'title' => 'Mobile Apps',
                'description' => 'Native and cross-platform mobile applications for iOS and Android devices.',
                'color' => 'from-purple-500 to-purple-700'
            ],
            [
                'title' => 'Cloud Solutions',
                'description' => 'Scalable cloud infrastructure and deployment solutions for your business.',
                'color' => 'from-green-500 to-green-700'
            ],
            [
                'title' => 'UI/UX Design',
                'description' => 'Beautiful and intuitive user interfaces designed for maximum engagement.',
                'color' => 'from-pink-500 to-pink-700'
            ],
            [
                'title' => 'Consulting',
                'description' => 'Expert technology consulting to guide your digital transformation journey.',
                'color' => 'from-indigo-500 to-indigo-700'
            ],
            [
                'title' => 'Support & Maintenance',
                'description' => '24/7 technical support and ongoing maintenance for your applications.',
                'color' => 'from-orange-500 to-orange-700'
            ]
        ];

        $testimonials = [
            [
                'name' => 'Sarah Johnson',
                'position' => 'CEO, TechStart Inc',
                'content' => 'Working with this team has been an absolute pleasure. They delivered our project on time and exceeded all expectations.',
                'rating' => 5
            ],
            [
                'name' => 'Michael Chen',
                'position' => 'CTO, Digital Solutions',
                'content' => 'The quality of work and attention to detail is outstanding. Our application performs flawlessly and our users love it.',
                'rating' => 5
            ],
            [
                'name' => 'Emily Rodriguez',
                'position' => 'Product Manager, InnovateCo',
                'content' => 'Professional, responsive, and highly skilled. They transformed our ideas into a beautiful, functional product.',
                'rating' => 5
            ]
        ];

        return view('welcome', compact('features', 'services', 'testimonials'));
    }
}