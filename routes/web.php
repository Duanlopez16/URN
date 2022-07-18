<?php

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

Auth::routes();

Route::resource('categoria', \App\Http\Controllers\CategoriaController::class)->middleware('auth');
Route::resource('rol', \App\Http\Controllers\RolController::class)->middleware('auth');
Route::resource('tipo-documento', \App\Http\Controllers\TipoDocumentoController::class)->middleware('auth');
Route::resource('user', \App\Http\Controllers\UserController::class)->middleware('auth');
Route::resource('talla', \App\Http\Controllers\TallaController::class)->middleware('auth');
Route::resource('producto', \App\Http\Controllers\ProductoController::class)->middleware('auth');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/user/search/params', [\App\Http\Controllers\UserController::class, 'search'])->name('search_user')->middleware('auth');
