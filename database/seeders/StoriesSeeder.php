<?php

namespace Database\Seeders;

use App\Models\Story;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $stories = Story::factory(300)->make([
                    "question" => "Quel sera votre prochaine action ?",
                    ]
        );

        foreach ($stories as $story) {
            $story->root_id = $story->id;
            Story::factory(3)->create([
                "father_id" => $story->id,
                "root_id" => $story->root_id
            ]);
            $story->save();
        };


        Story::factory(3)->create([
            "father_id" => 1,
            "root_id" => 1,
        ]);
    }
}
