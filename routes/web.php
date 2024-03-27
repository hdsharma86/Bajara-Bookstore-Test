<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Home;
use App\Livewire\Login;
use App\Livewire\Register;
use App\Livewire\UserDashboard;
use App\Livewire\Profile;
use App\Livewire\BookDetail;

Route::get('/', Home::class);
Route::get('/login', Login::class)->name('login');
Route::get('/register', Register::class);
Route::middleware(['auth'])->group(function () {
    Route::get('/user-logout', [Login::class, 'logout']);
    Route::get('/user-profile', Profile::class);
    Route::get('/user-dashboard', UserDashboard::class);
    Route::get('/book-detail', BookDetail::class);
});