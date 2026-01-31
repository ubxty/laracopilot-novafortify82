<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'name' => 'Taylor Otwell',
                'email' => 'taylor@laravel.com',
                'password' => Hash::make('password'),
                'github_username' => 'taylorotwell',
                'qr_code_verified' => true
            ],
            [
                'name' => 'Mohamed Said',
                'email' => 'mohamed@laravel.com',
                'password' => Hash::make('password'),
                'github_username' => 'themsaid',
                'qr_code_verified' => true
            ],
            [
                'name' => 'Freek Van der Herten',
                'email' => 'freek@spatie.be',
                'password' => Hash::make('password'),
                'github_username' => 'freekmurze',
                'qr_code_verified' => true
            ],
            [
                'name' => 'Nuno Maduro',
                'email' => 'nuno@laravel.com',
                'password' => Hash::make('password'),
                'github_username' => 'nunomaduro',
                'qr_code_verified' => true
            ],
            [
                'name' => 'Jess Archer',
                'email' => 'jess@laravel.com',
                'password' => Hash::make('password'),
                'github_username' => 'jessarcher',
                'qr_code_verified' => true
            ]
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }

        User::factory()->count(15)->create();
    }
}