<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreFileRequest extends FormRequest
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
            'file' => [
                'file',
                'required',
                'max:10000',
                'mimes:pdf,jpg,jpeg,png'
            ],
            'folder_id' => [
                'nullable',
                'exists:folders,id'
            ],
        ];
    }

    public function messages()
    {
        return [
            'folder_id.exists' => 'Хорошая попытка',

            'file.required' => 'Нужно указать файл',
            'file.max' => 'Файл не должен быть ьолее 10000 байт',
            'file.mimes' => 'Файл может быть только таких расширений: pdf, jpg',
        ];
    }
}
