<?php

namespace App\Http\Requests\Admin;

use App\KeyAnswer;
use Illuminate\Foundation\Http\FormRequest;

class UpdateKeyAnswersRequest extends FormRequest
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
    public function rules()
    {
        return KeyAnswer::updateValidation($this);
    }
}