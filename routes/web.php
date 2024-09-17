<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('home');
// });

Route::get('register',[AuthController::class,'register']);
Route::post('register',[AuthController::class,'create_user']);
Route::post('verify/{token}',[AuthController::class,'verify']);
Route::get('login',[AuthController::class,'login']);
Route::post('login',[AuthController::class,'auth_login']);
Route::get('forgot',[AuthController::class,'forgot']);
