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
            "question" => $this->faker->sentence(6),
            "note" => $this->may_generate_words(50),

            "user_id" => User::inRandomOrder()->first(),

        ];
    }

    public function may_generate_words($chanceOfGettingTrue)
    {
        if (fake()->boolean($chanceOfGettingTrue)) {
            return implode(" ", $this->faker->words(20)) ;
        } else {
            return null;
        }
    }


}
