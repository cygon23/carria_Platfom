<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\homeController;
use Illuminate\Support\Facades\Route;


Route::get('/', [homeController::class, 'index']);

Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'processRegistration']);
Route::get('/login', [AuthController::class, 'login']);
Route::get('/login/auth', [AuthController::class, 'auth_login']);
