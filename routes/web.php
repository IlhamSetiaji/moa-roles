<?php

use App\Http\Controllers\LoginController;
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

Route::get('login', [LoginController::class, 'login'])->name('login');
Route::post('login', [LoginController::class, 'storeLogin']);
Route::get('register', [LoginController::class, 'register'])->name('register');
Route::post('register', [LoginController::class, 'StoreRegister']);

Route::middleware('auth')->group(function(){
    Route::get('logout', [LoginController::class, 'logout']);
    Route::get('/dashboard', function () {
        return view('dashboard');
    });
    Route::middleware('is.dosen')->group(function(){
        Route::get('/dosen', function () {
            return view('dosen');
        });
    });
    Route::middleware('is.mahasiswa')->group(function(){
        Route::get('/mahasiswa', function () {
            return view('mahasiswa');
        });
    });
});
