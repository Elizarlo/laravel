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

Route::get('/', function () {
    return view('principal/contenido');
});


#Ruta plantilla principal con section y yield
Route::get('/usuarios', function () {
    return view('principal/usuarios');
});
#https://elizarlo.me/Laravel/matutino/public/principal/categorias
Route::get('/principal', function () {
    return view('principal/contenido');
});

/*
Route::get('/hola', function () {
    return view('hola');
});*/

Route::get('/hola/{id}', function ($id) {
    //return view('hola');
    return 'mostrando'.$id;
})->where('id','[0-9]+');


Route::get('/saludo/{name}/{nickname?}', function ($name,$nickname=null) {
    //return view('hola');
    if($nickname){
      return "Bienvenido {$name} , tu apodo es {$nickname}";
    }else{
      return "Bienvenido {$name}, tu no tienes apodo";
    }

});
