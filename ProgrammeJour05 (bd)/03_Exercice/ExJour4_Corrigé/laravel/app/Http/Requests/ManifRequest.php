<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ManifRequest extends FormRequest
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
     * @return array
     */
    public function rules() {
        return [
            'debut' => 'required|after_or_equal:tomorrow',
            'fin' => 'required|after:debut',
            'lieu' => 'required|min:3|regex:[^[A-Z].*]'
        ];
    }
}
