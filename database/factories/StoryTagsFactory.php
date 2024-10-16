<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StoryTags>
 */
class StoryTagsFactory extends Factory
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
            "story_id" => $this->faker->numberBetween(1,20),
            "tag_id" => $this->faker->numberBetween(1, 5),
        ];
    }
}
