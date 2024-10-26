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
        Schema::create('c_v_skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cv_basic_info_id') // Foreign key to link to cv_basic_infos table
                ->constrained('cv_basic_infos') // References the 'id' column on the 'cv_basic_infos' table
                ->onDelete('cascade'); // Cascades on delete
            $table->string('skill_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('c_v_skills');
    }
};
