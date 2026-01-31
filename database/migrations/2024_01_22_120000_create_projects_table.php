<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('projects')) {
            Schema::create('projects', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->string('name');
                $table->string('slug')->unique();
                $table->text('short_description');
                $table->longText('full_description')->nullable();
                $table->enum('project_type', ['Package', 'Framework', 'Starter Kit', 'Tool', 'Application']);
                $table->string('github_url');
                $table->string('demo_url')->nullable();
                $table->string('documentation_url')->nullable();
                $table->integer('stars')->default(0);
                $table->integer('forks')->default(0);
                $table->json('tags')->nullable();
                $table->boolean('is_featured')->default(false);
                $table->boolean('is_published')->default(true);
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('projects');
    }
};