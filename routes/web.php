<?php

use App\Http\Controllers\PaypalController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\PaypalCurlController;
use Illuminate\Support\Facades\Route;

Route::get('/transactions', [TransactionController::class, 'index']);
Route::get('/transactions/data', [TransactionController::class, 'getData'])->name('transactions.data');


//the two versions of paypal integration are working
// Paypal using curl
//Route::controller(PaypalCurlController::class)
//    ->group(function () {
//        Route::get('/', 'index')->name('welcome');
//        Route::post('/process-payment','processPayment')->name('process.payment');
//        Route::get('/payment/success', 'paymentSuccess')->name('payment.success');
//        Route::get('/payment/failed',  'paymentFailed')->name('payment.failed');
//    });

// Paypal using Package

Route::controller(PaypalController::class)
    ->group(function () {
        Route::view('/', 'payment.show')->name('create.payment');
        Route::post('handle-payment', 'handlePayment')->name('process.payment');
        Route::get('cancel-payment', 'paymentCancel')->name('cancel.payment');
        Route::get('payment-success', 'paymentSuccess')->name('success.payment');
    });
