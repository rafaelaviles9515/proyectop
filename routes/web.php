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

//para pelicula
Route::get('/pelicula', 'PeliculaController@index')->name('pelicula.index');
Route::get('/pelicula/crear', 'PeliculaController@create')->name('pelicula.crear');
Route::post('/pelicula/crear', 'PeliculaController@store')->name('pelicula.store');
Route::get('/pelicula/edit/{id}', 'PeliculaController@edit')->name('pelicula.edit');
Route::post('/pelicula/edit/{id}', 'PeliculaController@update')->name('pelicula.update');
