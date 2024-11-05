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
            "illustration" => $this->random_image(),
            "reponse" => $this->faker->sentence(6),
            "user_id" => User::inRandomOrder()->first(),

        ];
    }

    public function may_generate_words($chanceOfGettingTrue)
    {
        //  Chance de genere une phrase en fonction du pourcentage donné
        if (fake()->boolean($chanceOfGettingTrue)) {
            return implode(" ", $this->faker->words(20)) ;
        } else {
            return null;
        }
    }

    public function random_image() {
        // retourne le chemin d'une image au hasard
        return "HnG0" . strval($this->faker->numberBetween(1, 9)) . ".png";
    }
}
