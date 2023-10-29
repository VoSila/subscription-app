<?php

use App\Http\Controllers\PlanController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\WebhookLogController;
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

Route::get('/', [
    UserController::class, 'index'
])->name('index');

Route::any('/webhook/stripe', [
    WebhookLogController::class, 'handleLogWebhook'
])->name('webhook');


Route::middleware('auth')->group(function () {

    Route::get('plans', [
        PlanController::class, 'index'
    ]);

    Route::get('plans/{plan}', [
        PlanController::class, 'show'
    ])->name("plans.show");

    Route::post('subscription', [
        PlanController::class, 'subscription'
    ])->name("subscription.create");

    Route::get('cancel_subscription/{plan}', [
        PlanController::class, 'cancelSubscription'
    ])->name("subscription.cancel");

    Route::get('resume_subscription/{plan}', [
        PlanController::class, 'resumeSubscription'
    ])->name("subscription.resume");

    Route::get('/profile', [
        UserController::class, 'profile'
    ])->name('profile');

});

require __DIR__ . '/auth.php';



