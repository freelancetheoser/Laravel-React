<?php

namespace Database\Factories;

use App\Models\Landmark;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Wish>
 */
class WishFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'landmark_id' => Landmark::inRandomOrder()->first()->id,
            'content' => fake()->realText(),
            'status' => "Waiting",
            'offering_quantity' => 0
        ];
    }
}