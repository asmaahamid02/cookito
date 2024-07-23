<form class="m-0 relative flex items-center overflow-hidden rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900" method="GET" action="{{ route('recipes.search') }}">
    @csrf
    <button type="reset" class="p-2 rounded-r-md font-semibold text-xs bg-transparent text-gray-500 dark:text-gray-400 focus:outline-none transition ease-in-out duration-150" aria-label="Close search form">
        <x-heroicon-o-x-mark class="h-4 w-4" />

        <span class="sr-only">Close search form</span>
    </button>
    <x-text-input type="text" name="search_term" id="search_term" class="rounded-none block w-full px-2 py-2 border-0 outline-0 leading-5 bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-200 placeholder-gray-500 dark:placeholder-gray-400 sm:text-sm focus:border-none focus:ring-0" placeholder="Search recipes..." value="{{old('search_term', request()->input('search_term'))}}" />
    <button type="submit" class="p-2 bg-amber-600 dark:bg-amber-400 border border-transparent rounded-e-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-amber-400 dark:hover:bg-white focus:bg-amber-400 dark:focus:bg-white active:bg-amber-600 dark:active:bg-amber-600 focus:outline-none transition ease-in-out duration-150">
        <x-heroicon-o-magnifying-glass />

        <span class="sr-only">Search recipes</span>
    </button>
</form>