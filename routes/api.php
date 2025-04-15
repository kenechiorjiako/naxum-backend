<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'storeAccount']);
Route::middleware('auth:sanctum')->group(function () {
    Route::put('/update-contact', [UserController::class, 'updateContact']);
    Route::get('/search-contacts', [UserController::class, 'searchContacts']);
    Route::get('/accounts', [UserController::class, 'listAccounts']);
});