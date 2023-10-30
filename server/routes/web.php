<?php

use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Laravel\Cashier\Http\Controllers\WebhookController;

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

Route::middleware('stripe.logs')
    ->any('/webhook/stripe', [WebhookController::class, 'handleWebhook'])
    ->name('webhook');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [
        UserController::class, 'profile'
    ])->name('profile');

    Route::get('plans', [
        SubscriptionController::class, 'index'
    ]);

    Route::get('plans/{plan}', [
        SubscriptionController::class, 'show'
    ])->name("plans.show");

    Route::group(['prefix' => 'subscription'], function () {

        Route::post('/', [
            SubscriptionController::class, 'subscription'
        ])->name("subscription.create");

        Route::get('/cancel/{plan}', [
            SubscriptionController::class, 'cancel'
        ])->name("subscription.cancel");

        Route::get('/resume/{plan}', [
            SubscriptionController::class, 'resume'
        ])->name("subscription.resume");
    });
});

require __DIR__ . '/auth.php';



