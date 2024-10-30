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
        Story::factory(100)->create([
            "question" => "Quel sera votre prochaine action ?",
            ]
        );

        $stories = Story::all();

        foreach ($stories as $story) {
            $story->update(['root_id' => $story->id]);
        };

        Story::factory(3)->create([
            "father_id" => 1,
            "root_id" => 1,

        ]);
    }
}
