<?php

namespace App\Http\Controllers\Api\V1\Tour;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($id)
    {
        try {
            $tour = Tour::find($id);
            return response()->json([
                'data' => [
                    'status' => true,
                    'code' => 200,
                    'tour' => $tour
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
