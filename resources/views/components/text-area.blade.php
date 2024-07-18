@props(['disabled' => false])

<textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-amber-400 dark:focus:border-amber-500 focus:ring-amber-400 dark:focus:ring-amber-500 rounded-md shadow-sm', 
    'rows' => 4    
    ]) !!}>{{ $slot }}</textarea>