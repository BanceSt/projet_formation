<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Folder>
 */
class FolderFactory extends Factory
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
            "user_id" => User::inRandomOrder()->first()->id,
            "name" => $this->faker->word(),
            "description" => $this->faker->sentence(3),
            "categorie" => $this->faker->randomElement(["creations", "favorites"])
        ];
    }
}
