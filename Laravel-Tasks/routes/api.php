<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\GradesController;
use App\Http\Controllers\StudentController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// COURSE ROUTES
Route::get('/course', [CourseController::class, 'index']);
Route::get('/course/{id}', [CourseController::class, 'show']);
Route::post('/course', [CourseController::class, 'store']);
Route::put('/course/{id}', [CourseController::class, 'update']);
Route::delete('/course/{id}', [CourseController::class, 'destroy']);

// GRADES ROUTES
Route::get('/grades', [GradesController::class, 'index']);
Route::get('/grades/{id}', [GradesController::class, 'show']);
Route::post('/grades', [GradesController::class, 'store']);
Route::put('/grades/{id}', [GradesController::class, 'update']);
Route::delete('/grades/{id}', [GradesController::class, 'destroy']);

// STUDENTS ROUTES
Route::get('/students', [StudentController::class, 'index']);
Route::post('/students', [StudentController::class, 'store']);
Route::put('/students/{id}', [StudentController::class, 'update']);
Route::delete('/students/{id}', [StudentController::class, 'destroy']);
