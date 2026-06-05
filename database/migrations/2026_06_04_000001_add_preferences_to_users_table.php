<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('language', 10)->default('id')->after('is_active');
            $table->string('timezone', 64)->default('Asia/Jakarta')->after('language');
            $table->boolean('email_notifications')->default(true)->after('timezone');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['language', 'timezone', 'email_notifications']);
        });
    }
};
