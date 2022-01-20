<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KebunController;
use App\Http\Controllers\AnggaranController;
use App\Http\Controllers\JenisTanamanController;

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::group(['middleware' => 'accessToken'], function(){
    Route::resource('/kebun', KebunController::class);

    Route::get('/anggaran', [AnggaranController::class, 'index']);
    Route::post('/anggaran', [AnggaranController::class, 'store']);
    Route::get('/anggaran/{id}', [AnggaranController::class, 'show']);
    Route::put('/anggaran/{id}', [AnggaranController::class, 'update']);
    Route::delete('/anggaran/{id}', [AnggaranController::class, 'destroy']);
    
    Route::post('/detail-anggaran', [DetailAnggaranController::class, 'store']);
    Route::get('/detail-anggaran/{id}', [DetailAnggaranController::class, 'show']);
    Route::put('/detail-anggaran/{id}', [DetailAnggaranController::class, 'update']);
    Route::delete('/detail-anggaran/{id}', [DetailAnggaranController::class, 'destroy']);
    

    Route::get('/jenis_tanaman', [JenisTanamanController::class, 'index']);
});