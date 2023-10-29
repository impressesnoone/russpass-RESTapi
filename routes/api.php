<?php

use App\Http\Controllers\Api\V1\Client\Like\LikeTourController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::group(['namespace' => 'App\Http\Controllers\Api\V1'], function () {
    //Роуты на регистрацию, авторизацию и выход
    Route::group(['namespace' => 'Auth', 'prefix' => 'auth'], function () {
        Route::post('register', 'RegisterController');
        Route::post('login', 'LoginController');
        Route::get('logout', 'LogoutController');
    });
    //Роуты для администратора
    Route::group(['namespace' => 'Admin', 'middleware' => 'admin', 'prefix' => 'admin'], function () {
        //Роуты для CRUD туров
        Route::group(['namespace' => 'Tour', 'prefix' => 'tours'], function () {
            Route::get('/', 'IndexController');
            Route::get('/{id}', 'ShowController');
            Route::post('/', 'StoreController');
            Route::post('/edit/{id}', 'UpdateController');
            Route::delete('/destroy/{id}', 'DestroyController');
        });
        //Роуты для CRUD тегов
        Route::group(['namespace' => 'Tag', 'prefix' => 'tags'], function () {
            Route::get('/', 'IndexController');
            Route::post('/', 'StoreController');
            Route::patch('/edit/{id}', 'UpdateController');
            Route::delete('/destroy/{id}', 'DestroyController');
        });
        //Роуты для CD просмотра обратной связи
        Route::group(['namespace' => 'Feedback', 'prefix' => 'feedback'], function () {
            Route::get('/', 'IndexController');
            Route::delete('/destroy/{id}', 'DestroyController');
        });
    });
    //Роуты для клиентов
    Route::group(['namespace' => 'Client', 'middleware' => 'auth:sanctum'], function () {
        //Роуты для CRD избранного
        Route::group(['namespace' => 'Favorite', 'prefix' => 'favorites'], function () {
            Route::get('/', 'IndexController');
            Route::post('/{tourId}', 'StoreController');
            Route::delete('/destroy/{id}', 'DestroyController');
        });
        //Роут для лайка
        Route::post('/like/{tourId}', LikeTourController::class);
    });
    //Роуты для получения туров не ограничиваются ролью или авторизацией
    Route::group(['namespace' => 'Tour', 'prefix' => 'tours'], function () {
        Route::get('/', 'IndexController');
        Route::get('/{id}', 'ShowController');
    });
    //Роут для обратной связи не ограничиваются ролью или авторизацией
    Route::group(['namespace' => 'Feedback', 'prefix' => 'feedback'], function () {
        Route::post('/', 'FeedbackController');
    });
});

