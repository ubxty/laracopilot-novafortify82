<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('opensource_projects', function (Blueprint $table) {
            $table->string('short_description', 300)->after('name');
            $table->string('project_type')->after('tags')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('opensource_projects', function (Blueprint $table) {
            $table->dropColumn(['short_description', 'project_type']);
        });
    }
};