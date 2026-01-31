<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('opensource_projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('short_description');
            $table->longText('full_description')->nullable();
            $table->string('project_type')->default('Package');
            $table->string('github_url');
            $table->string('demo_url')->nullable();
            $table->string('documentation_url')->nullable();
            $table->integer('stars')->default(0);
            $table->integer('forks')->default(0);
            $table->integer('watchers')->default(0);
            $table->json('tags')->nullable();
            $table->string('license')->nullable();
            $table->boolean('featured')->default(false);
            $table->boolean('approved')->default(false);
            $table->string('status')->default('active');
            $table->timestamp('last_commit_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('opensource_projects');
    }
};