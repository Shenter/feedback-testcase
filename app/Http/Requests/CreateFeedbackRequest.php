<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateFeedbackRequest extends FormRequest
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
        return [
            'title' => 'required|string|max:255',
            'text' => 'required|string|max:16000',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Необходимо ввести тему обращения',
            'text.required' => 'Необходимо ввести текст обращения',
        ];
    }
}
