<x-app-layout>
    <div class="py-12 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl md:text-5xl font-bold text-gray-800 dark:text-gray-200">{{ $recipe->title }}</h1>
        <!-- Rating -->
        <div class="flex flex-col sm:flex-row sm:items-center gap-4 mt-6">
            <!-- Rating -->
            <div class="flex gap-2 items-center">
                <span class="flex gap-1">
                    @if($recipe->average_rating > 0)
                    @foreach(range(1,round($recipe->average_rating)) as $rating)
                    <x-heroicon-s-star class="text-amber-600 dark:text-amber-400" />
                    @endforeach
                    @endif
                    @foreach(range(1, 5 - round($recipe->average_rating)) as $rating)
                    <x-heroicon-o-star class="text-gray-500 dark:text-gray-400" />
                    @endforeach
                </span>
                <span class="text-sm text-gray-800 dark:text-gray-200 font-medium border-b border-amber-600 dark:border-amber-400">{{ $recipe->average_rating }}</span>
            </div>

            <!-- Divider -->
            <span class="hidden sm:block text-gray-300 dark:text-gray-700">|</span>

            <!-- Ratings count -->
            <span class="text-sm text-gray-800 dark:text-gray-200 uppercase border-b border-amber-600 dark:border-amber-400 max-w-fit">{{ $recipe->ratings_count }} {{__('ratings')}}</span>
        </div>

        <!-- Description -->
        <p class="mt-6 text-lg text-gray-600 dark:text-gray-400">{{ $recipe->description }}</p>

        <!-- Author | Update Time -->
        <div class="flex flex-col sm:flex-row sm:items-center gap-4 mt-6 text-gray-500 dark:text-gray-400">
            <p class="flex items-center gap-1">
                <x-heroicon-o-user />
                <span class="text-sm">{{ __('By') }} <span class="text-gray-800 dark:text-gray-200">{{$recipe->user->name}}</span> </span>
            </p>

            <!-- Divider -->
            <span class="hidden sm:block text-gray-300 dark:text-gray-700">|</span>

            <p class="flex items-center gap-1 text-gray-500 dark:text-gray-400">
                <x-heroicon-o-clock />
                <span class="text-sm">{{ __('Published on') }}
                    <span class="text-gray-800 dark:text-gray-200">{{$recipe->created_at->format('M d, Y')}}</span>
                </span></span>
            </p>


            <!-- Divider -->
            <span class="hidden sm:block text-gray-300 dark:text-gray-700">|</span>

            <p class="flex items-center gap-1 text-gray-500 dark:text-gray-400">
                <x-heroicon-o-clock />
                <span class="text-sm">{{ __('Updated') }}
                    <span class="text-gray-800 dark:text-gray-200">{{$recipe->updated_at->diffForHumans()}}</span>
                </span></span>
            </p>
        </div>

        <!-- Save|Rate|Share -->
        <div class="flex flex-col sm:flex-row sm:items-center mt-6 bg-gray-200 dark:bg-gray-800 rounded-md max-w-fit">
            <a href="#" class="p-4 flex items-center gap-1 bg-amber-600 dark:bg-amber-400 text-white dark:text-gray-800 capitalize rounded-t-md sm:rounded-l-md font-semibold">
                <span class="text-sm">{{ __('Save') }}</span>
                <x-heroicon-o-bookmark />
            </a>
            <a href="#rating-wrapper" class="p-4 flex items-center gap-1 text-gray-800 dark:text-gray-200 capitalize font-semibold">
                <span class="text-sm">{{ __('Rate') }}</span>
                <x-heroicon-o-star class="text-amber-600 dark:text-amber-400" />
            </a>
            <a href="#" class="p-4 flex items-center gap-1 text-gray-800 dark:text-gray-200 capitalize rounded-r-md font-semibold">
                <span class="text-sm">{{ __('Share') }}</span>
                <x-heroicon-o-share class="text-amber-600 dark:text-amber-400" />
            </a>
        </div>

        <!-- Image -->
        <div class="mt-6">
            <img src="{{ $recipe->image ? url('storage/images/recipes/' . $recipe->image) : asset('assets/images/placeholders/placeholder.png')}}" alt="{{ $recipe->title }}" class="w-full h-52 sm:h-72 md:h-[31rem] object-cover rounded-md">
        </div>

        <!-- Recipe stats -->
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
                <p class="text-gray-500 dark:text-gray-400 ps-6">{{ $recipe->servings }}</p>
            </div>

        </div>

        <!-- Ingredients -->
        <div class="mt-8">
            <h2 class="text-xl md:text-3xl font-semibold text-gray-800 dark:text-gray-200">{{ __('Ingredients') }}</h2>
            <ul class="mt-4 list-none list-inside text-gray-700 dark:text-gray-300">
                @foreach($recipe->ingredients as $ingredient)
                <li class="mb-2 flex items-center">
                    <span class="w-2 h-2 bg-amber-600 dark:bg-amber-400 inline-block rounded-full"></span>
                    <span class="ms-2">
                        {{ round($ingredient->quantity, 1) }} {{ $ingredient->unit }}
                        {{ $ingredient->name }}
                    </span>
                </li>
                @endforeach
            </ul>
        </div>

        <!-- Instructions -->
        <div class="mt-8">
            <h2 class="text-xl md:text-3xl font-semibold text-gray-800 dark:text-gray-200">{{ __('Instructions') }}</h2>
            <ul class="mt-4 list-none list-inside text-gray-700 dark:text-gray-300">
                @foreach($recipe->instructions as $instruction)
                <li class="mb-2 flex items-center">
                    <span class="text-xs font-semibold p-1 bg-amber-600 dark:bg-amber-400 inline-block rounded-md text-white dark:text-gray-800 min-w-5 text-center">
                        {{ $instruction->step_number }}
                    </span>
                    <span class="ms-2"> {{ $instruction->description }}</span>
                </li>
                @endforeach
            </ul>
        </div>

        <!-- Nutrition facts -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 p-4 mt-8 rounded-md border border-b-8 border-gray-200 border-b-amber-600 dark:border-gray-600 dark:border-b-amber-400">
            <!-- Title -->
            <h3 class="sm:col-span-3 text-xl md:text-3xl font-semibold text-gray-800 dark:text-gray-200">{{ __('Nutrition Facts') }}</h3>

            <!-- Calories -->
            <div>
                <div class="flex items-center gap-1">
                    <x-heroicon-o-scale class="text-amber-600 dark:text-amber-400" />
                    <p class="text-gray-800 dark:text-gray-200 font-semibold">{{ __('Calories:') }}</p>
                </div>
                <p class="text-gray-500 dark:text-gray-400 ps-6">{{ round($recipe->calories, 1) }}</p>
            </div>

            <!-- Carbs -->
            <div>
                <div class="flex items-center gap-1">
                    <x-heroicon-o-scale class="text-amber-600 dark:text-amber-400" />
                    <p class="text-gray-800 dark:text-gray-200 font-semibold">{{ __('Carbs:') }}</p>
                </div>
                <p class="text-gray-500 dark:text-gray-400 ps-6">{{ round($recipe->carbs, 1) }} {{
                    __('g') }}</p>
            </div>

            <!-- Protein -->
            <div>
                <div class="flex items-center gap-1">
                    <x-heroicon-o-scale class="text-amber-600 dark:text-amber-400" />
                    <p class="text-gray-800 dark:text-gray-200 font-semibold">{{ __('Protein:') }}</p>
                </div>
                <p class="text-gray-500 dark:text-gray-400 ps-6">{{ round($recipe->protein, 1) }} {{
                    __('g') }}</p>
            </div>

        </div>

        <!-- Rate Wrapper -->
        <div class="mt-8 bg-amber-600 dark:bg-amber-400 rounded-md p-4" id="rating-wrapper">
            <div class="bg-gray-100 dark:bg-gray-900 py-6 px-4 rounded-md">
                <div class="flex justify-between items-center">
                    <h4 class="text-lg md:text-2xl font-semibold text-gray-800 dark:text-gray-200">
                        {{ $userRate ? 'My Review' : $recipe->title }}
                    </h4>

                    @if($userRate)
                    <button class="text-gray-800 dark:text-gray-200 font-semibold flex items-center gap-1" id="edit-rating">
                        <x-heroicon-o-pencil class="w-4 h-4 text-amber-600 dark:text-amber-400" />
                        <span class="text-sm">{{ __('Edit') }}</span>
                    </button>
                    @endif
                </div>

                @if (session('success'))
                <x-alert type="success" :message="session('success')" class="mt-4" id="success-alert" />
                @endif

                @if (session('error'))
                <x-alert type="error" :message="session('error')" class="mt-4" id="error-alert" />
                @endif

                <!-- User rate -->
                @if($userRate)
                <div class="mt-8 user-rate-wrapper">
                    <div class="flex gap-2 items-center">
                        <span class="flex gap-1">
                            @foreach(range(1,$userRate->rating) as $rating)
                            <x-heroicon-s-star class="text-amber-600 dark:text-amber-400" />
                            @endforeach
                            @foreach(range(1, 5 - $userRate->rating) as $rating)
                            <x-heroicon-o-star class="text-gray-500 dark:text-gray-400" />
                            @endforeach
                        </span>
                        <span class="text-gray-400 dark:text-gray-500 text-xs">{{ $userRate->created_at->format('M d, Y') }}</span>
                    </div>
                    <p class="mt-4 text-gray-700 dark:text-gray-300">{{ $userRate->review }}</p>
                </div>
                @endif

                <!-- Rating form -->
                @if(!$recipe->user->is(auth()->user()))
                <form action="{{ route('rates.recipe.store', ['recipe' => $recipe->id]) . '#rating-wrapper'}}" method="POST" class="mt-8" id="rating-form" data-type="{{ $userRate ? 'edit' : 'create' }}">
                    @csrf
                    <!-- Rating stars -->
                    <div>
                        <label for="rating" class="text-gray-700 dark:text-gray-300 font-semibold">{{ __('Your Rating') }}</label>
                        <div class="flex items-center gap-2 mt-2">
                            <input type="hidden" name="rating" id="rating-input" value="{{ old('rating') ?? $userRate->rating ?? '' }}">
                            @foreach(range(1,5) as $rating)
                            <label for="rating" data-value="{{$rating}}" class="rating-label flex items-center gap-1 cursor-pointer">
                                <x-heroicon-o-star class="w-8 h-8 rating-star text-gray-500 dark:text-gray-400" />
                            </label>
                            @endforeach

                            <!-- divider -->
                            <span class="text-gray-300 dark:text-gray-700">|</span>

                            <!-- Rating text -->
                            <span class="text-sm text-gray-500 dark:text-gray-400 hidden rating-text"></span>
                        </div>

                        <x-input-error :messages="$errors->get('rating')" class="mt-2" />

                    </div>

                    <!-- Review -->
                    <div class="mt-4">
                        <label for="review" class="block text-gray-700 dark:text-gray-300 font-semibold">{{ __('Your Review') }}</label>
                        <x-text-area name="review" id="review-input" class="mt-2 w-full" placeholder="What did you think of this recipe?">
                            {{ old('review') ?? $userRate->review ?? '' }}
                        </x-text-area>
                        <x-input-error :messages="$errors->get('review')" class="mt-2" />
                    </div>

                    <!-- Error message -->
                    <p id="rating-error" class="text-sm text-red-600 dark:text-red-400 hidden mt-2"></p>

                    <!-- Actions -->
                    <div class="flex items-center justify-end mt-4">
                        <x-danger-button type="reset" disabled id="reset-rating">{{ __('Cancel') }}</x-danger-button>
                        <x-primary-button type="submit" disabled class="ms-2" id="submit-rating">{{ __('Submit') }}</x-primary-button>
                    </div>
                </form>
                @endif

                <!-- Divider -->
                <hr class="my-8 border-t border-gray-200 dark:border-gray-700">

                <!-- Rating progress -->
                <div class="mt-8 flex flex-col items-center">
                    <!-- Rating -->
                    <div class="flex gap-2 items-center justify-center w-full">
                        <span class="flex gap-1">
                            @if($recipe->average_rating > 0)
                            @foreach(range(1,round($recipe->average_rating)) as $rating)
                            <x-heroicon-s-star class="text-amber-600 dark:text-amber-400" />
                            @endforeach
                            @endif
                            @foreach(range(1, 5 - round($recipe->average_rating)) as $rating)
                            <x-heroicon-o-star class="text-gray-500 dark:text-gray-400" />
                            @endforeach
                        </span>
                        <span class="text-sm text-gray-800 dark:text-gray-200">{{ $recipe->average_rating }} out of 5</span>
                    </div>

                    <p class="mt-4 text-sm text-gray-800 dark:text-gray-200 w-full text-center">{{ $recipe->average_rating }} Ratings</p>

                    <div class="mt-4 flex flex-col gap-3 items-center w-full">
                        @for($rating = 5; $rating > 0; $rating--)
                        @php
                        $ratingData = $ratings_averages[$rating] ?? [
                        'count' => 0,
                        'percentage' => 0
                        ];
                        @endphp
                        <div class="flex items-center w-full justify-center">
                            <span class="shrink-0 {{ $rating == 1 ? 'me-[0.4rem]' : 'me-1'}} text-sm text-gray-800 dark:text-gray-200 {{$ratingData['count'] > 0 ? 'border-b border-b-amber-600 dark:border-b-amber-400' : ''}}">
                                {{ $rating }} star
                            </span>
                            <x-heroicon-s-star class="w-4 h-4 shrink-0 me-2 text-amber-600 dark:text-amber-400" />
                            <div class="h-2 me-2 bg-gray-200 dark:bg-gray-700 rounded-md w-full sm:w-48">
                                <span class="h-full bg-amber-600 dark:bg-amber-400 rounded-md block" style="width: {{ $ratingData['percentage'] }}%"></span>
                            </div>
                            <span class="text-sm text-gray-500 dark:text-gray-400">{{ $ratingData['count'] }}</span>
                        </div>
                        @endfor
                    </div>
                </div>
            </div>


        </div>

    </div>

