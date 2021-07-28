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

Route::get('/', function () {
    return view('welcome');
})->name('welcom');
Route::get('/proof', function () {  
    return view('myView/tablePrueba');
})->name('proof')->middleware('auth'); 
/* Route::get('/table', function () {  
    return view('myView/table');
})->name('table'); */
/* Route::get('/newTorneo', function () {  
    return view('myView/newTorneo');
})->name('newTorneo'); */ 
/* Route::get('/', function () {
    return view('welco');
}); */

// # New Torneo
Route::get('/newTorneo','App\Http\Controllers\TorneoController@index')->name('newTorneo')->middleware('auth');
Route::post('/endTorneo','App\Http\Controllers\TorneoController@update')->name('end')->middleware('auth');
Route::get('/editNameTorneo/{id}/','App\Http\Controllers\TorneoController@edit')->name('editNameTorneo')->middleware('auth');
Route::put('/updateNameTorneo/{torneo}','App\Http\Controllers\TorneoController@updateNameTorneo')->middleware('auth');


// # Tabla General 
Route::get('/match','App\Http\Controllers\PointController@index')->name('match')->middleware('auth');
Route::get('/matchOld/{torneo}','App\Http\Controllers\PointController@matchOld')->name('matchOld')->middleware('auth');


// # Rutas Asociadas al CRUD de Result 
Route::get('/dashboard','App\Http\Controllers\ResultController@index')->name('dashboard')->middleware('auth')->middleware('auth');
Route::get('/table','App\Http\Controllers\ResultController@listTable')->name('table')->middleware('auth');
Route::post('/result', 'App\Http\Controllers\ResultController@store')->name('insertResult')->middleware('auth'); //Form Registro
Route::get('/result/{idMatch}/edit', 'App\Http\Controllers\ResultController@edit')->middleware('auth');
Route::put('/updateResult/{idl}/{idv}','App\Http\Controllers\ResultController@update')->name('updateResult')->middleware('auth');

// # Rutas Asociadas al CRUD de Torneos 
//Route::get('/newTorneo','App\Http\Controllers\TorneoController@index')->middleware('auth');
Route::post('/newTorneo', 'App\Http\Controllers\TorneoController@store')->name('insertTorneo')->middleware('auth'); //Form Registro
Route::get('/newTorneo/{specialty}/edit', 'App\Http\Controllers\TorneoController@edit')->middleware('auth');
Route::get('/allTorneos', 'App\Http\Controllers\TorneoController@allTorneos')->name('allTorneos')->middleware('auth'); 

/* Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {  return view('myView/dashboard');
})->name('dashboard'); */




