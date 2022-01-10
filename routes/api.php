<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KebunController;

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::group(['middleware' => 'accessToken'], function(){
    Route::post('/kebun', [KebunController::class, 'store']);
});