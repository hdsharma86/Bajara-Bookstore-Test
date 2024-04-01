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
use App\Http\Middleware\CustomerAuth;

use App\Livewire\Admin\Login as LivewireAdminLogin;
use App\Livewire\Admin\Logout as LivewireAdminLogout;
use App\Livewire\Admin\Dashboard as LivewireAdminDashboard;
use App\Livewire\Admin\Users as LivewireAdminUser;
use App\Livewire\Admin\Books as LivewireAdminBook;
use App\Livewire\Admin\Toast as LivewireAdminToast;
use App\Livewire\Admin\UpdateUser as LivewireAdminUpdateUser;
use App\Livewire\Admin\AddUser as LivewireAdminAddUser;
use App\Livewire\Admin\AddBook as LivewireAdminAddBook;
use App\Livewire\Admin\UpdateBook as LivewireAdminUpdateBook;
use App\Livewire\Admin\Profile as LivewireAdminProfile;
/**
 * Livewire Admin Panel Routes Here...
 */
Route::prefix('livewire-admin')->group(function () {
    Route::get('/', LivewireAdminLogin::class)->name('livewire-admin.login');
    Route::get('/login', [LivewireAdminLogin::class, 'login'])->name('livewire-admin.login');
    Route::middleware(['admin_auth'])->group(function () {
        Route::get('/admin-logout', [LivewireAdminLogin::class, 'adminLogout'])->name('livewire-admin.logout');
        Route::get('/users', LivewireAdminUser::class)->name('livewire-admin.users');
        Route::get('/update-user/{id}', LivewireAdminUpdateUser::class)->name('livewire-admin.update-user');
        Route::get('/add-user', LivewireAdminAddUser::class)->name('livewire-admin.add-user');
        Route::get('/books', LivewireAdminBook::class)->name('livewire-admin.books');
        Route::get('/update-book/{id}', LivewireAdminUpdateBook::class)->name('livewire-admin.update-book');
        Route::get('/add-book', LivewireAdminAddBook::class)->name('livewire-admin.add-book');
        Route::get('/dashboard', LivewireAdminDashboard::class)->name('livewire-admin.dashboard');
        Route::get('/profile', LivewireAdminProfile::class)->name('livewire-admin.profile');
    });
});

/**
 * Customer Portal routes here...
 */
Route::get('/', Home::class);
Route::get('/login', Login::class)->name('login');
Route::get('/register', Register::class)->name('register');
Route::middleware(['customer_auth'])->group(function () {
    Route::get('/user-logout', [Login::class, 'logout']);
    Route::get('/user-profile', Profile::class);
    Route::get('/user-dashboard', UserDashboard::class)->name('user-dashboard');
    Route::get('/my-favourites', Favourite::class);
    Route::get('/book-detail/{id}', BookDetail::class)->name('book-detail');
});

/**
 * VueJs Admin Panel routes here...
 */
Route::get('{view}', [AdminController::class, 'index'])->where('view', '(.*)');