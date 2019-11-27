<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreWorkplace extends FormRequest
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
            'title' => [
                'required', 'max:255',
                Rule::unique('workplaces', 'title')->ignore($this->id)
            ],
            'description' => [
                'nullable', 'max:255'
            ]
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Рабочее место должно обязательно иметь название',
            'title.unique' => 'Рабочее место с таким именем уже есть в базе',
        ];
    }
}
