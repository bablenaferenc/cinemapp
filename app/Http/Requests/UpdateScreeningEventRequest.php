<?php

namespace App\Http\Requests;

use App\Models\ScreeningEvent;
use Illuminate\Foundation\Http\FormRequest;

class UpdateScreeningEventRequest extends FormRequest
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
        $rules = ScreeningEvent::$rules;

        return $rules;
    }

    /**
     * Get the validation attributes that apply to the request.
     */
    public function attributes(): array
    {
        return ScreeningEvent::$attibuteNames;
    }
}
