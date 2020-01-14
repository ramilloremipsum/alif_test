<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateFileInFolderRequest extends FormRequest
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
        ];
    }

    public function messages()
    {
        return [
            'file.required' => 'Нужно указать имя файла',
            'file.max' => 'Файл не должен быть ьолее 10000 байт',
            'file.mimes' => 'Файл может быть только таких расширений: doc, docx, txt',
        ];
    }
}
