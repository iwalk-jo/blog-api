<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create a static admin user
        $user = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        $user->createToken('AdminUser')->plainTextToken;

        // Check if factories and Faker are available
        if (class_exists(\Faker\Factory::class)) {
            // Use factories to generate users
            User::factory()->count(5)->create();
        } else {
            // Fallback static users if Faker is unavailable
            for ($i = 1; $i <= 5; $i++) {
                User::create([
                    'name' => "User {$i}",
                    'email' => "user{$i}@example.com",
                    'password' => bcrypt('password'),
                ]);
            }
        }

        // Optional: If you want to create posts for each user
        // Uncomment and update as needed
        /*
        User::all()->each(function ($user) {
            for ($i = 0; $i < 5; $i++) {
                Post::create([
                    'user_id' => $user->id,
                    'title' => "Post Title {$i}",
                    'body' => "This is post {$i} by user {$user->name}.",
                ]);
            }
        });
        */
    }
}