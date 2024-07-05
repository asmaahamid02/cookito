<?php

namespace Database\Seeders;

use App\Models\Recipe;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::whereRole('user')->get();
        $recipes = Recipe::all();


        foreach ($recipes as $recipe) {
            $users->random(rand(1, 5))->each(function ($user) use ($recipe) {
                $rating = rand(1, 5);
                $recipe->ratings()->create([
                    'user_id' => $user->id,
                    'rating' => $rating,
                ]);
            });
        }
    }
}
