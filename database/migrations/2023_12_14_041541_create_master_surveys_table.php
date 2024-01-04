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
        Schema::create('plant_survey_master', function (Blueprint $table) {
            $table->id();
            $table->foreignId('survey_id');
            $table->foreignId('plant_id');
            $table->unsignedInteger('number_present')->nullable();
            $table->string('occurrence')->nullable();
            $table->string('regeneration')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plant_survey_master');
    }
};
