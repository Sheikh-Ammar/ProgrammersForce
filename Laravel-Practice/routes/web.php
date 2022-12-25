<?php

use App\Http\Controllers\MailController;
use App\PaymentService\PaypalAPI;
use Illuminate\Http\Client\Request;
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

Route::get('/', function () {
    return view('welcome');
});

// SERVICE CONTAINER
Route::get('/service-container/request', function (Request $request) {
    dd($request);
    dd(app());
});
Route::get('/service-container/paypal', function (PaypalAPI $pay) {
    dump($pay->getPayment());
});

// SERVICE PROVIDER
Route::get('/service-provider/paypal', function (PaypalAPI $pay) {
    dump($pay->paymentDetails());
});

// FACADES
// Route::get('/facades/paypal', function () {
//     return Facade\App\PaymentService\PaypalAPI::getPayment();
// });

// MAIL
Route::get('/mail/test', [MailController::class, 'testMail']);

// JOBS AND QUEUE
Route::get('/jobs-queue/test', [MailController::class, 'testJobsQueue']);

// EVENTS AND LISTENERS
Route::get('/event-listners/test', [MailController::class, 'testEventListners']);

// NOTIFICATIONS
Route::get('/notification-mail/test', [MailController::class, 'testNotificationMail']);
