<?php

namespace App\Http\Controllers\Api\V1\Client\Favorite;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        try {
            $toursFavoriteUser = Favorite::where('user_id', auth()->user()->id)->paginate(10);
            return response()->json([
                'data' => [
                    'status' => true,
                    'code' => 200,
                    'tours' => $toursFavoriteUser
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
