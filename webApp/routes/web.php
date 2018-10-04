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

Route::get('/', 'HomeController@index')->name('/');
Route::get('/producto', 'HomeController@producto');
Route::get('/carrito', 'HomeController@carrito');
Route::get('/contacto', 'HomeController@contacto');


Route::get('/login','Auth\LoginController@viewLogin')->name('login');
Route::post('/login-autenticate','Auth\LoginController@login');
Route::post('/login-register','Auth\RegisterController@create');
Route::get('/logout','Auth\LoginController@logout')->name('logout');
Route::get('/producto', 'ProductoController@index');
Route::resource('/usuario','UsuarioController');

Route::get('/nosotros', function () {
    return view('home.nosotros');
});

Route::group(['prefix'=>'users','middleware'=>['auth','cliente']],function(){
    Route::get('/',function(){
        echo "Cliente autenticado";
    });
});
Route::group(['prefix'=>'dashboard','middleware'=>['auth','admin']],function(){
    Route::get('/',function(){
       return view('contenido.contenido');
    });
    Route::post('/upload-image','ImageController@upload');
    Route::get('/rol', 'RolController@index');
    Route::get('/rol/selectRol', 'RolController@selectRol');

     Route::get('/user', 'UsuarioController@index');
    Route::post('/user/register','UsuarioController@store');
    Route::put('/user/update','UsuarioController@update');
    Route::put('/user/desactivar', 'UsuarioController@desactivar');
    Route::put('/user/activar', 'UsuarioController@activar');

    Route::get('/categoria', 'CategoriaController@index');
    Route::post('/categoria/registrar', 'CategoriaController@store');
    Route::put('/categoria/actualizar', 'CategoriaController@update');
    Route::put('/categoria/desactivar', 'CategoriaController@desactivar');
    Route::put('/categoria/activar', 'CategoriaController@activar');
    Route::get('/categoria/selectCategoria', 'CategoriaController@selectCategoria');

    Route::get('/producto', 'ProductoController@index');
    Route::post('/producto/registrar', 'ProductoController@store');
    Route::put('/producto/actualizar', 'ProductoController@update');
    Route::put('/producto/desactivar', 'ProductoController@desactivar');
    Route::put('/producto/activar', 'ProductoController@activar');
    Route::get('/producto/buscarProducto', 'ProductoController@buscarProducto');
    Route::get('/producto/listarProducto', 'ProductoController@listarProducto');
    Route::get('/producto/buscarProductoVenta', 'ProductoController@buscarProductoVenta');
    Route::get('/producto/listarProductoVenta', 'ProductoController@listarProductoVenta');
    Route::get('/producto/listarPdf', 'ProductoController@listarPdf')->name('productos_pdf');
});