<?php

use App\Http\Controllers\ProductController;
use App\Livewire\OrderForm;

use Carbon\Carbon;

use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;



Route::middleware(['guest'])->group(function ()
{
    Route::get('/', function () {
        return view('welcome');
    })->name('welcome');
    Route::post('/', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');

    // Forgot Password
    Route::get('/forgot-password', function () {
        return view('auth.passwords.email');
    })->name('password.request');

    Route::post('/forgot-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->middleware('guest')->name('password.email');
    Route::get('/reset-password/{token}', function ($token) {
        return view('auth.passwords.reset', ['token' => $token]);
    })->name('password.reset');
});

Route::middleware(['auth'])->group(function ()
{
    Route::get('/create-order', function (){
        return view('orders.order-form');
    })->name('order.create');

    Route::get('/edit-order/{orderId}', function ($orderId){
       // return view('orders.order-form')->with('orderId', $orderId);
        return view('orders.order-form', ['orderId' => $orderId]);
    })->name('order.edit');

    Route::get('/email-pdf/{orderId}', [\App\Http\Controllers\OrderPdfController::class, 'emailOrderPdf'])
        ->name('email-pdf');

    Route::get('/view-pdf/{orderId}', [\App\Http\Controllers\OrderPdfController::class, 'viewOrderPdf'])
        ->name('view-pdf');

    Route::get('/download-pdf/{orderId}', [\App\Http\Controllers\OrderPdfController::class, 'downloadOrderPdf'])
        ->name('download-pdf');

    Route::get('/export-acumatica/{orderId}', [\App\Http\Controllers\OrderPdfController::class, 'exportAcumatica'])
        ->name('export-acumatica');

    //logout
    Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

    Route::get('/orders', function(){
        $orders = App\Models\Order::with('fromWarehouse', 'toWarehouse', 'user')->get();
       return view('orders.index', compact('orders'));
    })->name('orders');


    Route::get('/orders/completed/{orderId?}/{actioned?}', function($orderId, $actioned){
        $order = App\Models\Order::find($orderId);
        $order->actioned = $actioned;
        $order->save();
        return response()->json(['success'=>'Order marked as completed']);
    })->name('orders.completed');

    Route::get('/products',[ProductController::class, 'index'])
        ->name('products');
    Route::get('/products/create', [ProductController::class, 'create'])
        ->name('products.create');
    Route::post('/products/create', [ProductController::class, 'store'])
        ->name('products.store');


    Route::get('/products/qr-image/{productId}', [App\Http\Controllers\ProductQrController::class, 'QrCodeImage'])
        ->name('products.qr-image');
   });










