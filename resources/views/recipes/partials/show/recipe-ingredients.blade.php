<div class="mt-8">
    <h2 class="text-xl md:text-3xl font-semibold text-gray-800 dark:text-gray-200">{{ __('Ingredients') }}</h2>
    <ul class="mt-4 list-none list-inside text-gray-700 dark:text-gray-300">
        @foreach($recipe->ingredients as $ingredient)
        <li class="mb-2 flex items-center">
            <span class="w-2 h-2 bg-amber-600 dark:bg-amber-400 inline-block rounded-full"></span>
            <span class="ms-2">
                {{ number_format(round($ingredient->quantity, 1)) }} {{ $ingredient->unit }}
                {{ $ingredient->name }}
            </span>
        </li>
        @endforeach
    </ul>
</div>