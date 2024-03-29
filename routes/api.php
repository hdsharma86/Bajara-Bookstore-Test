<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware(['auth:sanctum'])->group(function () {
    //Route::get('/user', [AuthController::class, 'getUser']);
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/user', [UserController::class, 'fetchUserDetail']);
    Route::post('/users', [UserController::class, 'create']);
    Route::put('/users/{user}', [UserController::class, 'update']);
    Route::delete('/users/{user}', [UserController::class, 'delete']);

    Route::get('/books', [BookController::class, 'index']);
    Route::post('/book', [BookController::class, 'fetchBookDetail']);
    Route::post('/books', [BookController::class, 'create']);
    Route::put('/books/{book}', [BookController::class, 'update']);
    Route::delete('/books/{book}', [BookController::class, 'delete']);

    Route::put('/profile/{user}', [UserController::class, 'profile']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::post('/login', [AuthController::class, 'login']);
