<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreRecipeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'description' => 'required|string|min:100',
            'prep_time' => 'required|min:1',
            'cook_time' => 'required|min:1',
            'servings' => 'required|min:1',
            'calories' => 'nullable|min:1',
            'protein' => 'nullable|min:1',
            'carbs' => 'nullable|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'ingredients' => 'required|array|min:1',
            'ingredients.*.name' => 'required|string',
            'ingredients.*.quantity' => 'required|min:1',
            'ingredients.*.unit' => 'required|string',
            'instructions' => 'required|array|min:1',
            'instructions.*.step_number' => 'required|min:1',
            'instructions.*.description' => 'required',
            'categories' => 'required|array|min:1',
            'categories.*' => 'required|exists:categories,id',
        ];
    }

    public function messages()
    {
        return [
            'ingredients.required' => 'Ingredients are required',
            'ingredients.*.name.required' => 'Ingredient name is required',
            'ingredients.*.quantity.required' => 'Ingredient quantity is required',
            'ingredients.*.unit.required' => 'Ingredient unit is required',
            'instructions.required' => 'Instructions are required',
            'instructions.*.step_number.required' => 'Instruction step number is required',
            'instructions.*.description.required' => 'Instruction description is required',
            'categories.required' => 'Categories are required',
            'categories.*.required' => 'Category is required',
            'categories.*.exists' => 'Category does not exist',
        ];
    }

    /**
     * If validator fails return the exception in json form
     */
    protected function failedValidation(Validator $validator)
    {
        if ($this->is('api/*')) {
            throw new HttpResponseException(response()->json(['errors' => $validator->errors()], 422));
        }

        parent::failedValidation($validator);
    }
}
