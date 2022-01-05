<?php

use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;
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
            return view('dosen.dosen');
        });
        Route::prefix('dosen')->group(function(){
            Route::get('classes', [DosenController::class, 'showClasses']);
            Route::post('create-class', [DosenController::class, 'storeClass']);
            Route::post('{masterClassID}/edit-class', [DosenController::class, 'editClass']);
            Route::post('{menteeTaskID}/{userID}/update-grade', [DosenController::class, 'updateGrade']);
            Route::get('{masterClassID}/delete-class', [DosenController::class, 'deleteClass']);
            Route::get('classes/{masterClassID}/tasks', [DosenController::class, 'showTasks']);
            Route::post('classes/{masterClassID}/tasks', [DosenController::class, 'storeTask']);
            Route::post('classes/{taskID}/edit-task', [DosenController::class, 'updateTask']);
            Route::get('classes/{taskID}/delete-task', [DosenController::class, 'deleteTask']);
            Route::get('{taskID}/task', [DosenController::class, 'detailTask']);
            Route::get('{menteeTaskID}/{userID}/show-files', [DosenController::class, 'showFiles']);
            Route::get('task/{fileName}/{userID}/download', [DosenController::class, 'download']);
        });
    });
    Route::middleware('is.mahasiswa')->group(function(){
        Route::get('/mahasiswa', function () {
            return view('mahasiswa.mahasiswa');
        });
        Route::prefix('mahasiswa')->group(function()
        {
            Route::get('classes', [MahasiswaController::class, 'showClasses']);
            Route::get('{masterClassID}/join', [MahasiswaController::class, 'joinClass']);
            Route::get('class/{masterClassID}', [MahasiswaController::class, 'detailClass']);
            Route::post('task/{menteeTaskID}/upload-task', [MahasiswaController::class, 'uploadTask']);
            Route::get('{taskID}/task', [MahasiswaController::class, 'detailTask']);
        });
    });
});
