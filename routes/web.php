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
Auth::routes();

Route::get('/', function () {
   return view('auth.login');
});

#Route::match(['get', 'post'], 'register', function(){ return redirect('/'); });

Route::get('/logout', function () {
	Auth::logout();
   return redirect('/');
});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');

#RUTAS PUBLICAS
Route::get('verificar/{email}/{verifyToken}', 'Auth\RegisterController@enviarEmailhecho');

Route::group(['middleware'=>'auth','role:admin | operativo | piloto'],function () {
   Route::get('escritorio', 'HomeController@index')->name('escritorio'); 
});

#Rutas para el area de distribuidores
Route::group(['middleware'=>'auth','role:admin | operativo'],function () {

   #VISTAS 
   Route::get('usuario', 'Ajustes\UsuarioController@index')->name('usuario');
   Route::get('subirArchivo', 'XMLController@index')->name('subirArchivo');

   Route::group(['prefix' => 'api/'], function(){

      Route::post('subirArchivo', 'XMLController@subirArchivo');

      
      Route::get('usuario', 'HomeController@usuario');
      Route::get('infoEmpresa', 'HomeController@infoEmpresa');

      Route::group(['prefix' => 'escritorio/'], function(){
         Route::get('getResumen', 'EscritorioController@getResumen');
         Route::get('getPedidos', 'EscritorioController@getPedidos');
         Route::get('transacciones/{tipo}', 'EscritorioController@transcciones');
         Route::get('masVendido', 'EscritorioController@masVendido');
         Route::post('asignarMeta', 'EscritorioController@asignarMeta');
      });

      Route::group(['prefix' => 'ajustes/'], function(){

         Route::group(['prefix' => 'usuario/'], function(){
            Route::get('getUsuarios', 'Ajustes\UsuarioController@getUsuarios');
            Route::post('nuevoUsuario', 'Ajustes\UsuarioController@nuevoUsuario');
            Route::put('editarUsuario', 'Ajustes\UsuarioController@editarUsuario');
         });

      });

   });

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
