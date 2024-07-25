@props(['total_rating' => 0])

<span {!! $attributes->merge(['class' => 'flex items-center space-x-1 text-gray-500 dark:text-gray-400', ]) !!}>
    @if($total_rating > 0)
    @foreach(range(1,round($total_rating)) as $rating)
    <x-heroicon-s-star class="text-amber-600 dark:text-amber-400" />
    @endforeach
    @endif
    @foreach(range(1, 5 - round($total_rating)) as $rating)
    <x-heroicon-o-star />
    @endforeach
</span>