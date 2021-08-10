<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductCreateRequest extends BaseRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'delivery_options' => 'required|array',
            'payment_options' => 'required|array',
            'price' => 'required|numeric|min:0.01',
            'category_id' => 'required|exists:categories,id',
            'images' => 'sometimes|array',
            'images.*' => 'sometimes|url'
        ];
    }
}
