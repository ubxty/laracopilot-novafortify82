<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallCommand extends Command
{
    protected $signature = 'community:install';
    protected $description = 'Install and configure the Laravel Community Projects application';

    public function handle()
    {
        $this->info('🚀 Starting Laravel Community Projects installation...');
        $this->newLine();

        // Step 1: Check if .env exists
        if (!File::exists(base_path('.env'))) {
            $this->comment('📄 Creating .env file from .env.example...');
            File::copy(base_path('.env.example'), base_path('.env'));
            $this->info('✓ .env file created');
        } else {
            $this->comment('📄 .env file already exists');
        }
        $this->newLine();

        // Step 2: Update .env configuration
        $this->comment('⚙️  Configuring .env file...');
        $this->updateEnvFile();
        $this->info('✓ .env configuration updated');
        $this->newLine();

        // Step 3: Generate application key
        $this->comment('🔑 Generating application key...');
        $this->call('key:generate');
        $this->info('✓ Application key generated');
        $this->newLine();

        // Step 4: Run migrations
        $this->comment('🗄️  Running database migrations...');
        $this->call('migrate:fresh');
        $this->info('✓ Database migrations completed');
        $this->newLine();

        // Step 5: Seed database
        $this->comment('🌱 Seeding database with sample data...');
        $this->call('db:seed');
        $this->info('✓ Database seeded successfully');
        $this->newLine();

        // Step 6: Create storage link
        $this->comment('🔗 Creating storage symlink...');
        $this->call('storage:link');
        $this->info('✓ Storage link created');
        $this->newLine();

        // Step 7: Clear caches
        $this->comment('🧹 Clearing application caches...');
        $this->call('config:clear');
        $this->call('cache:clear');
        $this->call('view:clear');
        $this->call('route:clear');
        $this->info('✓ Caches cleared');
        $this->newLine();

        // Success message
        $this->info('✅ Installation completed successfully!');
        $this->newLine();
        
        // Display credentials
        $this->line('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
        $this->info('📋 Default Login Credentials:');
        $this->line('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
        $this->newLine();
        
        $this->comment('Admin Account:');
        $this->line('  Email: admin@laravel.com');
        $this->line('  Password: admin123');
        $this->newLine();
        
        $this->comment('Laracon User (Ravdeep Singh):');
        $this->line('  Email: ravdeep@laracon.com');
        $this->line('  Password: password123');
        $this->line('  UUID: ae7616a3-572c-48d6-ae2a-80a7221bdd3f');
        $this->newLine();
        
        $this->comment('Test User:');
        $this->line('  Email: john@example.com');
        $this->line('  Password: password123');
        $this->newLine();
        
        $this->line('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
        $this->info('🌐 Application Configuration:');
        $this->line('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
        $this->newLine();
        
        $this->line('  APP_NAME: Laravel Community Projects');
        $this->line('  APP_URL: http://localhost:8000');
        $this->line('  APP_ENV: local');
        $this->line('  DB_CONNECTION: mysql');
        $this->line('  DB_DATABASE: laravelcommunitycom');
        $this->line('  SESSION_DRIVER: database');
        $this->newLine();
        
        $this->line('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
        $this->info('🚀 Next Steps:');
        $this->line('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
        $this->newLine();
        
        $this->line('  1. Start the development server:');
        $this->comment('     php artisan serve');
        $this->newLine();
        
        $this->line('  2. Visit the application:');
        $this->comment('     http://localhost:8000');
        $this->newLine();
        
        $this->line('  3. Login with the credentials above');
        $this->newLine();
        
        $this->line('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
        
        return self::SUCCESS;
    }

    protected function updateEnvFile()
    {
        $envPath = base_path('.env');
        $envContent = File::get($envPath);

        // Configuration values to set
        $configurations = [
            'APP_NAME' => 'Laravel Community Projects',
            'APP_ENV' => 'local',
            'APP_DEBUG' => 'true',
            'APP_TIMEZONE' => 'UTC',
            'APP_URL' => 'http://localhost:8000',
            
            'DB_CONNECTION' => 'mysql',
            'DB_HOST' => '127.0.0.1',
            'DB_PORT' => '3306',
            'DB_DATABASE' => 'laravelcommunitycom',
            'DB_USERNAME' => 'laravelcommunitycom',
            'DB_PASSWORD' => 'VP6AaJQHMiyvw7XHZj5e',
            
            'SESSION_DRIVER' => 'database',
            'SESSION_LIFETIME' => '120',
            
            'CACHE_STORE' => 'database',
            
            'QUEUE_CONNECTION' => 'database',
            
            'MAIL_MAILER' => 'log',
            'MAIL_FROM_ADDRESS' => 'noreply@laravelcommunity.com',
            'MAIL_FROM_NAME' => 'Laravel Community Projects',
        ];

        foreach ($configurations as $key => $value) {
            // Escape special characters in the value
            $escapedValue = $value;
            
            // Check if the key exists in the .env file
            if (preg_match("/^{$key}=/m", $envContent)) {
                // Update existing key - handle values with special characters
                if (in_array($key, ['DB_PASSWORD', 'APP_NAME', 'MAIL_FROM_NAME', 'MAIL_FROM_ADDRESS'])) {
                    // Wrap in quotes for values that might contain special characters
                    $envContent = preg_replace(
                        "/^{$key}=.*/m",
                        "{$key}=\"" . addslashes($escapedValue) . "\"",
                        $envContent
                    );
                } else {
                    // Simple replacement for regular values
                    $envContent = preg_replace(
                        "/^{$key}=.*/m",
                        "{$key}={$escapedValue}",
                        $envContent
                    );
                }
            } else {
                // Add new key at the end of the file
                if (in_array($key, ['DB_PASSWORD', 'APP_NAME', 'MAIL_FROM_NAME', 'MAIL_FROM_ADDRESS'])) {
                    $envContent .= "\n{$key}=\"" . addslashes($escapedValue) . "\"";
                } else {
                    $envContent .= "\n{$key}={$escapedValue}";
                }
            }
        }

        File::put($envPath, $envContent);
        
        $this->line('  → Configured MySQL database: laravelcommunitycom');
        $this->line('  → Database host: 127.0.0.1:3306');
        $this->line('  → Session driver set to: database');
    }
}