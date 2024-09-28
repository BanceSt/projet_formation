<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Story>
 */
class StoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "title" => $this->faker->sentence(6),
            "accroche" => implode(" ", $this->faker->words(6)),
            "content" => $this->faker->paragraph(15),

            "user_id" => User::inRandomOrder()->first(),

        ];
    }
}
