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

Route::get('/', 'DashboardController@index', function () {
    return view('home');
});
Route::get('/server1', 'DataAbsenController@server1');
Route::get('/server2', 'DataAbsenController@server2');
Route::get('/server3', 'DataAbsenController@server3');
Route::get('/pimpinan', 'DataAbsenController@pimpinan');

Route::get('/opd/{id_user}', 'DashboardController@opd_id');


Route::get('/absen', 'DataAbsenController@index');
