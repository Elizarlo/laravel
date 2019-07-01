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
Route::get('/categoria/select', 'CategoriaController@select') ;

//Roles
Route::get('/rol', 'RolController@index') ;
Route::post('/rol/agregar', 'RolController@store') ;
Route::put('/rol/actualizar', 'RolController@update') ;
Route::put('/rol/desactivar', 'RolController@desactivar') ;
Route::put('/rol/activar', 'RolController@activar') ;
Route::get('/rol/select', 'RolController@select') ;


//Persona
Route::get('/persona', 'PersonaController@index') ;
Route::post('/persona/agregar', 'PersonaController@store') ;
Route::put('/persona/actualizar', 'PersonaController@update') ;
Route::get('/persona/select', 'PersonaController@select') ;

//Proveedor
Route::get('/proveedor', 'ProveedorController@index') ;
Route::post('/proveedor/agregar', 'ProveedorController@store') ;
Route::put('/proveedor/actualizar', 'ProveedorController@update') ;
Route::get('/proveedor/select', 'ProveedorController@select') ;

//Ingresos
Route::get('/ingreso', 'IngresoController@index') ;
Route::post('/ingreso/agregar', 'IngresoController@store') ;
Route::put('/ingreso/desactivar', 'IngresoController@desactivar') ;
Route::put('/ingreso/activar', 'IngresoController@activar') ;

//Usuario
Route::get('/usuario', 'UsuarioController@index') ;
Route::post('/usuario/agregar', 'UsuarioController@store') ;
Route::put('/usuario/actualizar', 'UsuarioController@update') ;
Route::put('/usuario/desactivar', 'UsuarioController@desactivar') ;
Route::put('/usuario/activar', 'UsuarioController@activar') ;
Route::get('/usuario/select', 'UsuarioController@select') ;

//Articulo
Route::get('/articulo', 'ArticuloController@index') ;
Route::post('/articulo/agregar', 'ArticuloController@store') ;
Route::put('/articulo/actualizar', 'ArticuloController@update') ;
Route::put('/articulo/desactivar', 'ArticuloController@desactivar') ;
Route::put('/articulo/activar', 'ArticuloController@activar') ;
Route::get('/articulo/select', 'ArticuloController@select') ;

//Venta
Route::get('/venta', 'VentaController@index') ;
Route::post('/venta/agregar', 'VentaController@store') ;
Route::put('/venta/actualizar', 'VentaController@update') ;
Route::put('/venta/desactivar', 'VentaController@desactivar') ;
Route::put('/venta/activar', 'VentaController@activar') ;
Route::get('/venta/select', 'VentaController@select') ;

#Ruta plantilla principal con section y yield
Route::get('/usuarios', function () {
    return view('principal/usuarios');
});
#https://elizarlo.me/Laravel/matutino/public/principal/categorias
Route::get('/principal', function () {
    return view('principal/contenido');
});


