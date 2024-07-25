<x-app-layout>
    <div class="py-12 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl md:text-5xl font-bold text-gray-800 dark:text-gray-200">{{ $recipe->title }}</h1>
        <!-- Header -->
        @include('recipes.partials.show.recipe-header')

        <!-- Recipe stats -->
        @include('recipes.partials.show.recipe-stats')

        <!-- Ingredients -->
        @include('recipes.partials.show.recipe-ingredients')

        <!-- Instructions -->
        @include('recipes.partials.show.recipe-instructions')

        <!-- Nutrition facts -->
        @include('recipes.partials.show.recipe-nutrition-facts')

        <!-- Rate Wrapper -->
        @include('recipes.partials.show.recipe-rate')

        <!-- Reviews -->
        @include('recipes.partials.show.recipe-reviews')

    </div>

</x-app-layout>