<?php

namespace App\Http\Controllers\Api\V1\Admin\Tag;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class DestroyController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($id)
    {
        try {
            $tag = Tag::find($id);
            $tag->delete();
            return response()->json([
                'data' => [
                    'status' => true,
                    'code' => 201,
                    'tagId' => $tag->id,
                    'message' => 'Тег успешно удален',
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
