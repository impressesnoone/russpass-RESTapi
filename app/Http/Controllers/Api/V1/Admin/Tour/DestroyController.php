<?php

namespace App\Http\Controllers\Api\V1\Admin\Tour;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use Illuminate\Http\Request;

class DestroyController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($id)
    {
        try {
            $tour = Tour::find($id);
            $tags = $tour->tags;
            $tour->tags()->detach($tags);
            $tour->delete();
            return response()->json([
                'data' => [
                    'status' => true,
                    'code' => 200,
                    'message' => 'Тур успешно удален',
                    'tourId' => $id,
                ]
            ], 200);
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