</x-app-layout>

<script>
    $(document).ready(function() {
        const ratingTexts = {
            1: 'Hated it',
            2: 'Disliked it',
            3: 'It\'s OK',
            4: 'Liked it',
            5: 'Loved it'
        }

        const form_type = $('#rating-form').data('type');

        const oldRating = $('#rating-input').val();
        const oldReview = $('#review-input').text();

        //set the color of the stars based on the old rating
        if (oldRating) {
            $('.rating-label').each(function() {
                if ($(this).data('value') <= oldRating) {
                    $(this).find('.rating-star').
                    removeClass('text-gray-500 dark:text-gray-400').
                    addClass('text-amber-600 dark:text-amber-400').
                    attr('fill', 'currentColor');
                } else {
                    $(this).find('.rating-star').
                    removeClass('text-amber-600 dark:text-amber-400').
                    addClass('text-gray-500 dark:text-gray-400').
                    attr('fill', 'none');
                }
            });
            $('.rating-text').text(ratingTexts[oldRating]).removeClass('hidden');
            $('#submit-rating').removeAttr('disabled');
        }

        if (oldReview || oldRating || form_type === 'edit') {
            $('#reset-rating').removeAttr('disabled');
        }

        //when hover over a star, change the color of the stars
        $('.rating-label').on('mouseover', function() {
            const rating = $(this).data('value');
            const selectedRating = $('#rating-input').val();
            $('.rating-label').each(function() {
                if ($(this).data('value') <= rating) {
                    $(this).find('.rating-star').
                    removeClass('text-gray-500 dark:text-gray-400').
                    addClass('text-amber-600 dark:text-amber-400').
                    attr('fill', 'currentColor');
                } else {
                    //if there is selected rating, color the stars up to the selected rating
                    if ($(this).data('value') <= selectedRating) {
                        $(this).find('.rating-star').
                        removeClass('text-gray-500 dark:text-gray-400').
                        addClass('text-amber-600 dark:text-amber-400').
                        attr('fill', 'none');
                    } else {
                        $(this).find('.rating-star').
                        removeClass('text-amber-600 dark:text-amber-400').
                        addClass('text-gray-500 dark:text-gray-400').
                        attr('fill', 'none');
                    }
                }
            });

            //show the rating text
            $('.rating-text').text(ratingTexts[rating]).removeClass('hidden');
        });

        //when mouse leaves the rating, reset the color of the stars
        $('.rating-label').on('mouseleave', function() {
            const selectedRating = $('#rating-input').val();
            $('.rating-label').each(function() {
                if ($(this).data('value') <= selectedRating) {
                    $(this).find('.rating-star').
                    removeClass('text-gray-500 dark:text-gray-400').
                    addClass('text-amber-600 dark:text-amber-400').
                    attr('fill', 'currentColor');
                } else {
                    $(this).find('.rating-star').
                    removeClass('text-amber-600 dark:text-amber-400').
                    addClass('text-gray-500 dark:text-gray-400').
                    attr('fill', 'none');
                }
            });

            //hide the rating text if no rating is selected
            if (!selectedRating) {
                $('.rating-text').addClass('hidden');
            } else {
                $('.rating-text').text(ratingTexts[selectedRating]);
            }
        });

        //when a star is clicked, set the rating value
        $('.rating-label').on('click', function() {
            let rating = $(this).data('value');
            $('#rating-input').val(rating);

            $('#reset-rating').removeAttr('disabled');
            $('#submit-rating').removeAttr('disabled');

            $('.rating-label').each(function() {
                if ($(this).data('value') <= rating) {
                    $(this).find('.rating-star').
                    removeClass('text-gray-500 dark:text-gray-400').
                    addClass('text-amber-600 dark:text-amber-400').
                    attr('fill', 'currentColor');
                } else {
                    $(this).find('.rating-star').
                    removeClass('text-amber-600 dark:text-amber-400').
                    addClass('text-gray-500 dark:text-gray-400').
                    attr('fill', 'none');
                }
            });
        });

        $('#review-input').on('input', function() {
            if ($(this).val().length > 0) {
                $('#reset-rating').removeAttr('disabled');
            } else {
                if (!$('#rating-input').val()) {
                    $('#reset-rating').attr('disabled', true);
                }
            }
        });

        //reset the rating form
        $('#reset-rating').on('click', function() {
            if (form_type === 'edit') {
                $('#rating-form').addClass('hidden');
                $('#edit-rating').removeClass('hidden');
                $('.user-rate-wrapper').removeClass('hidden');
                return
            }

            $('#rating-input').val('');
            $('#review-input').val('');
            $('.rating-label').each(function() {
                $(this).find('.rating-star').
                removeClass('text-amber-600 dark:text-amber-400').
                addClass('text-gray-500 dark:text-gray-400').
                attr('fill', 'none');
            });
            $('.rating-text').addClass('hidden');
            $(this).attr('disabled', true);
            $('#submit-rating').attr('disabled', true);
        });

        //validate the rating form before submitting
        $('#rating-form').on('submit', function(e) {
            e.preventDefault();
            const rating = $('#rating-input').val();

            if (!rating) {
                $('#rating-error').
                text('Please select a rating').
                removeClass('hidden');
                return;
            }

            //submit the form
            $(this).unbind('submit').submit();
        });

        //scroll to the form when the page is loaded
        if (window.location.hash === '#rating-wrapper') {
            scrollToRate();
        }

        //hide the rating form if it is an edit form (at start)
        if (form_type === 'edit') {
            $('#rating-form').addClass('hidden');
        }

        //show the rating form when the edit button is clicked
        $('#edit-rating').on('click', function() {
            $('#rating-form').toggleClass('hidden');
            $('.user-rate-wrapper').toggleClass('hidden');
            $(this).toggleClass('hidden');
        });

        function scrollToRate() {
            $('html, body').animate({
                scrollTop: $('#rating-wrapper').offset().top
            }, 1000);
        }
    });
</script>