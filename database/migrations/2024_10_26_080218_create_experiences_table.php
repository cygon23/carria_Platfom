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

        Schema::create('experiences', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('cv_basic_info_id') // Foreign key to link to cv_basic_infos table
                ->constrained('cv_basic_infos') // References the 'id' column on the 'cv_basic_infos' table
                ->onDelete('cascade'); // Cascades on delete
            $table->string('job_title'); // Job title
            $table->string('company_name'); // Company name
            $table->string('location')->nullable(); // Optional location
            $table->date('start_date'); // Start date of employment
            $table->date('end_date')->nullable(); // Optional end date if the job is ongoing
            $table->text('description')->nullable(); // Optional job description
            $table->timestamps(); // Created and updated timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('experiences');
    }
};
