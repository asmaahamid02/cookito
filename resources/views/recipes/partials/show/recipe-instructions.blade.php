<div class="mt-8">
    <h2 class="text-xl md:text-3xl font-semibold text-gray-800 dark:text-gray-200">{{ __('Instructions') }}</h2>
    <ul class="mt-4 list-none list-inside text-gray-700 dark:text-gray-300">
        @foreach($recipe->instructions as $instruction)
        <li class="mb-2 flex items-center">
            <span class="text-xs font-semibold p-1 bg-amber-600 dark:bg-amber-400 inline-block rounded-md text-white dark:text-gray-800 min-w-5 text-center">
                {{ $instruction->step_number }}
            </span>
            <span class="ms-2"> {{ $instruction->description }}</span>
        </li>
        @endforeach
    </ul>
</div>