<?php

namespace App\Http\Controllers\Api\V1\Admin\Tag;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Admin\TagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(TagRequest $request)
    {
        try {
            $tag = Tag::create([
                'title' => $request->title
            ]);
            return response()->json([
                'data' => [
                    'status' => true,
                    'code' => 201,
                    'message' => 'Тег успешно добавлен',
                    'tagId' => $tag->id
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
