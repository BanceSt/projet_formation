<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        User::factory()->create([
            'name' => 'Test',
            'email' => 'test@example.com',
            'role' => "admin",
            'password' => "1234"
        ]);

        User::factory(10)->create();
    }
}
