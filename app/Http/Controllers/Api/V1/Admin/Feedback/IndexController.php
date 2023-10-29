<?php

namespace App\Http\Controllers\Api\V1\Admin\Feedback;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        try {
            $feedbacks = Feedback::paginate(10);
            return response()->json([
                'data' => [
                    'status' => true,
                    'code' => 200,
                    'feedbacks' => $feedbacks
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
