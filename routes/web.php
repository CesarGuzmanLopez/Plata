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


Route::get('/index',function (){
    return "homdsfdse";
})->name('/index');
Route::get("/Principal",function (){
    
    return view("index_no_login");
});