<?php

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

Route::get('/', 'Controller@index') ;


//Categorias
Route::get('/categoria', 'CategoriaController@index') ;
Route::post('/categoria/agregar', 'CategoriaController@store') ;
Route::put('/categoria/actualizar', 'CategoriaController@update') ;
Route::put('/categoria/desactivar', 'CategoriaController@desactivar') ;
Route::put('/categoria/activar', 'CategoriaController@activar') ;

//Roles
Route::get('/rol', 'RolController@index') ;
Route::post('/rol/agregar', 'RolController@store') ;
Route::put('/rol/actualizar', 'RolController@update') ;
Route::put('/rol/desactivar', 'RolController@desactivar') ;
Route::put('/rol/activar', 'RolController@activar') ;


//Persona
Route::get('/persona', 'PersonaController@index') ;
Route::post('/persona/agregar', 'PersonaController@store') ;
Route::put('/persona/actualizar', 'PersonaController@update') ;

#Ruta plantilla principal con section y yield
Route::get('/usuarios', function () {
    return view('principal/usuarios');
});
#https://elizarlo.me/Laravel/matutino/public/principal/categorias
Route::get('/principal', function () {
    return view('principal/contenido');
});


