<?php

namespace App\Http\Requests\Api\V1\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function messages()
    {
        return [
            'title.required' => 'Заголовок обязателен для заполнения',
            'title.string' => 'Заголовок должен быть в виде текста',
            'title.unique' => 'Такой тег уже существует',
        ];
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|unique:tags,title'
        ];
    }
}
