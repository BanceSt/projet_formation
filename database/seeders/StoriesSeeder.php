<?php

namespace Database\Seeders;

use App\Models\Story;
use App\Models\User;
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
        Story::factory(300)->create([
                    "question" => "Quel sera votre prochaine action ?",
        ]);
        Story::factory(1)->create([
            "question" => "Quel sera votre prochaine action ?",
            "father_id" => 1,
            "root_id" => 1,
        ]);

        $stories = Story::all();



        foreach ($stories as $story) {
            if ($story->id != 301) $story->update(['root_id' => $story->id]);
            Story::factory(3)->create([
                "father_id" => $story->id,
                "root_id" => $story->id
            ]);

            // Engagement
            $rd_users = User::inRandomOrder()->take(fake()->numberBetween(0, 65))->pluck("id");
            $story->who_like_it()->attach($rd_users, [
                "follow" => fake()->boolean(50) ? 1 : 0,
                "favorite" => 1
            ]);
        };


    }
}
