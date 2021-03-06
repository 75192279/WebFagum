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


Route::get('/producto', 'ProductoController@index');
Route::resource('/usuario','UsuarioController');
Route::post('/add-producto-carrito','CarritoController@AddCart');
Route::get('/list-producto-carrito','CarritoController@listarCarts');
Route::get('/ckecked-user-login','CarritoController@checkedUser');
Route::post('/procesar-compra-producto-carrito','CarritoController@realizarCompra');
Route::post('/delete-producto-carrito','CarritoController@eliminarCarts');

Route::post('/action-producto-carrito','CarritoController@actionCart');
Route::get('/nosotros', function () {
    return view('home.nosotros');
});
Route::group(['middleware'=>['guest']],function(){
    Route::get('/login','Auth\LoginController@viewLogin')->name('login');
    Route::post('/login-autenticate','Auth\LoginController@login');
    Route::post('/login-register','Auth\RegisterController@create');
});
Route::group(['middleware'=>['auth']],function(){
    Route::get('/logout','Auth\LoginController@logout')->name('logout');
    Route::post('/payment', 'PaymentController@Payment');
});
Route::group(['prefix'=>'users','middleware'=>['auth','cliente']],function(){
    Route::get('/',function(){
        echo "Cliente autenticado";
    });
    Route::get('/ventaspdf', 'VentaController@crearPdfVentas');

    Route::get('/compraclientepayment','PaymentController@compraPayment');
    Route::get('/compraclientepaymentcomplete','PaymentController@compraPaymentComplete');
    Route::get('/mis-compras','HomeController@MisCompras');
    Route::get('/mis-compras-lista','HomeController@MisComprasList');
    Route::get('/obtenerCabecera', 'VentaController@obtenerCabecera');
    Route::get('/venta/obtenerDetalles', 'VentaController@obtenerDetalles');
    
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

    
    Route::get('/ventaspdf', 'VentaController@crearPdfVentas');
    Route::get('/venta', 'VentaController@index');
    Route::post('/venta/registrar', 'VentaController@store');
    Route::put('/venta/desactivar', 'VentaController@desactivar');
    Route::get('/venta/obtenerCabecera', 'VentaController@obtenerCabecera');
    Route::get('/venta/obtenerDetalles', 'VentaController@obtenerDetalles');
    
    Route::get('/cliente/selectCliente', 'UsuarioController@selectCliente');


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