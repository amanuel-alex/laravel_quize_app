<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create 10 users and 15 posts
        User::factory(10)->create();
        Post::factory(15)->create();

        $this->call([
            RolesAndPermissionsSeeder::class,
            // other seeders...
        ]);
    }
}
