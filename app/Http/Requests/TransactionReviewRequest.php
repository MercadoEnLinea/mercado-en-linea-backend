<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class TransactionReviewRequest extends BaseRequest



    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'score' => 'required|integer|min:1|max:5',
            'body' => 'required|string',

        ];
    }
}
