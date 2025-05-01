<?php

use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

Route::get('/', function (): View {
    return view('pages.auth.auth-login'); // ganti sesuai view kamu
});

Route::middleware(['auth'])->group(function () {
    Route::get('/home', function () {
        return view('pages.dashboard', ['type_menu' => 'dashboard']);
    })->name('home');

// Route::resource('users',UsersController::class);

});
