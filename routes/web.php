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
Route::post('/procesar', 'RestController@procesarDatos');
Route::get('/prueba', function () {
    return view('prueba');
});
Route::get('/', function () {
    return view('welcome');
});
