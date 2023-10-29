<?php

namespace App\Http\Controllers\Api\V1\Client\Like;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\Tour;
use Illuminate\Http\Request;

class LikeTourController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($tourId)
    {

        try {
            $tour = Tour::find($tourId);

            $findLike = Like::where('tour_id', $tourId)->where('user_id', auth()->user()->id)->first();
            if(!$findLike){
                $tour->likes = $tour->likes + 1;
                $tour->save();
                Like::create([
                    'tour_id' => $tourId,
                    'user_id' => auth()->user()->id
                ]);
                return response()->json([
                    'error' => [
                        'code' => 201,
                        'message' => 'Лайк успешно поставлен',
                        'tour_likes' => $tour->likes,
                        'tour_id' => $tourId
                    ]
                ], 201);
            }else{
                $tour->likes = $tour->likes - 1;
                $tour->save();
                $findLike->delete();
                return response()->json([
                    'error' => [
                        'code' => 201,
                        'message' => 'Лайк успешно убран',
                        'tour_likes' => $tour->likes,
                        'tour_id' => $tourId
                    ]
                ], 201);
            }
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
