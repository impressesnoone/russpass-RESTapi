<?php

namespace App\Http\Controllers\Api\V1\Client\Favorite;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
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
            $tourFavoriteUser = Favorite::find($id);
            $tourFavoriteUser->delete();
            return response()->json([
                'data' => [
                    'status' => true,
                    'code' => 201,
                    'message' => 'Тур успешно удален из избранного',
                    'tourFavoriteUser' => $id,
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
