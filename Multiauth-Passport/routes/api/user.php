<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NormalUserController;

Route::post('user/login', [NormalUserController::class, 'login']);
Route::group(['prefix' => 'user', 'middleware' => ['auth:user-api', 'scopes:user']], function () {

    Route::get('all', [NormalUserController::class, 'getUsers']);
});
