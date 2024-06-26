<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MapaController;

Route::get('/', function () {
    return view('welcome');
})->name('home');
Route::get('/login', [LoginController::class, 'showLoginForm']);
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/registro', [LoginController::class, 'showRegistroForm']);
Route::post('/registro', [LoginController::class, 'registro'])->name('registro');
Route::get('/valida-email/{id}', [LoginController::class, 'valida_email'])->name('user.valida_email');
Route::get('/logout', [LoginController::class, 'destroy'])->middleware('auth')->name('logout');

Route::group(['prefix' => 'admin'], function() {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/editar-empresa/{id}', [AdminController::class, 'editarEmpresa'])->name('admin.editar-empresa');
    Route::get('/eliminar-empresa/{id}', [AdminController::class, 'eliminarEmpresa'])->name('admin.eliminar-empresa');
    Route::get('/lista-empresas', [AdminController::class, 'verListaEmpresas'])->name('admin.lista.empresas');
    Route::get('/lista-empresas-data', [AdminController::class, 'getListaEmpresas'])->name('admin.empresas');
    Route::get('/new-company-form', [AdminController::class, 'showFormNewCompany'])->name('admin.nueva.form.empresa');
    Route::post('/new-company', [AdminController::class, 'newCompany'])->name('admin.nueva.empresa');
    Route::post('/company-ubicacion', [AdminController::class, 'guardaUbicacion'])->name('admin.guardar.ubicacion');
    Route::get('/ver-mapa', [AdminController::class, 'verMapa'])->name('admin.ver.mapa');
    Route::get('/ver-mapa/todos', [MapaController::class, 'getVerMapaTodo'])->name('admin.ver.mapa.todo');
    Route::get('/producto', [AdminController::class, 'showFormNewProduct'])->name('admin.producto');
    Route::get('/producto/{id}', [AdminController::class, 'verProducto'])->name('admin.ver.producto');
    Route::get('/lista/productos', [AdminController::class, 'verListaProductos'])->name('admin.lista.ver.producto');
    Route::get('/lista/productos/solicitar/{id}', [AdminController::class, 'showFormSolicitarProducto'])->name('admin.lista.producto.solicitar');
    Route::post('/nuevo-producto', [AdminController::class, 'newProduct'])->name('admin.nuevo.producto');
    Route::post('/productos', [AdminController::class, 'getProductosAdmin'])->name('api.productos.imagenes');
});


