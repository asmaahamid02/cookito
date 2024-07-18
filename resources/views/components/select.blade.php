@props(['disabled' => false])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'block w-full px-3 py-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-amber-400 dark:focus:border-amber-500 focus:ring-amber-400 dark:focus:ring-amber-500 rounded-md shadow-sm',
    ]) !!}>
    {{ $slot }}
</select>