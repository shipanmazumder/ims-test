<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductRequest extends FormRequest
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
            'product_name' => ['required','string'],
            'category_id' => 'required|exists:categories,id',
            'selling_price' => 'required|numeric|between:0,9999999999.99',
        ];
    }
    public function messages()
    {
        return [
            'category_id.required' => 'Please select a category.',
            'category_id.exists' => 'The selected category does not exist.',
            'product_name.required' => 'Product name is required.',
            'product_name.string' => 'Product name must be a string.',
            'product_name.max' => 'Product name cannot exceed 255 characters.',
            'selling_price.required' => 'Selling price is required.',
            'selling_price.numeric' => 'Selling price must be a numeric value.',
            'selling_price.between' => 'Selling price must be between 0 and 9999999999.99.'
        ];
    }

}
