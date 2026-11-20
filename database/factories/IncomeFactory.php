<?php

namespace Database\Factories;

use App\Enums\IncomeCategory;
use App\Models\Income;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Income>
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
            'amount' => fake()->numberBetween(3_000, 30_000),
            'note' => fake()->sentence(),
            'transaction_date' => fake()->dateTimeBetween('-2 years', 'now'),
            'category' => fake()->randomElement([...IncomeCategory::values(), null]),
            'user_id' => User::factory()
        ];
    }
}
