 <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 p-4 mt-6 rounded-md border border-t-8 border-gray-200 border-t-amber-600 dark:border-gray-600 dark:border-t-amber-400">
     <!-- Prep Time -->
     <div>
         <div class="flex items-center gap-1">
             <x-heroicon-o-clock class="text-amber-600 dark:text-amber-400" />
             <p class="text-gray-800 dark:text-gray-200 font-semibold">{{ __('Prep Time:') }}</p>
         </div>
         <p class="text-gray-500 dark:text-gray-400 ps-6">{{ $recipe->prep_time }}</p>
     </div>

     <!-- Cook Time -->
     <div>
         <div class="flex items-center gap-1">
             <x-heroicon-o-clock class="text-amber-600 dark:text-amber-400" />
             <p class="text-gray-800 dark:text-gray-200 font-semibold">{{ __('Cook Time:') }}</p>
         </div>
         <p class="text-gray-500 dark:text-gray-400 ps-6">{{ $recipe->cook_time }}</p>
     </div>

     <!-- Servings -->
     <div>
         <div class="flex items-center gap-1">
             <x-heroicon-o-user-group class="text-amber-600 dark:text-amber-400" />
             <p class="text-gray-800 dark:text-gray-200 font-semibold">{{ __('Servings:') }}</p>
         </div>
         <p class="text-gray-500 dark:text-gray-400 ps-6">{{ number_format($recipe->servings) }}</p>
     </div>

 </div>