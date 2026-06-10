<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\TicketCategoryController;
use App\Http\Controllers\API\QueueController;
use App\Http\Controllers\API\BookingController;
use App\Http\Controllers\API\PaymentCallbackController;
use App\Http\Controllers\API\TicketScannerController;
use App\Http\Middleware\QueueTrafficMiddleware;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/ticket-categories', [TicketCategoryController::class, 'index']);

Route::post('/payment/callback', [PaymentCallbackController::class, 'handleCallback']);

Route::middleware('auth:sanctum')->group(function () {
    
    Route::post('/queue/join', [QueueController::class, 'joinQueue']);
    Route::get('/queue/status', [QueueController::class, 'checkStatus']);
    
    Route::middleware(QueueTrafficMiddleware::class)->group(function () {
        Route::post('/tickets/book', [BookingController::class, 'store']); 
    });

    Route::get('/user/dashboard', [AuthController::class, 'dashboard']);
    Route::get('/user/my-tickets', [BookingController::class, 'myTickets']);
    
    Route::post('/tickets/refund/{bookingId}', [BookingController::class, 'requestRefund']);
});

Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::post('/tickets/scan', [TicketScannerController::class, 'scan']);
});