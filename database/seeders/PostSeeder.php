<?php

namespace Database\Seeders;

use App\Models\Organization\Post;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostSeeder extends Seeder
{
    public function run()
    {
        Post::factory()->count(10)->create();
    }

}
