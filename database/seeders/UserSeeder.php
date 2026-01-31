<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create example user from Laracon
        User::create([
            'name' => 'Ravdeep Singh',
            'full_name' => 'Ravdeep Singh',
            'email' => 'ravdeep@laracon.com',
            'password' => Hash::make('password123'),
            'laracon_uuid' => 'ae7616a3-572c-48d6-ae2a-80a7221bdd3f',
            'role' => 'user',
            'email_verified_at' => now()
        ]);

        // Create admin user
        User::create([
            'name' => 'Admin User',
            'full_name' => 'Administrator',
            'email' => 'admin@laravel.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'email_verified_at' => now()
        ]);

        // Create additional test users
        User::create([
            'name' => 'John Doe',
            'full_name' => 'John Michael Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password123'),
            'laracon_uuid' => '550e8400-e29b-41d4-a716-446655440000',
            'role' => 'user',
            'email_verified_at' => now()
        ]);

        User::create([
            'name' => 'Jane Smith',
            'full_name' => 'Jane Elizabeth Smith',
            'email' => 'jane@example.com',
            'password' => Hash::make('password123'),
            'laracon_uuid' => '6ba7b810-9dad-11d1-80b4-00c04fd430c8',
            'role' => 'user',
            'email_verified_at' => now()
        ]);

        User::create([
            'name' => 'Mike Johnson',
            'full_name' => 'Michael Robert Johnson',
            'email' => 'mike@example.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
            'email_verified_at' => now()
        ]);

        // Generate additional random users
        User::factory()->count(15)->create();
    }
}