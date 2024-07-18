<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 md:-my-px md:ms-10 md:flex md:items-center">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Home') }}
                    </x-nav-link>
                    <x-nav-link :href="route('recipes')" :active="request()->routeIs('recipes')">
                        {{ __('Recipes') }}
                    </x-nav-link>
                    @auth
                    <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                        <x-heroicon-o-user class="mb-1" />
                    </x-nav-link>
                    @else
                    <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
                        {{ __('Login') }}
                    </x-nav-link>
                    <x-nav-link :href="route('register')" :active="request()->routeIs('register')">
                        {{ __('Register') }}
                    </x-nav-link>
                    @endauth
                </div>
            </div>

            <!-- Submit recipe / Search recipe -->
            <div class="flex items-center ms-6">
                <!-- Search input -->
                <div class="hidden lg:block">
                    <x-search-form />
                </div>

                <!-- Search icon for small screens -->
                <x-icon-button class="inline-flex lg:hidden" id="search-toggle">
                    <x-heroicon-o-magnifying-glass class="text-gray-500 dark:text-gray-400 font-bold w-6 h-6" />
                    <span class="sr-only">Search recipes</span>
                </x-icon-button>

                <x-primary-button class="ms-3 hidden sm:inline-flex">
                    <a href="{{ route('recipes.create') }}">
                        {{ __('Submit recipe') }}
                    </a>
                </x-primary-button>

                <!-- Toggle theme -->
                <x-icon-button id="theme-toggle" type="button" class="ms-3">
                    <svg id="toggle-dark-theme-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                    </svg>
                    <svg id="toggle-light-theme-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Toggle theme</span>
                </x-icon-button>

                <!-- Hamburger -->
                <x-icon-button @click="open = ! open" class="md:hidden ms-1 -me-2 inline-flex">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>

                    <span class="sr-only">Open main menu</span>
                </x-icon-button>
            </div>

            <!-- <div class="-me-2 flex items-center md:hidden">
            </div> -->
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden md:hidden">

        <div class="pt-2 pb-3 space-y-1">
            <!-- Submit button for small screens -->
            <div class="px-2 pb-3 block sm:hidden">
                <x-primary-button class="w-full justify-center">
                    {{ __('Submit recipe') }}
                </x-primary-button>
            </div>

            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Home') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            @auth
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>
            @endauth

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('recipes')" :active="request()->routeIs('recipes')">
                    {{ __('Recipes') }}
                </x-responsive-nav-link>
            </div>
        </div>
    </div>

</nav>
<!-- Search input for small screens -->
<div class="hidden lg:hidden py-2 bg-white dark:bg-gray-800" id="small-screen-search-form">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-search-form />
    </div>
</div>

<script>
    const search_toggle = document.querySelector('#search-toggle');
    const small_screen_search_form = document.querySelector('#small-screen-search-form');

    search_toggle.addEventListener('click', () => {
        small_screen_search_form.classList.toggle('hidden');
    });
</script>