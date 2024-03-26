<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Organization>
 */
class OrganizationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::factory();
        return [
            'name' => fake()->company,
            'start_date' => now()->format('Y-m-d H:i:s'),
            'leader_id' => $user,
            'created_by' => $user,
        ];
    }
}
