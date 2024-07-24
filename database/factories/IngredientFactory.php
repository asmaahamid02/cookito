<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ingredient>
 */
class IngredientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(rand(1, 3)),
            'unit' => $this->faker->randomElement(config('constants.MEASUREMENT_UNITS')),
            'quantity' => $this->faker->randomFloat(2, 0, 100),
        ];
    }
}
