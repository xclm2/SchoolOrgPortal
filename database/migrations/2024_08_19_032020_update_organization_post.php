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
        Schema::table('organization_post', function (Blueprint $table) {
            $table->date('end_date')->nullable()->after('post');
            $table->date('start_date')->nullable()->after('post');
            $table->string('title')->nullable(false)->after('post');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
