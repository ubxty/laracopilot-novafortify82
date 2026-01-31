<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('opensource_projects')) {
            Schema::create('opensource_projects', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('slug')->unique();
                $table->text('description');
                $table->string('github_url');
                $table->string('website_url')->nullable();
                $table->integer('stars')->default(0);
                $table->integer('forks')->default(0);
                $table->json('tags')->nullable();
                $table->boolean('is_featured')->default(false);
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('opensource_projects');
    }
};