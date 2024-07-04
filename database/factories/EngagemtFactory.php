<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Engagemt>
 */
class EngagemtFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            "author_id" => $this->faker->numberBetween(1, 10),
            "story_id" => $this->faker->numberBetween(1,20),
            "follow" => $this->faker->boolean(),
            "favorite" => $this->faker->boolean(),
        ];
    }
}
