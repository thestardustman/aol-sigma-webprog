<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class CampaignFactory extends Factory
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
            'title' => $this->faker->sentence(3),
            'community_name' => $this->faker->company(),
            'description' => $this->faker->paragraph(3),
            'img' => 'https://via.placeholder.com/640x480.png/007bff?text=Campaign+Image',
            'date' => $this->faker->dateTimeBetween('now', '+1 year'),
            'target' => $this->faker->numberBetween(10000000, 100000000),
        ];
    }
}
