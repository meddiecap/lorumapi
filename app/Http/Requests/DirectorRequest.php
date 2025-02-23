<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DirectorRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:directors,name',
            ],
            /**
             * The date_of_birth field is optional, but if it is provided, it must be a valid date.
             * @example "1970-01-01"
             */
            'date_of_birth' => [
                'nullable',
                'date',
            ],
        ];
    }
}
