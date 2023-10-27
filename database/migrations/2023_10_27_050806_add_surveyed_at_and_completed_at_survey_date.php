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
        Schema::table('survey_user', function (Blueprint $table) {
            $table->dateTime('surveyed_at')->after('created_at')->nullable();
            $table->dateTime('completed_at')->after('surveyed_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('survey_user', function (Blueprint $table) {
            $table->dropColumn('surveyed_at');
            $table->dropColumn('completed_at');


        });
    }
};
