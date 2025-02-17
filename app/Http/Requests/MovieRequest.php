<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovieRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'release_year' => ['required', 'integer', 'min:1900', 'max:' . ((int) date('Y') + 10)],
            'rating' => ['required', 'numeric', 'min:0', 'max:10'],
            'genre_id' => $this->routeIs('movies.update')
                ? ['nullable', 'integer', 'exists:genres,id']
                : ['required', 'integer', 'exists:genres,id'],
            'director_id' => $this->routeIs('movies.update')
                ? ['nullable', 'integer', 'exists:directors,id']
                : ['required', 'integer', 'exists:directors,id'],
        ];
    }
}
