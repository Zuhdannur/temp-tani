<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KebunController;
use App\Http\Controllers\AnggaranController;
use App\Http\Controllers\DetailAnggaranController;
use App\Http\Controllers\ItemAnggaranController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\JenisTanamanController;
use App\Http\Controllers\SummaryController;

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::group(['middleware' => 'accessToken'], function(){
    Route::resource('/kebun', KebunController::class);

    Route::get('/anggaran', [AnggaranController::class, 'index']);
    Route::post('/anggaran', [AnggaranController::class, 'store']);
    Route::get('/anggaran/{id}', [AnggaranController::class, 'show']);
    Route::put('/anggaran/{id}', [AnggaranController::class, 'update']);
    Route::delete('/anggaran/{id}', [AnggaranController::class, 'destroy']);
    
    Route::get('/detail-anggaran', [DetailAnggaranController::class, 'index']);
    Route::post('/detail-anggaran', [DetailAnggaranController::class, 'store']);
    Route::get('/detail-anggaran/{id}', [DetailAnggaranController::class, 'show']);
    Route::put('/detail-anggaran/{id}', [DetailAnggaranController::class, 'update']);
    Route::delete('/detail-anggaran/{id}', [DetailAnggaranController::class, 'destroy']);
    
    Route::get('/item-anggaran', [ItemAnggaranController::class, 'index']);
    Route::post('/item-anggaran', [ItemAnggaranController::class, 'store']);
    Route::get('/item-anggaran/{id}', [ItemAnggaranController::class, 'show']);
    Route::put('/item-anggaran/{id}', [ItemAnggaranController::class, 'update']);
    Route::delete('/item-anggaran/{id}', [ItemAnggaranController::class, 'destroy']);
    
    Route::get('/barang', [BarangController::class, 'index']);
    Route::post('/barang', [BarangController::class, 'store']);
    Route::get('/barang/{id}', [BarangController::class, 'show']);
    Route::put('/barang/{id}', [BarangController::class, 'update']);
    Route::delete('/barang/{id}', [BarangController::class, 'destroy']);

    Route::get('/jenis_tanaman', [JenisTanamanController::class, 'index']);

    Route::get('/summary/print/{id}', [SummaryController::class, 'print']);
    Route::get('/summary/{id}', [SummaryController::class, 'show']);
});