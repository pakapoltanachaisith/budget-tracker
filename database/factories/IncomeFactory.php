<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Income>
 */
class IncomeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'note' => fake()->sentence(),
            'amount' => fake()->numberBetween(1, 100 * 500),
            'date' => fake()->dateTimeBetween('-3 years'),
            'user_id' => 1
        ];
    }
}
