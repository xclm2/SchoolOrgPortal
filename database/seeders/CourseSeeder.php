<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('courses')->insert([
            ['created_at' => now(), 'name' => 'BSIT'],
            ['created_at' => now(), 'name' => 'BSED'],
            ['created_at' => now(), 'name' => 'BEED'],
            ['created_at' => now(), 'name' => 'BSCRIM'],
            ['created_at' => now(), 'name' => 'HM']
        ]);
    }
}
