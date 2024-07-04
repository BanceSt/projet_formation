<?php

namespace Database\Factories;

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
            "author_id" => $this->faker->numberBetween(1, 10),
            "name" => $this->faker->word(),
            "description" => $this->faker->sentence(3),
            "categorie" => $this->faker->randomElement(["creations", "favorites"])
        ];
    }
}
