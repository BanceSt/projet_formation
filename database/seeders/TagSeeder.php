<?php

namespace Database\Seeders;

use App\Models\Story;
use App\Models\Story_tag;
use App\Models\Tags;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Tags::factory(100)->create();

        $stories= Story::all();
        foreach ($stories as $story) {
            $rd_tags = Tags::inRandomOrder()->take(fake()->numberBetween(3, 15))->pluck("id");
            $story->tags()->attach($rd_tags);
        }
    }
}
