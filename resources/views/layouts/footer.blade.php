<footer class="bg-gray-800 dark:bg-gray-900 text-gray-200 dark:text-gray-400">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6">
            <!-- About Us -->
            <div>
                <div>
                    <h3 class="text-lg font-semibold">About Us</h3>
                    <p class="mt-2 text-sm">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptates.</p>
                </div>
                <div class="mt-4">
                    <x-application-logo class="!h-20" />
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-lg font-semibold">Quick Links</h3>
                <div class="mt-2 space-y-2 flex flex-col">
                    <x-nav-link class="max-w-fit" :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Home') }}
                    </x-nav-link>
                    <x-nav-link class="max-w-fit" :href="route('recipes')" :active="request()->routeIs('recipes')">
                        {{ __('Recipes') }}
                    </x-nav-link>
                    <x-nav-link class="max-w-fit" :href="route('about')" :active="request()->routeIs('about')">
                        {{ __('About') }}
                    </x-nav-link>
                    @auth
                    <x-nav-link class="max-w-fit" :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                        <x-heroicon-o-user class="mb-1" />
                    </x-nav-link>
                    @else
                    <x-nav-link class="max-w-fit" :href="route('login')" :active="request()->routeIs('login')">
                        {{ __('Login') }}
                    </x-nav-link>
                    <x-nav-link class="max-w-fit" :href="route('register')" :active="request()->routeIs('register')">
                        {{ __('Register') }}
                    </x-nav-link>
                    @endauth
                </div>
            </div>

            <!-- Contact Us -->
            <div>
                <h3 class="text-lg font-semibold">{{__('Contact Us')}}</h3>
                <p class="mt-2 text-sm">
                    {{__('123 Main Street, New York, NY 10030')}}
                </p>
                <p class="mt-1 text-sm">
                    <x-nav-link class="max-w-fit" href="tel:+1234567890">
                        +1 (234) 567-890
                    </x-nav-link>
                </p>
                <p class="mt-1 text-sm">
                    <x-nav-link class="max-w-fit" href="mailto:asmaahamid002@gmail.com">
                        Email Us
                    </x-nav-link>
                </p>
            </div>

            <!-- Newsletter -->
            <div>
                <h3 class="text-lg font-semibold">Newsletter</h3>
                <p class="mt-2 text-sm">Subscribe to our newsletter to get the latest updates.</p>
                <form class="mt-4 flex flex-col gap-2">
                    <x-text-input type="email" name="email" id="email" class="block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md leading-5 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 placeholder-gray-500 dark:placeholder-gray-400 sm:text-sm" placeholder="Enter your email address" />
                    <x-primary-button class="justify-center">
                        {{ __('Subscribe') }}
                    </x-primary-button>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="bg-gray-900 dark:bg-gray-800 py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <p class="text-sm text-center text-gray-200 dark:text-gray-400">&copy; 2021 <a href="{{ route('dashboard') }}" class="text-amber-500 dark:text-amber-400 hover:underline">Cookito</a>. All rights reserved.
            </p>
        </div>
    </div>
</footer>