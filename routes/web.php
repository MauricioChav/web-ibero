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
Route::get('/', ['App\Http\Controllers\TaskController', 'index']);

Route::resource('/proyectos', 'App\Http\Controllers\ProjectController');

Route::resource('/tareas', 'App\Http\Controllers\TaskController');
//Te crea todas las rutas que corresponden a las funciones

