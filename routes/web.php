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
// Cargando clases

use App\Http\Middleware\ApiAuthMiddleware;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pruebas/{nombre?}', function ($nombre = null) {
    $texto = '<h2>Texto desde una ruta</h2>';
    $texto .= 'Nombre: '.$nombre;
    return view('pruebas', array(
        'texto' => $texto
    ));
});

Route::get('/animales', 'PruebasController@index');
Route::get('/testOrm', 'PruebasController@testOrm');


// Rutas del API
 /* Metodos HTTP comunes 
  * GET: Conseguir datos o recursos
  * POST: Guardar datos o recursos o hacer logica desde un formulario y devolver algo 
  * PUT: Actualizar recuros o datos
  * DELETE: ELiminar datos o recursos
  * 
 
 */
    // Rutas de prueba
    Route::get('/usuario/pruebas', 'userController@pruebas');
    Route::get('/categoria/pruebas', 'categoryController@pruebas');
    Route::get('/entrada/pruebas', 'postController@pruebas');
    
    // Rutas del controlador de usuarios
    
    Route::post('/api/register','userController@register' );
    Route::post('/api/login', 'userController@login');
    
    Route::put('/api/user/update', 'userController@update');
    Route::post('/api/user/upload', 'userController@upload') -> middleware(ApiAuthMiddleware::class);
    Route::get('/api/user/avatar/{filename}', 'userController@getImage');
    Route::get('/api/user/detail/{id}', 'userController@detail');

