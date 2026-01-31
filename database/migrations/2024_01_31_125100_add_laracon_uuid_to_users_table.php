<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Check if laracon_uuid column doesn't exist before adding
            if (!Schema::hasColumn('users', 'laracon_uuid')) {
                $table->string('laracon_uuid')->nullable()->unique()->after('password');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Check if laracon_uuid column exists before dropping
            if (Schema::hasColumn('users', 'laracon_uuid')) {
                $table->dropColumn('laracon_uuid');
            }
        });
    }
};