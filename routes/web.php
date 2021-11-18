<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['guest'])->group(function () {
    Route::get('register', [RegisterController::class, 'index'])->name('register');
    Route::post('register', [RegisterController::class, 'store'])->name('store');
    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('login', [LoginController::class, 'signin'])->name('signin');
});

Route::middleware(['auth'])->group(function() {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    Route::prefix('dashboard')->group(function() {
        Route::get('/',[HomeController::class,'index'])->name('index');
        Route::get('register-user-list',[HomeController::class,'ShowRegisterUserList'])->name('register-user-list');
    });
});
