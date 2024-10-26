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
        Schema::create('awards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cv_basic_info_id') // Foreign key to link to cv_basic_infos table
                ->constrained('cv_basic_infos') // References the 'id' column on the 'cv_basic_infos' table
                ->onDelete('cascade'); // Cascades on delete
            $table->string('award_name'); // Name of the award
            $table->string('awarding_institution'); // Name of the awarding institution
            $table->date('date_awarded'); // Date the award was received
            $table->text('description')->nullable(); // Description of the award
            $table->timestamps(); // Created and updated timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('awards');
    }
};
