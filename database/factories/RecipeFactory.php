<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recipe>
 */
class RecipeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        if (!File::isDirectory(public_path('storage/images/recipes'))) {
            File::makeDirectory(public_path('storage/images/recipes'), 0777, true, true);
        }

        $files = File::files(public_path('storage/images/recipes'));

        return [
            'title' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'prep_time' => fake()->numberBetween(5, 120),
            'cook_time' => fake()->numberBetween(5, 120),
            'servings' => fake()->numberBetween(1, 12),
            'calories' => fake()->numberBetween(300, 1500),
            'protein' => fake()->numberBetween(5, 50),
            'carbs' => fake()->numberBetween(5, 100),
            //get random image from storage/recipes
            'image' => $files[array_rand($files)]->getFilename(),
        ];
    }
}
