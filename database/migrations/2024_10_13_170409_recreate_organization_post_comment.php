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
        Schema::dropIfExists('organization_post_comment');
        Schema::create('organization_post_comment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->references('id')->on('organization_post')->onDelete('cascade');
            $table->foreignId('member_id')->references('id')->on('organization_member')->onDelete('cascade');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('comment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organization_post_comment');
    }
};
