<?php

namespace App\Http\Requests\Api\V1\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TourRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function messages()
    {
        return [
            'image.required' => 'Фото тура обязательно',
            'image.file' => 'Поле должно содержать файл',
            'image.mimes' => 'Разрешены следующие расширения: jpg,jpeg,png',
            'title.required' => 'Заголовок тура обязателен',
            'description.required' => 'Описание тура обязателено',
            'price.required' => 'Цена тура обязателена',
            'currency.required' => 'Валюта цены тура обязателена',
            'hotel_stars.required' => 'Колличество звезд отеля обязателено, если их нет 0',
            'city.required' => 'Город тура обязателен',
            'tour_composition.required' => 'Состав тура обязателен',
            'amenities.required' => 'Особенности отеля обязателены',
            'days.required' => 'Колличество дней обязателены',
            'nights.required' => 'Колличество ночей обязателены',
            'tags.required' => 'Теги тура обязателены',
            'tags.array' => 'Теги должны быть в виде массива'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'is_public' => 'nullable',
            'image' => 'required|file|mimes:jpg,jpeg,png',
            'title' => 'required',
            'description' => 'required',
            'price'  => 'required',
            'currency' => 'required',
            'hotel_stars' => 'required',
            'city' => 'required',
            'tour_composition' => 'nullable',
            'amenities' => 'required',
            'days' => 'required',
            'nights' => 'required',
            'tags' => 'required'
        ];
    }
}
