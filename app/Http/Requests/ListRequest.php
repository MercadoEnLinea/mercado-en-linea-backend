<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ListRequest extends BaseRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'order_field' => 'sometimes|string|max:255',
            'order_direction' => ['sometimes',  Rule::in(['ASC', 'DESC'])],
            'limit' => 'sometimes|integer|min:1'
        ];
    }
}
