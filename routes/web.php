<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name("welcome");


// Routes for public access
Route::post('/auth/login', [AuthController::class, 'login'])->name('login');
Route::get('/login', function () {
    return view('login');
})->name('login.page'); // Added name for login page route

// Protected routes (requires authentication)
Route::group(['middleware' => ['auth:sanctum']], function () {
    // Admin route
    Route::get('/admin', function () {
        return view('admin');
    })->middleware('restrictRole:admin')->name('admin');

    // Employee route
    Route::get('/employee', function () {
        return view('employee');
    })->middleware('restrictRole:employee')->name('employee');
});


