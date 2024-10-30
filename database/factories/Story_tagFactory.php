<?php

namespace Database\Factories;

use App\Models\Story;
use App\Models\Story_tag;
use App\Models\Tags;
use Illuminate\Database\Eloquent\Factories\Factory;
use SebastianBergmann\Type\FalseType;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Story_tag>
 */
class Story_tagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Vérifier l'existence de la combinaison avant d'insérer

        return [
            'story_id' => Story::inRandomOrder()->first()->id,
            'tags_id' => Tags::inRandomOrder()->first()->id,
        ];
    }
}
