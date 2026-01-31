<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'laracon_uuid')) {
                $table->string('laracon_uuid')->nullable()->unique()->after('email_verified_at');
            }
            if (!Schema::hasColumn('users', 'pin')) {
                $table->string('pin', 6)->nullable()->after('password');
            }
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'laracon_uuid')) {
                $table->dropColumn('laracon_uuid');
            }
            if (Schema::hasColumn('users', 'pin')) {
                $table->dropColumn('pin');
            }
        });
    }
};