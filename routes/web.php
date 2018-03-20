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
    return view('welcome');
});


Auth::routes();

Route::get('/home', 'HomeController@home');
Route::get('/ajout', 'HomeController@ajout')->middleware('auth');
Route::post('/ajout_materiel', 'HomeController@ajout_materiel')->middleware('auth');
Route::get('/ajout_type', 'HomeController@ajout_type')->middleware('auth');
Route::post('/add_type', 'HomeController@add_type')->middleware('auth');

Route::get('/supp_type', 'HomeController@supp_type')->middleware('auth');
/*Route::get('/remove_type/{id}', 'HomeController@remove_type')->where('id', '[0-9]+')->middleware('auth');*/

Route::get('/liste', 'HomeController@liste')->middleware('auth');
