@props(['type' => 'success', 'message'])

@php
$classes = [
'success' => 'text-green-800 border-green-300 bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800',
'error' => 'text-red-800 border-red-300 bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800',
'warning' => 'text-yellow-800 border-yellow-300 bg-yellow-50 dark:bg-gray-800 dark:text-yellow-400 dark:border-yellow-800',
'info' => 'text-blue-800 border-blue-300 bg-blue-50 dark:bg-gray-800 dark:text-blue-400 dark:border-blue-800',
][$type];
@endphp

<div {{ $attributes->merge(['class' => "flex items-center p-4 mb-4 text-sm rounded-lg border-l-4 {$classes}"]) }}>
    @if ($type === 'success')
    <x-heroicon-o-check-circle class="w-4 h-4 me-3" />
    @elseif ($type === 'error')
    <x-heroicon-o-x-circle class="w-4 h-4 me-3" />
    @elseif ($type === 'warning')
    <x-heroicon-o-exclamation-circle class="w-4 h-4 me-3" />
    @elseif ($type === 'info')
    <x-heroicon-o-information-circle class="w-4 h-4 me-3" />
    @endif
    <div>
        {{ $message }}
    </div>
</div>