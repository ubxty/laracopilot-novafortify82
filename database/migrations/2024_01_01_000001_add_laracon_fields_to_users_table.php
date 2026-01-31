<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('laracon_uuid')->nullable()->unique()->after('email');
            $table->boolean('laracon_badge_scanned')->default(false)->after('laracon_uuid');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['laracon_uuid', 'laracon_badge_scanned']);
        });
    }
};