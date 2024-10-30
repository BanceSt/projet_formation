<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Branch;
use App\Models\Comment;
use App\Models\Engagemt;
use App\Models\Folder;
use App\Models\Follow;
use App\Models\In_folder;
use App\Models\Story;
use App\Models\StoryTags;
use App\Models\StoryVariable;
use App\Models\Tags;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Variable;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // Author::factory(10)->create();
        // Story::factory(20)->create();
        // Comment::factory(25)->create();
        // Follow::factory(15)->create();
        // Folder::factory(20)->create();
        // Engagemt::factory(10)->create();
        // In_folder::factory(20)->create();
        // Branch::factory(5)->create();
        // Variable::factory(10)->create();
        // StoryVariable::factory(10)->create();
        // Tags::factory(5)->create();
        // StoryTags::factory(20)->create();

        $this->call([
            UserSeeder::class,
            StoriesSeeder::class,
            TagSeeder::class,
            commentSeeder::class,
            FolderSeeder::class
        ]);
    }
}
