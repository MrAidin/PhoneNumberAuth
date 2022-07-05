<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\TokenController;
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

Route::prefix('auth')->middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLogin'])->name('auth.login');
    Route::post('login', [LoginController::class, 'Login']);
    Route::get('register', [RegisterController::class, 'showRegister'])->name('auth.register');
    Route::post('register', [RegisterController::class, 'Register']);

    Route::get('token', [TokenController::class, 'showToken'])->name('auth.phone.token');
    Route::post('token', [TokenController::class, 'Token']);


});

