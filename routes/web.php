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

Route::get('/', 'HomeController@welcome');

Route::get('/home', 'HomeController@home')->middleware('auth');

Route::get('/ajout', 'HomeController@ajout')->middleware('auth');
Route::post('/ajout_materiel', 'HomeController@ajout_materiel')->middleware('auth');

Route::get('/type', 'HomeController@type')->middleware('auth');
Route::post('/add_type', 'HomeController@add_type')->middleware('auth');
Route::get('/remove_type/{id}', 'HomeController@remove_type')->where('id', '[0-9]+')->middleware('auth');

Route::get('/admin', 'HomeController@admin')->middleware('auth');
Route::get('/admin/{qualite}/{id}', 'HomeController@change_qualite')->where('id', '[0-9]+')->middleware('auth');
Route::get('/remove_mat/{id}', 'HomeController@remove_mat')->where('id', '[0-9]+')->middleware('auth');

Route::get('/pre_reservation', 'HomeController@pre_reservation')->middleware('auth');
Route::post('/pre_reserv', 'HomeController@pre_reserv')->middleware('auth');
Route::get('/reservation/{id}', 'HomeController@reservation')->where('id', '[0-9]+')->middleware('auth');
Route::post('/reserv_mat/{id}', 'HomeController@reserv_mat')->where('id', '[0-9]+')->middleware('auth');

Route::get('/retour', 'HomeController@retour')->middleware('auth');
Route::post('/retour_mat', 'HomeController@retour_mat')->middleware('auth');
Route::get('/retour_mat/{id}', 'HomeController@retour_mat_id')->where('id', '[0-9]+')->middleware('auth');
Route::post('/retour_fin', 'HomeController@retour_fin')->middleware('auth');

Route::get('/perdu', 'HomeController@perdu')->middleware('auth');
Route::post('/perdu_form', 'HomeController@perdu_form')->middleware('auth');

Route::get('/retrouve', 'HomeController@retrouve')->middleware('auth');
Route::post('/retrouve_form', 'HomeController@retrouve_form')->middleware('auth');

Route::get('/recapitulatif', 'HomeController@recapitulatif')->middleware('auth');

Route::get('/ajout_carte', 'HomeController@ajout_carte')->middleware('auth');
Route::post('/ajout_carte_etu', 'HomeController@ajout_carte_etu')->middleware('auth');

Route::get('/gestion', 'HomeController@gestion')->middleware('auth');
Route::get('/remove_pers/{id}', 'HomeController@remove_pers')->where('id', '[0-9]+')->middleware('auth');