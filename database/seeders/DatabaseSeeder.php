<?php

namespace Database\Seeders;

use App\Models\Income;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()
            ->has(Income::factory()->count(30))
            ->create([
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => Hash::make('johnpassword'),
            ]);
    }
}
