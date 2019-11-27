<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBoxRequest extends FormRequest
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
                //TODO add unique pair validator for "title" and "workplace_id"
            ],
            'description' => [
                'nullable', 'max:255'
            ],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Шкаф должнен обязательно иметь название',
            'title.unique' => 'Шкаф с таким именем уже есть на этом рабочем месте',
        ];
    }
}
