<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|max:100',
            'description' => 'required',
            'image' => 'required|image|max:2048|mimes:jpeg,png,jpg',
            'price' => 'required|numeric|min:0|digits_between:1,12',
            'discountPercentage' => 'required|numeric|between:0,99.99',
            'rating' => 'required|numeric|between:0,99.99',
            'stock' => 'required|numeric|min:0|digits_between:1,12',
            'brand' => 'required|max:100',
            'category_id' => 'required|integer|exists:categories,id',
        ];
    }
}
