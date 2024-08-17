<?php

namespace Database\Factories\Organization;

use App\Models\Organization\Post;
use Illuminate\Database\Eloquent\Factories\Factory;


class PostFactory extends Factory
{

    public function definition()
    {
        return [
            'organization_id' => 5,
            'member_id' => 3,
            'post' => 'This is the body of a sample post.',
        ];
    }
}
