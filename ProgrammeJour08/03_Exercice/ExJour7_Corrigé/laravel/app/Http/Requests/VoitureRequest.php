<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VoitureRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'marque'=>'required|min:2|max:30|alpha',
            'type'=>'required|min:2|max:30',
            'couleur'=>'required|min:2|max:30|alpha',
            'cylindree'=>'required|regex:/^[0-9]+(\.[0-9]?)?$/',
        ];
    }
}
