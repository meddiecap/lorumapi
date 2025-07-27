<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class FakerApiRequest extends FormRequest
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
        // List valid GET parameters for the Faker API
        return [
            'locale' => 'string|nullable',
            'country' => [
                'string',
                'regex:/^[A-Z]{2}$/',  // ISO 3166-1 alpha-2 country code
                'nullable'
            ],
            'count' => 'integer|min:1|max:100|nullable',
            'quantity' => 'integer|min:1|max:100|nullable',
            'seed' => 'integer|nullable',
            'gender' => 'string|in:male,female,other|nullable',
            'width' => 'integer|min:1|max:1000|nullable',
            'height' => 'integer|min:1|max:1000|nullable',
            'price_min' => 'numeric|min:0.01|nullable',
            'price_max' => 'numeric|min:0.01|nullable',
            'taxes' => 'integer|min:0|max:100|nullable',
            'categories_type' => 'string|in:string,integer,uuid|nullable',
            'birthday_start' => 'date|nullable',
            'birthdate_end' => 'date|nullable',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));
    }
}
