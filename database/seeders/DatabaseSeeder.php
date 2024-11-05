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
        $this->call([
            UserSeeder::class,
            StoriesSeeder::class,
            TagSeeder::class,
            commentSeeder::class,
            FolderSeeder::class
        ]);
    }
}
