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
		Schema::table('users', function (Blueprint $table) {
			$table->string('lastname')->after('name')->nullable();
			$table->enum('type', ['student', 'admin', 'adviser'])->default('student')->after('phone');
			$table->bigInteger('course_id')->after('type')->nullable();
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
