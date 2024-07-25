<div class="mt-8">
    <h2 class="text-2xl md:text-4xl font-semibold text-gray-800 dark:text-gray-200">{{ __('Reviews') }}</h2>
    <div class="mt-2 border-y border-gray-200 dark:border-gray-700 py-3 px-2 flex justify-end items-center gap-4">
        <button class="flex items-center gap-1 text-gray-800 dark:text-gray-200 font-semibold">
            <x-heroicon-o-bars-3 class="w-4 h-4 text-amber-600 dark:text-amber-400" />
            <span class="text-sm">{{ __('Sort by') }}</span>
        </button>
        <button class="flex items-center gap-1 text-gray-800 dark:text-gray-200 font-semibold">
            <x-heroicon-o-funnel class="w-4 h-4 text-amber-600 dark:text-amber-400" />
            <span class="text-sm">{{ __('Filter') }}</span>
        </button>
    </div>
    <div class="mt-2 space-y-4 divide-y divide-gray-100 dark:divide-gray-800">
        @foreach($recipe->ratings as $rating)
        <div class="pt-4 pb-2">
            <p class="text-gray-800 dark:text-gray-200 font-semibold">{{ $rating->user->name }}</p>
            <div class="flex gap-4 items-center">
                <x-rating-stars :total_rating="$rating->rating" />
                <span class="text-sm text-gray-500 dark:text-gray-400">{{ $rating->created_at->format('M d, Y') }}</span>
            </div>
            <p class="mt-4 text-gray-700 dark:text-gray-300">{{ $rating->review }}</p>
        </div>
        @endforeach
    </div>
</div>