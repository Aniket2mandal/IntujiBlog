<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    Route::group(['prefix' => '/posts'], function () {

        Route::get('/', [PostController::class, 'index']);
        Route::get('/userpost', [PostController::class, 'UserPosts']);
        Route::post('/store', [PostController::class, 'store']);
        Route::get('/{id}', [PostController::class, 'show']);
        Route::put('/{id}', [PostController::class, 'update']);
        Route::delete('/{id}', [PostController::class, 'destroy']);
    });
    
    Route::group(['prefix' => '/comments'], function () {
        Route::get('/', [CommentController::class, 'index']);
        Route::post('/store', [CommentController::class, 'store']);
        Route::get('/{id}', [CommentController::class, 'show']);
        Route::put('/{id}', [CommentController::class, 'update']);
        Route::delete('/{id}', [CommentController::class, 'destroy']);
    });


    Route::group(['prefix' => '/users'], function () {
        Route::get('/', [UserController::class, 'index']);
        Route::patch('/update', [UserController::class, 'update']);
    });

    Route::post('logout', [AuthController::class, 'logout']);
});




