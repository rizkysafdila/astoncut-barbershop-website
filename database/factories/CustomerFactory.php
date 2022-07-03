<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'service_id' => rand(1, 7),
            'time' => fake()->dateTimeThisMonth('+5 Days'),
            'status' => rand(1,3),
            'stylist_id' => rand(1,5)
        ];
    }
}
