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
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/',[\App\Http\Controllers\Postcontroller::class,'index']);
    Route::get('/create',function(){ return view('create'); });
    Route::post('/post',[\App\Http\Controllers\Postcontroller::class,'store']);
    Route::delete('/delete/{id}',[\App\Http\Controllers\Postcontroller::class,'destroy']);
    Route::get('/edit/{id}',[\App\Http\Controllers\Postcontroller::class,'edit']);
    Route::put('/update/{id}',[\App\Http\Controllers\Postcontroller::class,'update']);
    Route::delete('/deleteimage/{id}',[\App\Http\Controllers\Postcontroller::class,'deleteimage']);
    Route::get('/register', [\App\Http\Controllers\AuthController::class, 'register'])->name('register');
    Route::post('/register', [\App\Http\Controllers\AuthController::class, 'registerPost'])->name('register');
    Route::delete('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
    Route::get('/search',[\App\Http\Controllers\Postcontroller::class,'search']);
    Route::get('/view/{id}',[\App\Http\Controllers\Postcontroller::class,'view']);
    Route::get('/user',[\App\Http\Controllers\AuthController::class,'index']);
});
