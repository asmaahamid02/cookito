<div class="group text-gray-800 dark:text-gray-200 text-lg font-semibold capitalize">
    <div class="relative overflow-hidden rounded-xl shadow-lg">
        <div class="w-full h-60 sm:h-56 md:h-48 relative overflow-hidden">
            <a href="{{ route('recipes.show', ['recipe' => $recipe->id])}}" class="block w-full h-full">
                <img src="{{ $recipe->image ? url('storage/images/recipes/' . $recipe->image) : asset('assets/images/placeholders/placeholder.png')}}" alt="{{$recipe->title}}" class="w-full h-full object-cover object-center hover:scale-125 transition-transform ease-in-out duration-300">
            </a>
        </div>
        <div class="p-4 bg-white dark:bg-gray-900 bg-opacity-90">
            <x-rating-stars :total_rating="$recipe->avgRatings[0]->total" class="space-x-0" />

            <h4 class="mt-1 text-xl truncate group-hover:text-amber-600 dark:group-hover:text-amber-400">
                <a href="{{ route('recipes.show', ['recipe' => $recipe->id])}}">{{$recipe->title}}</a>
            </h4>
            <p class="mt-1 text-xs text-gray-600 dark:text-gray-400 truncate">{{ __('By') }} <span class="text-gray-700 dark:text-gray-500">{{$recipe->user->name}}</span></p>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400 line-clamp-2">{{$recipe->description}}</p>
            @if($recipe->categories->count() > 0)
            <div class="mt-2 flex gap-1 flex-wrap">
                @foreach($recipe->categories as $category)
                <a href="{{route('recipes', ['category'=>$category->name])}}" class="text-green-800 dark:text-green-300 bg-green-100 dark:bg-green-900 text-xs font-medium px-2.5 py-0.5 rounded capitalize" data-id="{{$category->id}}">{{$category->name}}</a>
                @endforeach
            </div>
            @endif
            <div class="mt-4 flex justify-between items-center text-gray-600 dark:text-gray-400 group-hover:text-amber-600 dark:group-hover:text-amber-400">
                <p class="flex items-center gap-1">
                    <x-heroicon-o-clock />
                    <span class=" text-sm">{{$recipe->cook_time}}</span>
                </p>
                <p class="flex items-center gap-1">
                    <x-heroicon-o-users />
                    <span class="text-sm">{{$recipe->servings}}</span>
                </p>
            </div>
        </div>
    </div>
</div>