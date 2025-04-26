<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilmRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:50',
            'year' => 'required|numeric|digits:4',
            'director_id' => 'required|exists:artists,id',
            'country_id' => 'required|exists:countries,id',
            'actors' => 'sometimes|array',
            'actors.*' => 'exists:artists,id'
        ];
    }
}
