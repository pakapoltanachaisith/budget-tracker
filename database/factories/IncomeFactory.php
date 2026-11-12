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
            'user_id' => User::factory(),
            'amount' => fake()->numberBetween(5_000 * 100, 50_000 * 100),
            'note' => fake()->sentence(),
            'transaction_date' => fake()->dateTimeBetween('-2 years', 'now'),
            'category' => fake()->randomElement(IncomeCategory::cases()),
        ];
    }
}
