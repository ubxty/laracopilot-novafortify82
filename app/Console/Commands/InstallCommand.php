<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class InstallCommand extends Command
{
    protected $signature = 'community:install {--fresh : Drop all tables and run fresh migrations}';
    protected $description = 'Install Laravel Community platform with migrations and seeders';

    public function handle()
    {
        $this->info('🚀 Installing Laravel Community Platform...');
        $this->newLine();

        // Check if fresh flag is set
        $fresh = $this->option('fresh');

        if ($fresh) {
            if (!$this->confirm('⚠️  This will drop all tables and data. Are you sure?', false)) {
                $this->error('Installation cancelled.');
                return 1;
            }

            $this->info('🔄 Running fresh migrations...');
            $this->newLine();
            
            Artisan::call('migrate:fresh', [], $this->getOutput());
            $this->info('✅ Fresh migrations completed');
        } else {
            $this->info('🔄 Running migrations...');
            $this->newLine();
            
            Artisan::call('migrate', ['--force' => true], $this->getOutput());
            $this->info('✅ Migrations completed');
        }

        $this->newLine();
        $this->info('🌱 Seeding database...');
        $this->newLine();
        
        Artisan::call('db:seed', ['--force' => true], $this->getOutput());
        $this->info('✅ Database seeded successfully');

        $this->newLine();
        $this->info('🎉 Installation completed successfully!');
        $this->newLine();
        
        $this->displayInfo();

        return 0;
    }

    protected function displayInfo()
    {
        $this->info('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
        $this->info('📋 INSTALLATION SUMMARY');
        $this->info('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
        $this->newLine();
        
        $this->line('✅ Migrations executed');
        $this->line('✅ Database seeded with sample data');
        $this->newLine();
        
        $this->info('🔐 TEST USER CREDENTIALS:');
        $this->line('   Email: taylor@laravel.com');
        $this->line('   Password: password');
        $this->newLine();
        
        $this->info('🎫 VALID QR CODES FOR REGISTRATION:');
        $this->line('   • LARACON2024');
        $this->line('   • LARACON-VIP');
        $this->line('   • LARACON-SPEAKER');
        $this->line('   • LARACON-ATTENDEE');
        $this->newLine();
        
        $this->info('📊 SAMPLE DATA CREATED:');
        $this->line('   • 20 Users (including 5 Laravel celebrities)');
        $this->line('   • 40 Projects (15 real + 25 generated)');
        $this->newLine();
        
        $this->info('🌐 NEXT STEPS:');
        $this->line('   1. Start server: php artisan serve');
        $this->line('   2. Visit: http://localhost:8000');
        $this->line('   3. Login or register with QR code');
        $this->newLine();
        
        $this->info('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
    }
}