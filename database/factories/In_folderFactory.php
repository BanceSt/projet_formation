<?php

namespace Database\Factories;

use App\Models\Folder;
use App\Models\Story;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\In_folder>
 */
class In_folderFactory extends Factory
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
            "folder_id" => Folder::inRandomOrder()->first()->id,
            "story_id" => Story::inRandomOrder()->first()->id,
        ];
    }
}
