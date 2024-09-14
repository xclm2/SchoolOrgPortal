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
        Schema::create('metric_frequencies', function (Blueprint $table) {
            $table->id();
            $table->string('frequency');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->unique(['frequency', 'start_date', 'end_date']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('metric_frequency');
    }
};
