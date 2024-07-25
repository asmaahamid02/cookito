        <div class="flex flex-col sm:flex-row sm:items-center gap-4 mt-6">
            <!-- Rating -->
            <div class="flex gap-2 items-center">
                <x-rating-stars :total_rating="$recipe->avgRatings[0]->total" />
                <span class="text-sm text-gray-800 dark:text-gray-200 font-medium border-b border-amber-600 dark:border-amber-400">{{ round($recipe->avgRatings[0]->total, 1) }}</span>
            </div>

            <!-- Divider -->
            <span class="hidden sm:block text-gray-300 dark:text-gray-700">|</span>

            <!-- Ratings count -->
            <span class="text-sm text-gray-800 dark:text-gray-200 uppercase border-b border-amber-600 dark:border-amber-400 max-w-fit">{{ number_format($recipe->ratings_count) }} {{__('ratings')}}</span>
        </div>

        <!-- Description -->
        <p class="mt-6 text-lg text-gray-600 dark:text-gray-400">{{ $recipe->description }}</p>

        <!-- Author | Update Time -->
        <div class="flex flex-col sm:flex-row sm:items-center gap-4 mt-6 text-gray-500 dark:text-gray-400">
            <p class="flex items-center gap-1">
                <x-heroicon-o-user />
                <span class="text-sm">{{ __('By') }} <span class="text-gray-800 dark:text-gray-200">{{$recipe->user->name}}</span> </span>
            </p>

            <!-- Divider -->
            <span class="hidden sm:block text-gray-300 dark:text-gray-700">|</span>

            <p class="flex items-center gap-1 text-gray-500 dark:text-gray-400">
                <x-heroicon-o-clock />
                <span class="text-sm">{{ __('Published on') }}
                    <span class="text-gray-800 dark:text-gray-200">{{$recipe->created_at->format('M d, Y')}}</span>
                </span></span>
            </p>


            <!-- Divider -->
            <span class="hidden sm:block text-gray-300 dark:text-gray-700">|</span>

            <p class="flex items-center gap-1 text-gray-500 dark:text-gray-400">
                <x-heroicon-o-clock />
                <span class="text-sm">{{ __('Updated') }}
                    <span class="text-gray-800 dark:text-gray-200">{{$recipe->updated_at->diffForHumans()}}</span>
                </span></span>
            </p>
        </div>

        <!-- Save|Rate|Share -->
        <div class="flex flex-col sm:flex-row sm:items-center mt-6 bg-gray-200 dark:bg-gray-800 rounded-md max-w-fit">
            <a href="#" class="p-4 flex items-center gap-1 bg-amber-600 dark:bg-amber-400 text-white dark:text-gray-800 capitalize rounded-t-md sm:rounded-l-md font-semibold">
                <span class="text-sm">{{ __('Save') }}</span>
                <x-heroicon-o-bookmark />
            </a>
            <a href="#rating-wrapper" class="p-4 flex items-center gap-1 text-gray-800 dark:text-gray-200 capitalize font-semibold">
                <span class="text-sm">{{ __('Rate') }}</span>
                <x-heroicon-o-star class="text-amber-600 dark:text-amber-400" />
            </a>
            <a href="#" class="p-4 flex items-center gap-1 text-gray-800 dark:text-gray-200 capitalize rounded-r-md font-semibold">
                <span class="text-sm">{{ __('Share') }}</span>
                <x-heroicon-o-share class="text-amber-600 dark:text-amber-400" />
            </a>
        </div>

        <!-- Image -->
        <div class="mt-6">
            <img src="{{ $recipe->image ? url('storage/images/recipes/' . $recipe->image) : asset('assets/images/placeholders/placeholder.png')}}" alt="{{ $recipe->title }}" class="w-full h-52 sm:h-72 md:h-[31rem] object-cover rounded-md">
        </div>