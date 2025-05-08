<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Mendapatkan user yang sedang login
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// login
Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);

// logout
Route::post('/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout'])
    ->middleware('auth:sanctum');

// company - semua perusahaan
Route::get('/company', [\App\Http\Controllers\Api\CompanyController::class, 'index'])
    ->middleware('auth:sanctum');

// company - detail berdasarkan ID
Route::get('/company/{id}', [\App\Http\Controllers\Api\CompanyController::class, 'show'])
    ->middleware('auth:sanctum');

    // checkin
Route::post('/checkin', [\App\Http\Controllers\Api\AttendanceController::class, 'checkin'])
    ->middleware('auth:sanctum');

    // checkout
Route::post('/checkout', [\App\Http\Controllers\Api\AttendanceController::class, 'checkout'])
    ->middleware('auth:sanctum');

    // is checkin
Route::get('/ischeckedin', [\App\Http\Controllers\Api\AttendanceController::class, 'isCheckedin'])
    ->middleware('auth:sanctum');

// update profile
// Route::post('/update-profile-test', function (Request $request) {
//     return response()->json(['message' => 'Rute test berhasil']);
// })->middleware('auth:sanctum');

Route::post('/update-profile', [\App\Http\Controllers\Api\AuthController::class, 'updateProfile'])
    ->middleware('auth:sanctum');
