<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Ingredient;
use App\Models\Instruction;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::whereRole('user')->get();

        $categories = Category::all();

        $count = 100;
        for ($i = 0; $i < $count; $i++) {
            $recipe = Recipe::factory([
                'user_id' => $users->random(1)->first()->id,
            ])->create();

            $recipe->categories()->attach($categories->random(rand(1, 3)));

            Ingredient::factory(rand(2, 10))->create([
                'recipe_id' => $recipe->id,
            ]);

            $instructions = rand(2, 10);

            for ($j = 0; $j < $instructions; $j++) {
                Instruction::factory()->create([
                    'recipe_id' => $recipe->id,
                    'step_number' => $j + 1,
                ]);
            }
        }
    }
}
