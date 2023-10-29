<?php

namespace App\Http\Controllers\Api\V1\Feedback;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\FeedbackRequest;
use App\Models\Feedback;
use function response;

class FeedbackController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(FeedbackRequest $request)
    {
        try{
            $feedback = Feedback::create([
               'info' => $request->info
            ]);
            return response()->json([
                'data' => [
                    'status' => true,
                    'code' => 201,
                    'message' => 'Успешно отправлено',
                    'tagId' => $feedback->id
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
