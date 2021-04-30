<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NotificationController;


Route::apiResources([
    'question' => QuestionController::class,
    'category' => CategoryController::class,
    'question/{question}/reply' => ReplyController::class
]);

Route::post('like/{reply}', [LikeController::class, 'like']);
Route::delete('like/{reply}', [LikeController::class, 'unlike']);

Route::post('notifications', [NotificationController::class, 'index']);
Route::post('markAsRead', [NotificationController::class, 'markAsRead']);

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});
