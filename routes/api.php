<?php

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

Route::post('register', [\App\Http\Controllers\Api\AuthController::class, 'register']);
Route::post('login', [\App\Http\Controllers\Api\AuthController::class, 'login']);
Route::post('students', [\App\Http\Controllers\Api\StudentController::class, 'store']);
Route::post('teachers', [\App\Http\Controllers\Api\TeacherController::class, 'store']);

Route::middleware('auth:api')->group(function () {
    Route::get('students', [\App\Http\Controllers\Api\StudentController::class, 'index']);
    Route::get('students/{id}', [\App\Http\Controllers\Api\StudentController::class, 'show']);
    Route::put('students/{id}', [\App\Http\Controllers\Api\StudentController::class, 'update']);
    Route::delete('students/{id}', [\App\Http\Controllers\Api\StudentController::class, 'delete']);

    Route::get('teachers', [\App\Http\Controllers\Api\TeacherController::class, 'index']);
    Route::get('teachers/{id}', [\App\Http\Controllers\Api\TeacherController::class, 'show']);
    Route::put('teachers/{id}', [\App\Http\Controllers\Api\TeacherController::class, 'update']);
    Route::delete('teachers/{id}', [\App\Http\Controllers\Api\TeacherController::class, 'delete']);
    Route::get('teachers/{id}/students', [\App\Http\Controllers\Api\TeacherController::class, 'getStudents']);

    Route::get('periods', [\App\Http\Controllers\Api\PeriodController::class, 'index']);
    Route::get('periods/{id}', [\App\Http\Controllers\Api\PeriodController::class, 'show']);
    Route::post('periods', [\App\Http\Controllers\Api\PeriodController::class, 'store']);
    Route::put('periods/{id}', [\App\Http\Controllers\Api\PeriodController::class, 'update']);
    Route::delete('periods/{id}', [\App\Http\Controllers\Api\PeriodController::class, 'delete']);
});



