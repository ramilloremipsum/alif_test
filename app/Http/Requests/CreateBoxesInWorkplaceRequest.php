<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBoxesInWorkplaceRequest extends FormRequest
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
            'quantity' => 'required|numeric|min:1|max:100',
        ];
    }

    public function messages()
    {
        return [
            'quantity.required' => 'Кол-во обязательно к заполнению',
            'quantity.numeric' => 'Кол-во должно быть числом',
            'quantity.min' => 'Введенное значение должно быть не меннее 1',
            'quantity.max' => 'Введенное значение должно быть не более 100',
        ];
    }
}
