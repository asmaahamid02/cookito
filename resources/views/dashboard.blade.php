<x-app-layout>
    <!-- Hero -->
    <section class="bg-cover bg-center" style="background-image: url({{asset('assets/images/hero.jpg')}})">
        <div class="hero-container bg-black bg-opacity-80 w-full h-full">
            <div class="max-w-7xl px-4 sm:px-6 lg:px-8 py-40 sm:py-60 mx-auto flex flex-col justify-center items-center">
                <h1 class="text-4xl font-extrabold text-gray-100 sm:text-5xl md:text-7xl text-center w-full sm:max-w-[60rem]">
                    Discover Simple, Delicious and <span class="text-amber-500 dark:text-amber-400">Fast Recipes</span>
                </h1>
                <p class="mt-4 text-lg sm:text-xl text-gray-400 text-center">
                    A recipe is soulless. The essence of recipe lies in the hands of the cook who prepares it.
                </p>
                <div class="flex flex-col sm:flex-row gap-2 sm:gap-4 mt-8 w-full justify-center">
                    <x-secondary-button class="w-full sm:w-auto justify-center sm:px-8">
                        <a href="{{ route('recipes.create') }}">
                            {{ __('Submit recipe') }}
                        </a>
                    </x-secondary-button>
                    <x-primary-button class="w-full sm:w-auto justify-center sm:px-8">
                        <a href="{{ route('recipes') }}">
                            {{ __('Explore Recipes') }}
                        </a>
                    </x-primary-button>
                </div>
            </div>
        </div>
    </section>

    <!-- Popular Categories -->
    <section class="py-20 bg-gray-100 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl md:text-5xl font-extrabold text-gray-900 dark:text-gray-100">Popular Categories</h2>
                <a href="{{ route('categories') }}" class="text-amber-600 dark:text-amber-400 text-xs hover:underline">View all
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4 sm:gap-6">
                @foreach($categories as $category)
                <x-category-card :category="$category" />
                @endforeach
            </div>
        </div>
    </section>

    <!-- Latest Recipes -->
    <section class="py-12 bg-gray-200 dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl md:text-5xl font-extrabold text-gray-900 dark:text-gray-100">Latest Recipes</h2>
                <a href="{{ route('recipes') }}" class="text-amber-600 dark:text-amber-400 text-xs hover:underline">View all
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 sm:gap-6">
                @foreach($recipes as $recipe)
                <x-recipe-card :recipe="$recipe" />
                @endforeach
            </div>

            <div class="flex justify-center mt-8">
                <x-primary-button class="w-full sm:w-auto justify-center sm:px-8">
                    <a href="{{ route('recipes') }}">
                        {{ __('Explore all recipes') }}
                    </a>
                </x-primary-button>
            </div>
        </div>
    </section>
</x-app-layout>