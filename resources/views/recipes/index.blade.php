<x-app-layout>
    <section class="py-12 bg-gray-200 dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="mb-12 text-3xl md:text-5xl font-extrabold text-gray-900 dark:text-gray-100">{{request()->get('category') ? ucfirst(request()->get('category')) : ''}} Recipes</h2>

            @if($recipes->isEmpty())
            <div class="flex items-center justify-center h-96">
                <p class="text-2xl text-gray-600 dark:text-gray-400">{{ __('No recipes found') }}</p>
            </div>
            @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 sm:gap-6">
                @foreach($recipes as $recipe)
                <x-recipe-card :recipe="$recipe" />
                @endforeach
            </div>
            <div class="mt-8">
                {{ $recipes->links() }}
            </div>
            @endif
    </section>
</x-app-layout>