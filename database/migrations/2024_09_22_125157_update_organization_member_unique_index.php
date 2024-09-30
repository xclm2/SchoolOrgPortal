<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $duplicates = DB::table('organization_member')->groupBy('organization_id', 'user_id')->havingRaw('COUNT(*) > 1')->get();
        $duplicatesArr = [];
        foreach($duplicates as $duplicate) {
            $duplicatesArr['organization'][] = $duplicate->organization_id;
            $duplicatesArr['user'][] = $duplicate->user_id;
        }

        if (!empty($duplicatesArr)) {
            DB::table('organization_member')
                ->whereIn('organization_id', $duplicatesArr['organization'])
                ->whereIn('user_id', $duplicatesArr['user'])->delete();
        }

        Schema::table('organization_member', function (Blueprint $table) {
            $table->unique(['organization_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $duplicates =
        DB::table('organization_member')->whereIn('id', [1, 2, 3])->delete();
    }
};
