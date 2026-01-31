<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create example user from LaraconEU QR
        User::create([
            'name' => 'Ravdeep Singh',
            'full_name' => 'Ravdeep Singh',
            'email' => 'ravdeep@example.com',
            'password' => Hash::make('password123'),
            'laracon_uuid' => 'ae7616a3-572c-48d6-ae2a-80a7221bdd3f',
            'role' => 'user',
            'email_verified_at' => now()
        ]);

        // Create admin user
        User::create([
            'name' => 'Admin User',
            'full_name' => 'Administrator',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'email_verified_at' => now()
        ]);

        // Create additional test users
        User::create([
            'name' => 'John Doe',
            'full_name' => 'John Alexander Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password123'),
            'laracon_uuid' => '123e4567-e89b-12d3-a456-426614174000',
            'role' => 'user',
            'email_verified_at' => now()
        ]);

        User::create([
            'name' => 'Jane Smith',
            'full_name' => 'Jane Elizabeth Smith',
            'email' => 'jane@example.com',
            'password' => Hash::make('password123'),
            'laracon_uuid' => '987fcdeb-51a2-43d7-9876-fedcba098765',
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

        // Generate additional random users using factory
        User::factory()->count(15)->create();
    }
}