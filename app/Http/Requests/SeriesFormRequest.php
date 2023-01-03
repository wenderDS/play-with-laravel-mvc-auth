<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeriesFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'min:3']
        ];
    }

    /**
     * Implemented the method messages() only to use by example
     * @return string[]
     */
    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'name.min' => 'The name must be at least 3 characters.'
        ];
    }
}
