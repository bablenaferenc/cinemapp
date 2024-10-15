<?php

namespace App\Http\Requests;

use App\Models\Movie;
use Illuminate\Foundation\Http\FormRequest;

class StoreMovieRequest extends FormRequest
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
        return Movie::$rules;
    }

    /**
     * Get the validation attributes that apply to the request.
     */
    public function attributes(): array
    {
        return Movie::$attibuteNames;
    }
}
