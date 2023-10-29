<?php

namespace App\Http\Controllers\Api\V1\Client\Favorite;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($tourId)
    {
        try {
            $tourFavoriteUser = Favorite::create([
               'tour_id' => $tourId,
               'user_id' => Auth::user()->id,
            ]);
            return response()->json([
                'data' => [
                    'status' => true,
                    'code' => 201,
                    'message' => 'Тур успешно добавлен в избранное',
                    'tourFavoriteUser' => $tourFavoriteUser->id,
                    'user_id' => Auth::user()->id
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
