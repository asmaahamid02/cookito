<?php

namespace Database\Seeders;

use App\Models\Category;
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
        $users = User::byRole('author')->get();

        $categories = Category::all();

        $count = 100;
        for ($i = 0; $i < $count; $i++) {
            $recipe = Recipe::factory([
                'user_id' => $users->random(1)->first()->id,
            ])->create();

            $recipe->categories()->attach($categories->random(rand(1, 3)));
        }
    }
}
