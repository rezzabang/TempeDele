<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Postcontroller;
use App\Http\Controllers\AuthController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
    Route::post('/login', [\App\Http\Controllers\AuthController::class, 'loginPost'])->name('login');
    Route::get('/reloadCaptcha', [\App\Http\Controllers\AuthController::class, 'reloadCaptcha'])->name('reloadCaptcha');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/',[\App\Http\Controllers\Postcontroller::class,'index']);
    Route::get('/create',function(){ return view('create'); });
    Route::post('/post',[\App\Http\Controllers\Postcontroller::class,'store'])->name('post');
    Route::delete('/delete/{id}',[\App\Http\Controllers\Postcontroller::class,'destroy'])->name('delete');
    Route::get('/edit/{id}',[\App\Http\Controllers\Postcontroller::class,'edit']);
    Route::put('/update/{id}',[\App\Http\Controllers\Postcontroller::class,'update'])->name('update');
    Route::delete('/deleteimage/{id}',[\App\Http\Controllers\Postcontroller::class,'deleteimage'])->name('deleteimage');
    Route::get('/register', [\App\Http\Controllers\AuthController::class, 'register'])->name('register');
    Route::post('/register', [\App\Http\Controllers\AuthController::class, 'registerUser'])->name('registerUser');
    Route::delete('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
    Route::get('/search',[\App\Http\Controllers\Postcontroller::class,'search'])->name('search');
    Route::get('/view/{id}',[\App\Http\Controllers\Postcontroller::class,'view']);
    Route::get('/user',[\App\Http\Controllers\AuthController::class,'index'])->name('user');
    Route::get('/edituser/{id}',[\App\Http\Controllers\AuthController::class,'edituser'])->name('edituser');
    Route::delete('/deleteuser/{id}',[\App\Http\Controllers\AuthController::class,'deleteuser'])->name('deleteuser');
    Route::put('/updateuser/{id}',[\App\Http\Controllers\AuthController::class,'updateuser'])->name('updateuser');
    Route::get('/exportLaporan',[\App\Http\Controllers\Postcontroller::class,'exportLaporan'])->name('exportLaporan');
    Route::post('/rotate',[\App\Http\Controllers\Postcontroller::class,'rotate'])->name('rotate');
});
