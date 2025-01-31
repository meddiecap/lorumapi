<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovieFilterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'release_year' => 'integer',
            'genre' => 'string',
            'min_rating' => 'numeric|lt:max_rating|nullable|min:0',
            'max_rating' => 'numeric|gt:min_rating|nullable|max:10',
        ];
    }
}
