<?php

namespace App\Http\Controllers\Api\V1\Admin\Feedback;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class DestroyController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($id)
    {
        try{
            $feedback = Feedback::find($id);
            $feedback->delete();
            return response()->json([
                'data' => [
                    'status' => true,
                    'code' => 201,
                    'message' => 'Данные успешно удалены!',
                    'feedbackId' => $id
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
