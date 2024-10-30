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
        // $story_tag_check = [];
        Tags::factory(100)->create();

        // $story_tags = Story_tag::factory(1000)->make();

        // foreach ($story_tags as $story_tag) {
        //     $story_id = $story_tag->story_id;
        //     $tags_id = $story_tag->tags_id;

        //     if (isset($story_tag_check[$story_id])) {
        //         $try = 0;
        //         $fail = true;
        //         do {
        //             if (!in_array($tags_id, $story_tag_check[$story_id])) {
        //                 $story_tag_check[$story_id][] = $tags_id;
        //                 $story_tag->tags_id = $tags_id;
        //                 $fail = false;
        //                 $try = 5;
        //             }
        //             $tags_id = Tags::inRandomOrder()->first()->id;
        //             $try++;
        //         } while ($try < 5);

        //         if ($fail) continue;
        //     } else {
        //         $story_tag_check[$story_id] = [$tags_id];
        //     }
        //     $story_tag->save();
        // }

        // S'assuer que chaque histoire à au moins un tag
        $stories= Story::all();
        foreach ($stories as $story) {
            $rd_tags = Tags::inRandomOrder()->take(fake()->numberBetween(3, 15))->pluck("id");
            $story->tags()->attach($rd_tags);
        }
    }
}
