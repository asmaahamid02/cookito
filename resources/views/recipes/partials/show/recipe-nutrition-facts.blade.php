<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 p-4 mt-8 rounded-md border border-b-8 border-gray-200 border-b-amber-600 dark:border-gray-600 dark:border-b-amber-400">
    <!-- Title -->
    <h3 class="sm:col-span-3 text-xl md:text-3xl font-semibold text-gray-800 dark:text-gray-200">{{ __('Nutrition Facts') }}</h3>

    <!-- Calories -->
    <div>
        <div class="flex items-center gap-1">
            <x-heroicon-o-scale class="text-amber-600 dark:text-amber-400" />
            <p class="text-gray-800 dark:text-gray-200 font-semibold">{{ __('Calories:') }}</p>
        </div>
        <p class="text-gray-500 dark:text-gray-400 ps-6">{{ number_format(round($recipe->calories, 1)) }}</p>
    </div>

    <!-- Carbs -->
    <div>
        <div class="flex items-center gap-1">
            <x-heroicon-o-scale class="text-amber-600 dark:text-amber-400" />
            <p class="text-gray-800 dark:text-gray-200 font-semibold">{{ __('Carbs:') }}</p>
        </div>
        <p class="text-gray-500 dark:text-gray-400 ps-6">{{ number_format(round($recipe->carbs, 1)) }} {{
                    __('g') }}</p>
    </div>

    <!-- Protein -->
    <div>
        <div class="flex items-center gap-1">
            <x-heroicon-o-scale class="text-amber-600 dark:text-amber-400" />
            <p class="text-gray-800 dark:text-gray-200 font-semibold">{{ __('Protein:') }}</p>
        </div>
        <p class="text-gray-500 dark:text-gray-400 ps-6">{{ number_format(round($recipe->protein, 1)) }} {{
                    __('g') }}</p>
    </div>

</div>