<?php


use Illuminate\Support\Facades\Route;
use Illuminate\View\View;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\AttendanceControlller;
use App\Http\Controllers\PermissionController;


Route::get('/', function (): View {
    return view('pages.auth.auth-login'); // ganti sesuai view kamu
});

Route::middleware(['auth'])->group(function () {
    Route::get('/home', function () {
        return view('pages.dashboard', ['type_menu' => 'dashboard']);
    })->name('home');

route::resource('users', UserController::class);
Route::resource('company',CompanyController::class);
route::resource('attendance', AttendanceControlller::class);
route::resource('permission', PermissionController::class);



});
