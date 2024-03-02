<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(LocationSeeder::class);
        $this->call(LandmarkSeeder::class);
        $this->call(WishSeeder::class);
        $this->call(OfferingSeeder::class);
        $this->call(PostSeeder::class);
        $this->call(CommentSeeder::class);

        

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
