<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class commentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Comment::factory()->create([
            'user_id' => 1,
            'story_id' => 1,
            'reply_to' => null,
        ]);

        Comment::factory()->create([
            'user_id' => 1,
            'story_id' => 1,
            'reply_to' => 1,
            'content' => 'test test dsg gds sg dsg sdg dsg sd'
        ]);

        $rootComments = Comment::factory(50)->create();
        Comment::factory(50)->make()->each( function ($comment) use ($rootComments) {
            $story_id = $rootComments->random()->story_id;
            $comment->story_id = $story_id;
            $comment->reply_to = fake()->boolean(75) ? $rootComments->where("story_id", $story_id)->random()->id : null;
            $comment->save();
        });

    }
}
