<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/home', function () {
    return response()->json([
        'Message' => 'Thanks To Verify Your Mail',
        'Web Page' => 'Home Page',
    ]);
})->name('welcome')->middleware('auth:sanctum', 'register_verify');

Route::get('/non-verify/user', function () {
    return response()->json([
        'Message' => 'Need To Verify Email Check Email',
        'Web Page' => 'Non Verify Email Page',
    ]);
})->name('non-verify');
