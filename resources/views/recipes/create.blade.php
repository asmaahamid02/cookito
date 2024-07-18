<x-app-layout>
    <x-form-container>
        <h2 class="mb-6 text-center text-3xl md:text-5xl font-extrabold text-gray-900 dark:text-gray-100">{{ __('New Recipe') }}</h2>
        <form action="{{ route('recipes.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            @if (session('success'))
            <x-alert type="success" :message="session('success')" />
            @endif

            @if (session('error'))
            <x-alert type="error" :message="session('error')" />
            @endif


            <div class="grid grid-cols-1 sm:grid-cols-3 gap-2">

                <!-- Title -->
                <div class="sm:col-span-3">
                    <x-input-label for="title" :value="__('Name')" />

                    <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" required autocomplete="title" value="{{ old('title') }}" />

                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>

                <!-- Description -->
                <div class="mt-4 sm:col-span-3">
                    <x-input-label for="description" :value="__('Description')" />

                    <x-text-area id="description" class="block mt-1 w-full" name="description" required autocomplete="description">
                        {{ old('description') }}
                    </x-text-area>

                    <x-input-error :messages=" $errors->get('description')" class="mt-2" />
                </div>

                <!-- Categories -->
                <div class="mt-4 sm:col-span-3">
                    <x-input-label for="categories" :value="__('Categories')" />

                    <x-select id="categories" class="block mt-1 w-full" name="categories[]" multiple required autocomplete="categories">
                        <option value="" disabled>Select categories</option>
                        @foreach($categories as $category)
                        <option value="{{$category->id}}" {{ in_array($category->id, old('categories', [])) ? 'selected' : '' }}>{{$category->name}}</option>
                        @endforeach
                    </x-select>

                    <x-input-error :messages="$errors->get('categories')" class="mt-2" />
                </div>

                <!-- Image -->
                <div class="mt-4 sm:col-span-3">
                    <x-input-label for="image" :value="__('Image')" />

                    <x-file-input id="image" class="block mt-1 w-full text-sm" type="file" name="image" autocomplete="image" rules="jpg, jpeg, png, svg (MAX. 2MB)" accept=".jpeg, .png, .jpg, .svg" />

                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                </div>

                <!-- Prep Time -->
                <div class="mt-4">
                    <x-input-label for="prep_time" :value="__('Prep Time')" />

                    <x-text-input id="prep_time" class="block mt-1 w-full" type="number" name="prep_time" required autocomplete="prep_time" min="1" value="{{ old('prep_time') }}" />

                    <x-input-error :messages="$errors->get('prep_time')" class="mt-2" />
                </div>

                <!-- Cook Time -->
                <div class="mt-4">
                    <x-input-label for="cook_time" :value="__('Cook Time')" />

                    <x-text-input id="cook_time" class="block mt-1 w-full" type="number" name="cook_time" required autocomplete="cook_time" min="1" value="{{ old('cook_time') }}" />

                    <x-input-error :messages="$errors->get('cook_time')" class="mt-2" />
                </div>

                <!-- Servings -->
                <div class="mt-4">
                    <x-input-label for="servings" :value="__('Servings')" />

                    <x-text-input id="servings" class="block mt-1 w-full" type="number" name="servings" required autocomplete="servings" min="1" value="{{ old('servings') }}" />

                    <x-input-error :messages="$errors->get('servings')" class="mt-2" />
                </div>

                <!-- Calories -->
                <div class="mt-4">
                    <x-input-label for="calories" :value="__('Calories')" />

                    <x-text-input id="calories" class="block mt-1 w-full" type="number" name="calories" autocomplete="calories" min="1" value="{{ old('calories') }}" />

                    <x-input-error :messages="$errors->get('calories')" class="mt-2" />
                </div>

                <!-- Protein -->
                <div class="mt-4">
                    <x-input-label for="protein" :value="__('Protein')" />

                    <x-text-input id="protein" class="block mt-1 w-full" type="number" name="protein" autocomplete="protein" min="1" value="{{ old('protein') }}" />

                    <x-input-error :messages="$errors->get('protein')" class="mt-2" />
                </div>

                <!-- Carbs -->
                <div class="mt-4">
                    <x-input-label for="carbs" :value="__('Carbs')" />

                    <x-text-input id="carbs" class="block mt-1 w-full" type="number" name="carbs" autocomplete="carbs" min="1" value="{{ old('carbs') }}" />

                    <x-input-error :messages="$errors->get('carbs')" class="mt-2" />
                </div>

                <!-- Ingredients -->
                <div class="mt-4 sm:col-span-3">
                    <x-input-label for="ingredients" :value="__('Ingredients')" />
                    <div class="ingredients-container">
                        @if(!is_null(old('ingredients')))
                        @foreach(old('ingredients') as $key => $ingredient)
                        <div class="grid grid-cols-1 sm:grid-cols-4 gap-2" data-index="{{$key}}">
                            <x-text-input class="block mt-1 w-full {{ $key > 0 ? '' : 'sm:col-span-2'}}" type="text" name="ingredients[{{$key}}][name]" required autocomplete="ingredient_name" placeholder="Name" value="{{ $ingredient['name'] }}" />
                            <x-text-input class="block mt-1 w-full" type="number" name="ingredients[{{$key}}][quantity]" required autocomplete="ingredients_quantity" placeholder="Quantity" value="{{$ingredient['quantity']}}" />
                            <x-select class="block mt-1 w-full" name="ingredients[{{$key}}][unit]" required autocomplete="ingredients_unit">
                                <option value="" disabled>Select a unit</option>
                                <option value="g" {{isset($ingredient['unit']) ?  $ingredient['unit']  == 'g' ? 'selected' : '' : ''}}>g</option>
                                <option value="kg" {{isset($ingredient['unit']) ?  $ingredient['unit'] == 'kg' ? 'selected' : '': ''}}>kg</option>
                                <option value="ml" {{isset($ingredient['unit']) ?  $ingredient['unit'] == 'ml' ? 'selected' : '': ''}}>ml</option>
                                <option value="l" {{isset($ingredient['unit']) ?  $ingredient['unit'] == 'l' ? 'selected' : '': ''}}>l</option>
                                <option value="tbsp" {{isset($ingredient['unit']) ?  $ingredient['unit'] == 'tbsp' ? 'selected' : '': ''}}>tbsp</option>
                                <option value="tsp" {{isset($ingredient['unit']) ?  $ingredient['unit'] == 'tsp' ? 'selected' : '': ''}}>tsp</option>
                                <option value="cup" {{isset($ingredient['unit']) ?  $ingredient['unit'] == 'cup' ? 'selected' : '': ''}}>cup</option>
                                <option value="piece" {{isset($ingredient['unit']) ?  $ingredient['unit'] == 'piece' ? 'selected' : '': ''}}>piece</option>
                            </x-select>
                            @if($key > 0)
                            <x-danger-button type="button" class="mt-2 h-fit justify-center remove-ingredient-row">
                                <x-heroicon-o-x-mark />
                            </x-danger-button>
                            @endif
                        </div>
                        @endforeach
                        @else
                        <div class="grid grid-cols-1 sm:grid-cols-4 gap-2" data-index="0">
                            <x-text-input class="block mt-1 w-full sm:col-span-2" type="text" name="ingredients[0][name]" required autocomplete="ingredient_name" placeholder="Name" />
                            <x-text-input class="block mt-1 w-full" type="number" name="ingredients[0][quantity]" required autocomplete="ingredients_quantity" placeholder="Quantity" />
                            <x-select class="block mt-1 w-full" name="ingredients[0][unit]" required autocomplete="ingredients_unit">
                                <option value="" disabled selected>Select a unit</option>
                                <option value="g">g</option>
                                <option value="kg">kg</option>
                                <option value="ml">ml</option>
                                <option value="l">l</option>
                                <option value="tbsp">tbsp</option>
                                <option value="tsp">tsp</option>
                                <option value="cup">cup</option>
                                <option value="piece">piece</option>
                            </x-select>
                        </div>
                        @endif
                    </div>
                    <x-input-error :messages="$errors->get('ingredients')" class="mt-2" />
                    @php
                    $ingredientErrors = [];
                    foreach($errors->get('ingredients.*') as $key => $error) {
                    foreach($error as $e)
                    if(!in_array($e, $ingredientErrors)) {
                    $ingredientErrors[] = $e;
                    }
                    }

                    $ingredientErrorText = '';
                    foreach($ingredientErrors as $error) {
                    $ingredientErrorText .= $error . ' | ';
                    }
                    @endphp

                    <x-input-error :messages="$ingredientErrorText" class="mt-2" />

                    <x-secondary-button class="mt-2 w-full justify-center" id="add-ingredient">
                        <x-heroicon-o-plus-circle />
                        <span class="ml-2">
                            {{__('Add Ingredient')}}
                        </span>

                    </x-secondary-button>
                </div>

                <!-- Instructions -->
                <div class="mt-4 sm:col-span-3">
                    <x-input-label for="instructions" :value="__('Instructions')" />
                    <div class="instructions-container">
                        @if(!is_null(old('instructions')))
                        @foreach(old('instructions') as $key => $instruction)
                        <div class="mt-2 grid grid-cols-1 sm:grid-cols-4 gap-2 single-instruction" data-index="{{$key}}">
                            <div>
                                <x-input-label for="instruction_step_{{$key}}" :value="__('Step')" />
                                <x-text-input id="instruction_step_{{$key}}" class="block mt-1 w-full h-fit" type="number" name="instructions[{{$key}}][step_number]" required autocomplete="instruction_step" placeholder="Step" value="{{$instruction['step_number']}}" />

                                @if($key > 0)
                                <x-danger-button type="button" class="mt-2 h-fit justify-center remove-instruction-row">
                                    <x-heroicon-o-x-mark />
                                </x-danger-button>
                                @endif
                            </div>
                            <div class="sm:col-span-3">
                                <x-input-label for="instruction_description_{{$key}}" :value="__('Description')" />
                                <x-text-area id="instruction_description_{{$key}}" class="block mt-1 w-full" name="instructions[{{$key}}][description]" required autocomplete="instruction_description" placeholder="Instruction">{{$instruction['description']}}</x-text-area>
                            </div>

                        </div>
                        @endforeach
                        @else
                        <div class="mt-2 grid grid-cols-1 sm:grid-cols-4 gap-2 single-instruction" data-index="0">
                            <div>
                                <x-input-label for="instruction_step_0" :value="__('Step')" />
                                <x-text-input id="instruction_step_0" class="block mt-1 w-full h-fit" type="number" name="instructions[0][step_number]" required autocomplete="instruction_step" placeholder="Step" value="1" />
                            </div>
                            <div class="sm:col-span-3">
                                <x-input-label for="instruction_description_0" :value="__('Description')" />
                                <x-text-area id="instruction_description_0" class="block mt-1 w-full" name="instructions[0][description]" required autocomplete="instruction_description" placeholder="Instruction" />
                            </div>

                        </div>
                        @endif
                    </div>
                    <x-input-error :messages="$errors->get('instructions')" class="mt-2" />

                    @php
                    $instructionErrors = [];
                    foreach($errors->get('instructions.*') as $key => $error) {
                    foreach($error as $e)
                    if(!in_array($e, $instructionErrors)) {
                    $instructionErrors[] = $e;
                    }
                    }

                    $instructionErrorText = '';
                    foreach($instructionErrors as $error) {
                    $instructionErrorText .= $error . ' | ';
                    }
                    @endphp

                    <x-input-error :messages="$instructionErrorText" class="mt-2" />

                    <x-secondary-button class="mt-2 w-full justify-center" id="add-instruction">
                        <x-heroicon-o-plus-circle />
                        <span class="ml-2">
                            {{__('Add Instruction')}}
                        </span>
                    </x-secondary-button>
                </div>

                <!-- Reset Button -->
                <div class="mt-8 sm:col-span-1">
                    <x-danger-button type="reset" class="w-full justify-center">
                        {{ __('Reset') }}
                    </x-danger-button>
                </div>

                <!-- Submit Button -->
                <div class="mt-8 sm:col-span-2">
                    <x-primary-button class="w-full justify-center">
                        {{ __('Add Recipe') }}
                    </x-primary-button>
                </div>

            </div>
        </form>
    </x-form-container>
