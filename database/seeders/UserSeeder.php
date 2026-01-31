<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create test users
        User::create([
            'name' => 'John Developer',
            'email' => 'john@example.com',
            'password' => Hash::make('password123'),
            'github_username' => 'johndoe',
            'email_verified_at' => now()
        ]);

        User::create([
            'name' => 'Sarah Smith',
            'email' => 'sarah@example.com',
            'password' => Hash::make('password123'),
            'github_username' => 'sarahsmith',
            'email_verified_at' => now()
        ]);

        User::create([
            'name' => 'Mike Johnson',
            'email' => 'mike@example.com',
            'password' => Hash::make('password123'),
            'github_username' => 'mikej',
            'email_verified_at' => now()
        ]);

        // Create additional random users
        User::factory()->count(7)->create();
    }
}