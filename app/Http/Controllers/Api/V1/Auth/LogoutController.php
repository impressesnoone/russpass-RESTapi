<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        try {
            if(!auth('sanctum')->user()){
                return response()->json([
                    'error' => [
                        'code' => 422,
                        'message' => 'Unauthorized',
                    ]
                ],422);
            }
            auth('sanctum')->user()->tokens()->delete();
            return response()->json([
                'code' => 200,
                'message' => 'Пользователь успешно вышел',
                'token' => 'Deleted'
            ],200);
        }catch (\Throwable $tr){
            return response()->json([
                'error' => [
                    'code' => 500,
                    'message' => 'Server Error',
                    'errors' => $tr->getMessage(),
                ]
            ],500);
        }
    }
}

