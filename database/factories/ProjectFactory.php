<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'contact' => fake()->name(),
            'address' => fake()->address(),
            'phone' => fake()->numberBetween(1111111111,9999999999),
            'email' => fake()->unique()->safeEmail(),
            'created_at' => fake()->iso8601(),
        ];
    }

}
