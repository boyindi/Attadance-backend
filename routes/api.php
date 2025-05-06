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
