<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Home;
use App\Livewire\Login;
use App\Livewire\Register;

Route::get('/', Home::class);
Route::get('/login', Login::class);
Route::get('/register', Register::class);
