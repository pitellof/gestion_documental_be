<?php

use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/* ROUTES FROM REST API WHIT LARAVEL */
// Rutas publicas
Route::post('login', 'ApiController@login');
Route::post('registry', 'ApiController@register');


Route::get('dc/data', 'DataController@show');

Route::post('dc/store-data','DataController@store');
Route::put('dc/update-data','DataController@update');
Route::delete('dc/delete-data','DataController@destroy');

Route::get('ti/data', 'TestInformationController@show');

Route::post('ti/store-data','TestInformationController@store');
Route::put('ti/update-data','TestInformationController@update');
Route::delete('ti/delete-data','TestInformationController@destroy');

// Rutas protejidas JWT
Route::group(['middleware' => 'auth.jwt'], function () {
    // Rutas de sesión de usuario
    Route::get('logout', 'ApiController@logout');
    Route::get('user', 'ApiController@getAuthUser');
    Route::put('change-password', 'ApiController@changePassword');
    Route::post('update-profile', 'ProfileController@update');
    //Rutas de ejecutivos
    Route::get('executive/brigaders', 'ProfileController@showAll');
    /**
     * Rutas de jefes de brigada
     * @todo change routes names
     */
    Route::post('register', 'ProfileController@register');
    Route::get('register/records', 'ProfileController@show');
    Route::get('register/records-last-actions', 'ProfileController@showLastActions');
    Route::delete('register/delete/{id}', 'ProfileController@delete');
    /**
     * Rutas de miembros de brigada
     * @todo change routes names
     */
    Route::get('register/records', 'ProfileController@showMember');
    /**
     * Catálogo de Tipo de Acción
     * @todo change routes names
     */
    Route::get('catalogs/type-action', 'CatTypeActionController@get');
    // Catálogo de Localidades
    Route::get('catalogs/locations', 'CatLocationController@get');
    // Catálogo de Municipios
    Route::get('catalogs/towns', 'CatTownController@get');
    //Exportar Excel
    Route::get('export', 'ApiController@export');

    //RUTA PROTEGIDA
    // Route::post('ti/user-data', 'TestInformationController@showUser');
    Route::post('ti/user-data', 'ApiController@getData');
});
