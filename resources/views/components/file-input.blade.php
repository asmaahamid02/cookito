@props(['disabled' => false, 'rules' => null])
<input type="file" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
'class' => 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-amber-400 dark:focus:border-amber-600 focus:ring-amber-400 dark:focus:ring-amber-600 rounded-md shadow-sm',
]) !!} />
@if ($rules)
<p class="text-sm text-gray-500 dark:text-gray-400 mt-2">{{ $rules }}</p>
@endif