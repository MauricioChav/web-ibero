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

/*
EJEMPLOS DE RUTAS

Route::resource();

//Todas las siguientes forman parte de resource
Route::get();
Route::post();
Route::put();
Route::delete();

*/
Route::get('/', [
	'uses' => 'App\Http\Controllers\HomeController@mainSite',
	'as' => 'index']);


//Te crea todas las rutas que corresponden a las funciones


Auth::routes();

Route::group(['middleware' => 'auth'], function(){
	Route::resource('/proyectos', 'App\Http\Controllers\ProjectController');

	Route::resource('/tareas', 'App\Http\Controllers\TaskController');


	Route::get('/admin', [
	'uses' => 'App\Http\Controllers\HomeController@index',
	'as' => 'home'
	]);
});



