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
                    <x-nav-link :href="route('about')" :active="request()->routeIs('about')">
                        {{ __('About') }}
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
                <div class="relative hidden lg:block">
                    <x-text-input type="text" name="search" id="search" class="block w-full pl-10 pr-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md leading-5 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 placeholder-gray-500 dark:placeholder-gray-400 sm:text-sm" placeholder="Search recipes..." />
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <x-heroicon-o-magnifying-glass class="text-gray-400 dark:text-gray-500" />
                    </div>
                </div>

                <!-- Search icon for small screens -->
                <x-icon-button class="inline-flex lg:hidden">
                    <x-heroicon-o-magnifying-glass class="text-gray-500 dark:text-gray-400 font-bold w-6 h-6" />
                </x-icon-button>

                <x-primary-button class="ms-3 hidden sm:inline-flex">
                    {{ __('Submit recipe') }}
                </x-primary-button>

                <!-- Hamburger -->
                <x-icon-button @click="open = ! open" class="md:hidden ms-1 -me-2 inline-flex">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
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

                <x-responsive-nav-link :href="route('about')" :active="request()->routeIs('about')">
                    {{ __('About') }}
                </x-responsive-nav-link>
            </div>
        </div>
    </div>
</nav>