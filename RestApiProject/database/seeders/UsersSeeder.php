<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password')
        ]);

        $user->createToken('AdminUser')->plainTextToken;

        User::factory(5)->create()->each(function ($user) {
            Post::factory(5)->create(['user_id' => $user->id]); // Create 5 posts per user
        });
    }
}
