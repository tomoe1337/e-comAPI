<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Cart\AddItemController;
use App\Http\Controllers\Api\Cart\CheckoutController;
use App\Http\Controllers\Api\Cart\RemoveItemController;
use App\Http\Controllers\Api\Order\OrderPaymentController;
use App\Http\Controllers\api\Product\ShowProductController;
use App\Http\Controllers\Api\Product\ShowProductsListController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//auth
Route::post('/login', LoginController::class);
Route::post('/register', RegisterController::class);

Route::group(['middleware' => 'auth:sanctum'], function () {
    //cart
    Route::post('/cart/add', AddItemController::class);
    Route::delete('/cart/remove/{itemId}', RemoveItemController::class);
    Route::post('/cart/checkout', CheckoutController::class);

    //product
    Route::get('/products', ShowProductsListController::class);
    Route::get('/products/{product}', ShowProductController::class);

    //payment
    Route::get('/process-payment/{method_slug}/{token}', OrderPaymentController::class)->name('payment.process');
});
