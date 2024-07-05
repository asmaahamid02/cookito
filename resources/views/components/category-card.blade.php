<a href="{{ route('recipes', array('category' => $category->name))}}" data-id="{{$category->id}}" class="group relative w-full text-gray-800 dark:text-gray-200 hover:text-amber-600 hover:dark:text-amber-400 text-lg font-semibold uppercase text-center bg-gray-200/60 dark:bg-gray-800/60 rounded-xl shadow-lg overflow-hidden">
    <div class="w-full h-60 sm:h-56 md:h-48 relative overflow-hidden">
        <img src="{{ url('storage/categories/'.$category['image'])}}" alt="{{$category['name']}}" class="object-cover group-hover:scale-125 transition-transform ease-in-out duration-300">
    </div>
    <p class="text-center py-4">{{$category->name}}</p>
</a>