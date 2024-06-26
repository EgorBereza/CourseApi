<?php

use App\Http\Controllers\CourseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::get('/courses', [CourseController::class, 'index']);

Route::get('/courses/{id}', [CourseController::class, 'show']);

Route::post('/courses', [CourseController::class, 'store']);

Route::put('/courses/{id}', [CourseController::class, 'update']);

Route::delete('/courses/{id}', [CourseController::class, 'delete']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