</x-app-layout>

<script src="
https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js
"></script>

<script>
    $(document).ready(function() {
        let ingredientCount = getIndex('.ingredients-container')
        let instructionCount = getIndex('.instructions-container')

        function getIndex(container) {
            return $(container).children().last().data('index')
        }

        function addIngredient() {
            ingredientCount++
            const ingredient = `
                <div class="grid grid-cols-1 sm:grid-cols-4 gap-2" data-index="${ingredientCount}">
                    <x-text-input class="block mt-1 w-full" type="text" name="ingredients[${ingredientCount}][name]"  required autocomplete="ingredient_name" placeholder="Name" />
                    <x-text-input class="block mt-1 w-full" type="number" name="ingredients[${ingredientCount}][quantity]"  required autocomplete="ingredients_quantity" placeholder="Quantity" />
                    <x-select class="block mt-1 w-full" name="ingredients[${ingredientCount}][unit]"  required autocomplete="ingredients_unit">
                        <option value="" disabled selected>Select a unit</option>
                        <option value="g">g</option>
                        <option value="kg">kg</option>
                        <option value="ml">ml</option>
                        <option value="l">l</option>
                        <option value="tbsp">tbsp</option>
                        <option value="tsp">tsp</option>
                        <option value="cup">cup</option>
                        <option value="piece">piece</option>
                    </x-select>
                    <x-danger-button type="button" class="mt-2 h-fit justify-center remove-ingredient-row">
                        <x-heroicon-o-x-mark />
                    </x-danger-button>
                </div>
            `
            $('.ingredients-container').append(ingredient)
        }

        function addInstruction() {
            instructionCount++
            const instruction = `
                <div class="mt-2 grid grid-cols-1 sm:grid-cols-4 gap-2 single-instruction" data-index="${instructionCount}">
                    <div>
                        <x-input-label for="instruction_step_${instructionCount}" :value="__('Step')" />
                        <x-text-input id="instruction_step_${instructionCount}" class="block mt-1 w-full h-fit" type="number" name="instructions[${instructionCount}][step_number]" required autocomplete="instruction_step" placeholder="Step" value="${instructionCount + 1}" />
                        <x-danger-button type="button" class="mt-2 h-fit justify-center remove-instruction-row">
                            <x-heroicon-o-x-mark />
                        </x-danger-button>
                    </div>
                    <div class="sm:col-span-3">
                        <x-input-label for="instruction_description_${instructionCount}" :value="__('Description')" />
                        <x-text-area id="instruction_description_${instructionCount}" class="block mt-1 w-full" name="instructions[${instructionCount}][description]" required autocomplete="instruction_description" placeholder="Instruction" />
                    </div>
                </div>
            `
            $('.instructions-container').append(instruction)
        }

        $(document).on('click', '#add-ingredient', addIngredient)
        $(document).on('click', '.remove-ingredient-row', function() {
            $(this).parent().remove()
        })

        $(document).on('click', '#add-instruction', addInstruction)
        $(document).on('click', '.remove-instruction-row', function() {
            $(this).parents('.single-instruction').remove()
        })

    });
</script>