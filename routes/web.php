<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/home', function () {
    return view("home");
})->name('home');

Route::get("/", function () {
    return view("index_no_login");
})->name("/");

Route::group(['middleware' => "auth", 'prefix' => 'Administrar', 'as' => 'Administrar'], function () {
    Route::resource('/Temas', 'AltasYBajas\Temas');
    Route::resource('/Grados', 'AltasYBajas\Grados');
    Route::resource('/Cursos', 'AltasYBajas\Cursos');
    Route::resource('/Reactivos', 'AltasYBajas\Reactivos');
    Route::resource('/Opciones', 'AltasYBajas\Opciones');
    Route::resource('/Retroalimentacion', 'AltasYBajas\Retroalimentacion');
    
});

Route::group(['middleware' => "auth", 'prefix' => 'Gestor', 'as' => 'Gestor'], function () {
    Route::post('/uploadImagen', 'Gestores\UploadImagen')->name('/uploadImagen');
    Route::resource('/Reactivos', 'Gestores\Reactivos');
    Route::resource('/TGC', 'Gestores\CursosGradosTemas');
    Route::resource('/Opciones', 'Gestores\Opciones');
});

Route::group(['middleware' => "auth", 'prefix' => 'Reactivo', 'as' => 'Reactivo'], function () {
  Route::resource('OpcionesMultiples', 'Reactivos\OpcionesMultiples');
  Route::post('/Multiple', 'Reactivos\Multiple')->name('/Multiple');
});