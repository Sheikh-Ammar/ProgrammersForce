<?php

use App\Http\Controllers\AdminUserController;
use Illuminate\Support\Facades\Route;

Route::post('admin/login', [AdminUserController::class, 'login']);
Route::group(['prefix' => 'admin', 'middleware' => ['auth:admin-api', 'scopes:admin']], function () {

    Route::get('all', [AdminUserController::class, 'getAdmins']);
});
