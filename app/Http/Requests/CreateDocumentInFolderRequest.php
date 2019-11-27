<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateDocumentInFolderRequest extends FormRequest
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
                'required',
                'max:255',
                Rule::unique('documents', 'title')->ignore($this->id)
            ],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Нужно указать имя документа',
            'title.unique' => 'Документ с таким именем существует',
        ];
    }
}
