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

        User::factory(100)->create();

        $users = User::all();

        foreach ($users as $user) {
            $qtn = fake()->numberBetween(0, 50);
            if ($qtn) {
                $new_follower = User::where("id", "!=", $user->id)->inRandomOrder()
                                        ->take($qtn)->pluck("id");
                $user->follower()->attach($new_follower);
            }

        }
    }
}
