<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(),
                [
                    'email' => 'required|email',
                    'password' => 'required|min:8',
                ],
                [
                    'email.required' => 'Email обязателен для заполнения',
                    'email.email' => 'Введите корректный email',
                    'password.required' => 'Пароль обязателен для заполнения',
                    'password.min' => 'Пароль должен состоять минимум из 8 символов',
                ]
            );
            if ($validateUser->fails()) {
                return response()->json([
                    'error' => [
                        'code' => 422,
                        'message' => 'Validation Error',
                        'errors' => $validateUser->messages(),
                    ]
                ], 422);
            }
            if (!Auth::attempt($request->only('email', 'password'))) {
                return response()->json([
                    'error' => [
                        'code' => 422,
                        'message' => 'Неверный email или пароль',
                    ]
                ], 422);
            }
            $user = User::where('email', $request->email)->first();
            return response()->json([
                'code' => 200,
                'message' => 'Пользователь успешно авторизирован',
                'token' => $user->createToken('Auth_TOKEN_impresses')->plainTextToken,
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
