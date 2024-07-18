@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-amber-400 dark:focus:border-amber-500 focus:ring-amber-400 dark:focus:ring-amber-500 rounded-md shadow-sm placeholder:text-xs']) !!}>