<?php

namespace Database\Seeders;

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
        Tags::factory(10)->create();

        Story_tag::factory(15)->create();
    }
}
