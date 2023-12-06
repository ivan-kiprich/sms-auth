<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegistrerController;
use App\Http\Controllers\Auth\VerifyController;
use Illuminate\Support\Facades\Route;

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
});

Route::middleware("guest")->group(function () {
    Route::view('/register', 'auth.register')->name('auth.register');
    Route::view('/verify', 'auth.verify')->name('auth.verify');
    Route::view('/login', 'auth.login')->name('login');
    Route::post('/register/create', [RegistrerController::class, 'create'])->name('auth.register.create');
    Route::post('/register/verify', [VerifyController::class, 'verifyCode'])->name('auth.verify.code');
    Route::post('/auth/login', [LoginController::class, 'login'])->name('auth.login');
});

Route::middleware("auth")->group(function () {
    Route::view("/dashboard", "front.dashboard")->name("dashboard");
    Route::get("/logout", [LoginController::class, 'logout'])->name("logout");
});
