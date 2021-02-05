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

//vista para un index
Route::get('/', function () {
    return view('base.index');
})->name('index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//rutas para crear usuario
Route::get('/registar','UserController@index')->name('registrar.index');
Route::post('/crearregistro','UserController@store')->name('user.registro');
