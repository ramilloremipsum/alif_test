<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateFileRequest extends FormRequest
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
        ];
    }
}
