<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // public function up(): void
    // {
    //     Schema::table('jobs_', function (Blueprint $table) {
    //         $table->foreignId('user_id')->after('job_type_id')->constrained()->onDelete('cascade');
    //     });
    // }

    public function up(): void
    {
        Schema::table('jobs_', function (Blueprint $table) {
            // Check if the 'user_id' column does not exist before adding it
            if (!Schema::hasColumn('jobs_', 'user_id')) {
                $table->foreignId('user_id')
                    ->after('job_type_id')
                    ->constrained()
                    ->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    // public function down(): void
    // {
    //     Schema::table('jobs_', function (Blueprint $table) {
    //         $table->dropForeign(['user_id']);
    //         $table->dropColumn('user_id');
    //     });
    // }
    public function down(): void
    {
        Schema::table('jobs_', function (Blueprint $table) {
            // Drop the foreign key constraint and the column if it exists
            if (Schema::hasColumn('jobs_', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }
        });
    }
};
