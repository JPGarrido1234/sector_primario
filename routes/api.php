<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/* API APP */
Route::post('/login', [ApiController::class, 'login'])->name('api.user.login');
Route::post('/registro', [ApiController::class, 'registro'])->name('api.user.registro');
Route::get('/valida-email/{id}', [ApiController::class, 'valida_email'])->name('api.user.valida_email');
Route::get('/logout', [ApiController::class, 'destroy'])->middleware('auth')->name('api.user.logout');

/* TIENDA */
Route::post('alta-tienda', [ApiController::class, 'alta_tienda'])->name('api.tienda.alta_tienda');
