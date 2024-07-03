<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Logout') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('You are currently logged in. If you wish to log out, you can do so using the button below.') }}
        </p>
    </header>

    <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-logout')">{{ __('Logout') }}</x-danger-button>

    <x-modal name="confirm-logout" focusable>
        <form method="post" action="{{ route('logout') }}" class="p-6">
            @csrf

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Are you sure you want to log out?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('If you log out, you will have to re-enter your credentials to access your account.') }}
            </p>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('Logout') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>