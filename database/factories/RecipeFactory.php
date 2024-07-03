<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;

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
        $targetDir = 'recipes';
        $publicPath = public_path('storage/' . $targetDir);

        if (!File::isDirectory($publicPath)) {
            File::makeDirectory($publicPath, 0777, true, true);
        }

        $files = File::allFiles($publicPath);

        return [
            'title' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'prep_time' => fake()->numberBetween(5, 120),
            'cook_time' => fake()->numberBetween(5, 120),
            'servings' => fake()->numberBetween(1, 12),
            'calories' => fake()->numberBetween(300, 1500),
            'protein' => fake()->numberBetween(5, 50),
            //get random image from storage/recipes
            'image' => $files[fake()->numberBetween(0, count($files) - 1)]->getFilename(),
        ];
    }
}
