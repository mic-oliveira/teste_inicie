<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->numerify('######'),
            'post_id' => (int)fake()->numerify('######'),
            'name' => fake()->name(),
            'email' => fake()->email(),
            'body' => fake()->text(),
        ];
    }
}
