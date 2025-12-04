<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class DonationFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            // User ID akan di-assign di Seeder nanti
            'amount' => $this->faker->numberBetween(10000, 1000000), // Random 10rb - 1jt
            'status' => $this->faker->randomElement(['successful', 'denied']),
        ];
    }
}
