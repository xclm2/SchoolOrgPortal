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
        Schema::create('metrics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('frequency_id')->constrained('metric_frequencies');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('total');
            $table->string('code');
            $table->string('group')->nullable();
            $table->timestamps();
            $table->unique(['frequency_id', 'code']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('metrics');
    }
};
