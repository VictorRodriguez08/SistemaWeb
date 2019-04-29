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

Route::get('/','InicioController@Index');

Route::resource('administracion/rol','RolController');
Route::resource('administracion/usuario','UsuarioController');
Route::get('administracion/usuario/buscar/{tipo}/{criterio?}/{opcionBusqueda?}', 'UsuarioController@buscar')->name('usuario.buscar');
Route::resource('estados','EstadosController');
Route::resource('tesis','TesisController');
Route::get('tesis/GetUsuariosTesis/{id}','TesisController@GetUsuariosTesis');

Route::get('usuario/GetUsuarios/{id}','UsuarioController@GetUsuarios');
Route::post('tesis/SubirArchivo/','TesisController@SubirArchivo');
Route::post('tesis/EliminarArchivo/{tesis_id}/{id?}','TesisController@EliminarArchivo');
Route::get('tesis/generar_cartas/{tesis_id}/{tipo?}','TesisController@generar_cartas');
Route::get('sendmail/{id}','MailController@email');
Route::get('administracion/rol/create/{id}','RolController@create');

Route::resource('registro/log','LogController');
Route::get('/log','LogController@index')->name('logs');
Route::get('descargar/{searchText}','LogController@pdf');
Route::resource('inicio','InicioController');
Route::resource('congreso','CongresoController');
Route::resource('autores_congreso','AutoresCongresoController');
Route::get('congreso/GetArchivos/{tema}','AutoresCongresoController@GetArchivos');
Route::get('autores_congreso/GetAutoresCongreso/{id?}','AutoresCongresoController@GetAutoresCongreso');
Route::post('congreso/SubirArchivo/','AutoresCongresoController@uploading');


Route::auth();


Route::get('/home', 'InicioController@index');
