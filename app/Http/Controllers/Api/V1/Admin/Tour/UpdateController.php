<?php

namespace App\Http\Controllers\Api\V1\Admin\Tour;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UpdateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $id)
    {
        try {
            $validateTour = Validator::make($request->all(),
                [
                    'is_public' => '',
                    'image' => 'required|file|mimes:jpg,jpeg,png',
                    'title' => 'required',
                    'description' => 'required',
                    'price' => 'required',
                    'currency' => 'required',
                    'hotel_stars' => 'required',
                    'city' => 'required',
                    'tour_composition' => 'nullable',
                    'amenities' => 'required',
                    'days' => 'required',
                    'nights' => 'required',
                    'tags' => 'required|array'
                ],
                [
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
                ]
            );
            if ($validateTour->fails()) {
                return response()->json([
                    'data' => [
                        'status' => false,
                        'code' => 422,
                        'message' => 'Ошибка в валидации',
                        'errors' => $validateTour->messages()
                    ]
                ], 422);
            }
            $tags = $request->tags;
            $image_path = Storage::putFile('/public/tours/images', $request->image);
            $tour = Tour::find($id);
            $tour->update([
                'is_public' => $request->is_public,
                'image' => $image_path,
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
                'currency' => $request->currency,
                'hotel_stars' => $request->hotel_stars,
                'city' => $request->city,
                'tour_composition' => $request->tour_composition,
                'amenities' => $request->amenities,
                'days' => $request->days,
                'nights' => $request->nights
            ]);
            $tour->tags()->sync($tags);
            return response()->json([
                'data' => [
                    'status' => true,
                    'code' => 201,
                    'message' => 'Тур успешно обновлен',
                    'tour' => $tour
                ]
            ], 201);
        } catch (\Throwable $tr) {
            return response()->json([
                'error' => [
                    'code' => 500,
                    'message' => 'Server Error',
                    'errors' => $tr->getMessage(),
                ]
            ], 500);
        }
    }
}
