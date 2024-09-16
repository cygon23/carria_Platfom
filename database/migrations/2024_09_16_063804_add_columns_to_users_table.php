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
            $table->string('phone', 20)->nullable();
            $table->string('department', 200)->nullable();
            $table->string('languages', 200)->nullable();
            $table->text('bio')->nullable();
            $table->string('profile_image_url', 255)->nullable();
            $table->binary('cv')->nullable();
            $table->string('target_role', 100)->nullable();
            $table->enum('subscription_type', ['Free', 'Premium'])->default('Free');
            $table->enum('user_type', ['admin', 'company', 'job_seeker'])->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone',
                'department',
                'languages',
                'bio',
                'profile_image_url',
                'cv',
                'target_role',
                'subscription_type',
                'user_type',
                'status',
            ]);
        });
    }
};
