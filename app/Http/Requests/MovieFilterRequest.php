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
            'min_rating' => [
                'numeric',
                'nullable',
                'min:0',
                'max:10',
                function ($attribute, $value, $fail) {
                    // Custom validation rule to ensure min_rating is less than or equal to max_rating if both are provided
                    if ($this->input('max_rating') && $value > $this->input('max_rating')) {
                        $fail('The min_rating must be less than or equal to the max_rating.');
                    }
                },
            ],
            'max_rating' => [
                'numeric',
                'nullable',
                'min:0',
                'max:10',
                function ($attribute, $value, $fail) {
                    // Custom validation rule to ensure max_rating is greater than or equal to min_rating if both are provided
                    if ($this->input('min_rating') && $value < $this->input('min_rating')) {
                        $fail('The max_rating must be greater than or equal to the min_rating.');
                    }
                },
            ],
        ];
    }
}
