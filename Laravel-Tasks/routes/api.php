<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\GradesController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
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


// ================================================ //
//               PROTECTED ROUTES                   //
// ================================================ //
Route::middleware('auth:sanctum')->group(function () {
    // COURSE
    Route::post('/course', [CourseController::class, 'store']);
    Route::put('/course/{id}', [CourseController::class, 'update']);
    Route::delete('/course/{id}', [CourseController::class, 'destroy']);

    // GRADES
    Route::post('/grades', [GradesController::class, 'store']);
    Route::put('/grades/{id}', [GradesController::class, 'update']);
    Route::delete('/grades/{id}', [GradesController::class, 'destroy']);

    // STUDENTS
    Route::post('/students', [StudentController::class, 'store']);
    Route::put('/students/{id}', [StudentController::class, 'update']);
    Route::delete('/students/{id}', [StudentController::class, 'destroy']);

    // AUTH
    Route::post('/logout', [UserController::class, 'logout']);
});


// ================================================ //
//                   PUBLIC ROUTES                  //
// ================================================ //
// AUTH
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
// COURSE ROUTES
Route::get('/course', [CourseController::class, 'index']);
Route::get('/course/{id}', [CourseController::class, 'show']);
// GRADES ROUTES
Route::get('/grades', [GradesController::class, 'index']);
Route::get('/grades/{id}', [GradesController::class, 'show']);
// STUDENTS ROUTES
Route::get('/students', [StudentController::class, 'index']);
