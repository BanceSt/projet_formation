<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Story;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //$to_generate = $this->helper_generate_comment(0);
        return [
            "user_id" => User::inRandomOrder()->first(), //$to_generate[0],
            "story_id" => Story::inRandomOrder()->first(), //$to_generate[1],
            "content" => $this->faker->sentence(fake()->numberBetween(5, 20)),
            "reply_to" => null,
            //
        ];
    }

    private function helper_generate_comment($chance_to_be_null_reply_to = 50) {
        $helper = array();

        //Sélection du user
        $helper[] = User::inRandomOrder()->first();

        //Sélection de l'article
        $helper[] = 1; //Story::inRandomOrder()->first();

        //Sélection du commentaire réponse
        if (fake()->boolean($chance_to_be_null_reply_to))
            $helper[] = null;
        else {
            $commentIds = Comment::where('story_id', $helper[1])->pluck('id')->toArray();
            $helper[] = !empty($commentIds) ? $this->faker->randomElement($commentIds) : 1;
        }

        return $helper;
    }
}
