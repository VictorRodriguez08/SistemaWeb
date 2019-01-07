<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Route::resource('administracion/rol','RolController');
Route::resource('administracion/usuario','UsuarioController');
Route::get('administracion/usuario/buscar/{criterio?}', 'UsuarioController@buscar')->name('usuario.buscar');
Route::resource('estados','EstadosController');
Route::resource('tesis','TesisController');
Route::get('tesis/GetUsuariosTesis/{id}','TesisController@GetUsuariosTesis');
Route::get('sendmail/{id}','MailController@email');
Route::get('administracion/rol/create/{id}','RolController@create');
Route::resource('registro/log','LogController');
Route::auth();


Route::get('/home', 'HomeController@index');
