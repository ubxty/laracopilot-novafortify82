<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('laracon_uuid')->unique()->nullable()->after('email');
            $table->string('full_name')->nullable()->after('name');
            $table->enum('role', ['user', 'admin'])->default('user')->after('password');
            
            // Add index for laracon_uuid for faster lookups
            $table->index('laracon_uuid');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['laracon_uuid']);
            $table->dropColumn(['laracon_uuid', 'full_name', 'role']);
        });
    }
};