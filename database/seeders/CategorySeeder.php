<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //categories
        $categories = [
            [
                'name' => 'Main Dishes',
                'description' => 'Main dishes are the primary dish in a meal. It is usually the heaviest, heartiest, and most complex or substantial dish in a meal.',
                'image' => 'main_dishes.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Soups',
                'description' => 'Soup is a primarily liquid food, generally served warm or hot, that is made by combining ingredients of meat or vegetables with stock, or water.',
                'image' => 'soups.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Pasta',
                'description' => 'Pasta is a type of food typically made from an unleavened dough of wheat flour mixed with water or eggs, and formed into sheets or other shapes, then cooked by boiling or baking.',
                'image' => 'pasta.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Pizza',
                'description' => 'Pizza is a savory dish of Italian origin consisting of a usually round, flattened base of leavened wheat-based dough topped with tomatoes, cheese, and often various other ingredients.',
                'image' => 'pizza.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Bread',
                'description' => 'Bread is a staple food prepared from a dough of flour and water, usually by baking.',
                'image' => 'bread.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Cakes',
                'description' => 'Cake is a form of sweet food made from flour, sugar, and other ingredients, that is usually baked.',
                'image' => 'cakes.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Salads',
                'description' => 'Salad is a dish consisting of a mixture of small pieces of food, usually vegetables or fruit.',
                'image' => 'salads.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Drinks',
                'description' => 'A drink is a liquid intended for human consumption that is prepared through the process of distillation, boiling, or infusion.',
                'image' => 'drinks.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Beef',
                'description' => 'Beef is the culinary name for meat from cattle, particularly skeletal muscle.',
                'image' => 'beef.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Chicken',
                'description' => 'Chicken is the most common type of poultry in the world. Owing to the relative ease and low cost of raising them in comparison to animals such as cattle or hogs, chickens have become prevalent throughout the cuisine of cultures around the world.',
                'image' => 'chicken.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Breakfast',
                'description' => 'Breakfast is the first meal of the day eaten after waking from a night of sleep, most often eaten in the early morning before undertaking the day\'s work.',
                'image' => 'breakfast.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Desserts',
                'description' => 'Dessert is a course that concludes a meal. The course usually consists of sweet foods, such as confections, and possibly a beverage such as dessert wine and liqueur.',
                'image' => 'desserts.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Appetizer',
                'description' => 'An appetizer is a small dish of food or a drink taken before a meal or the main course of a meal to stimulate one\'s appetite.',
                'image' => 'appetizer.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Seafood',
                'description' => 'Seafood is any form of sea life regarded as food by humans, prominently including fish and shellfish.',
                'image' => 'seafood.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Vegetarian',
                'description' => 'Vegetarianism is the practice of abstaining from the consumption of meat, and may also include abstention from by-products of animal slaughter.',
                'image' => 'vegetarian.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Vegan',
                'description' => 'Veganism is the practice of abstaining from the use of animal products, particularly in diet, and an associated philosophy that rejects the commodity status of animals.',
                'image' => 'vegan.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Smoothies',
                'description' => 'A smoothie is a drink made by blending raw fruit or vegetables with other ingredients such as water, ice, dairy products or sweeteners.',
                'image' => 'smoothies.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];
        DB::table('categories')->insert($categories);
    }
}
