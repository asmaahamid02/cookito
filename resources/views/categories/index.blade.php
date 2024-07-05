<x-app-layout>
    <section class="py-20 bg-gray-100 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="mb-12 text-3xl md:text-5xl font-extrabold text-gray-900 dark:text-gray-100">Categories</h1>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4 sm:gap-6">
                @foreach($categories as $category)
                <x-category-card :category="$category" />
                @endforeach
            </div>
        </div>
    </section>
</x-app-layout>