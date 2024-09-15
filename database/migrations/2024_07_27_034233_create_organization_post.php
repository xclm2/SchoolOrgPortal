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
        Schema::create('organization_post', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id')->references('id')->on('organization')->onDelete('cascade');
            $table->foreignId('member_id')->references('id')->on('organization_member')->onDelete('cascade');
            $table->enum('privacy', ['public', 'member_only'])->default('public');
            $table->enum('notify_member', ['yes','no'])->default('no');
            $table->text('post');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organization_post');
    }
};
