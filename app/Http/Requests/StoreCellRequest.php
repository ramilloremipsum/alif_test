<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCellRequest extends FormRequest
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
//                Rule::unique('cells', 'title')->ignore($this->id)
                //TODO add unique pair validator for "title" and "box_id"
            ],
            'description' => [
                'nullable', 'max:255'
            ],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Ячейка должна обязательно иметь название',
            'title.unique' => 'Ячейка с таким именем уже есть в этом шкафу',
        ];
    }
}
