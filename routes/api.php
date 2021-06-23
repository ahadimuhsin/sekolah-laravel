<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\TagController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\EventController;
use App\Http\Controllers\API\PhotoController;
use App\Http\Controllers\API\VideoController;
use App\Http\Controllers\API\SliderController;
use App\Http\Controllers\API\CategoryController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('post', [PostController::class, 'index']);
Route::get('post/{slug?}', [PostController::class, 'show']);
Route::get('homepage/post', [PostController::class, 'PostHomePage']);

Route::get('event', [EventController::class, 'index']);
Route::get('event/{slug?}', [EventController::class, 'show']);
Route::get('homepage/event', [EventController::class, 'EventHomePage']);

Route::get('slider', [SliderController::class, 'index']);

Route::get('tag', [TagController::class, 'index']);
Route::get('tag/{slug?}', [TagController::class, 'show']);

Route::get('category', [CategoryController::class, 'index']);
Route::get('category/{slug?}', [CategoryController::class, 'show']);

Route::get('photo', [PhotoController::class, 'index']);
Route::get('homepage/photo', [PhotoController::class, 'PhotoHomePage']);

Route::get('video', [VideoController::class, 'index']);
Route::get('homepage/video', [VideoController::class, 'VideoHomePage']);
