<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Home;
use App\Livewire\Login;
use App\Livewire\Register;
use App\Livewire\UserDashboard;
use App\Livewire\Profile;
use App\Livewire\BookDetail;
use App\Livewire\Favourite;
use App\Http\Controllers\AdminController;

use App\Livewire\Admin\Login as LivewireAdminLogin;
use App\Livewire\Admin\Dashboard as LivewireAdminDashboard;

/**
 * Livewire Admin Panel Routes Here...
 */
Route::prefix('livewire-admin')->group(function () {
    Route::get('/', LivewireAdminLogin::class)->name('livewire-admin.login');
    Route::get('/login', LivewireAdminLogin::class)->name('livewire-admin.login');
    Route::middleware(['auth'])->group(function () {
        Route::get('/logout', LivewireAdminLogin::class)->name('livewire-admin.logout');
        Route::get('/dashboard', LivewireAdminDashboard::class)->name('livewire-admin.dashboard');
    });
});

Route::get('/', Home::class);
Route::get('/login', Login::class)->name('login');
Route::get('/register', Register::class);
Route::middleware(['auth'])->group(function () {
    Route::get('/user-logout', [Login::class, 'logout']);
    Route::get('/user-profile', Profile::class);
    Route::get('/user-dashboard', UserDashboard::class);
    Route::get('/my-favourites', Favourite::class);
    Route::get('/book-detail/{id}', BookDetail::class)->name('book-detail');
});

Route::get('{view}', [AdminController::class, 'index'])->where('view', '(.*)');