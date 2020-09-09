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

Route::get('/', function () {return "";})->name('/');
Auth::routes();
Route::get('/home',function (){
return view("home");
})->name('home');
Route::get("/",function (){
    return view("index_no_login");
})->name("/");

Route::group(['middleware' =>"auth", 'prefix' => 'Administrar', 'as' => 'Administrar'], function () {
    Route::resource('/Temas' , 'AltasYBajas\Temas');
    Route::resource('/Grados', 'AltasYBajas\Grados');
    Route::resource('/Cursos', 'AltasYBajas\Cursos');
});

Route::group(['middleware' =>"auth", 'prefix' => 'getsTables', 'as' => 'getTables'], function () {
    Route::get('/Temas' , 'getsTables\Temas')->name("/Temas");
    Route::get('/Grados', 'getsTables\Grados')->name("/Grados");
    Route::get('/Cursos', 'getsTables\Cursos')->name("/Cursos");
});
