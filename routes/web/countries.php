<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes Users
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

# code...
Route::prefix('/countries')
    ->namespace('Configurations\Countries')
    ->group(function () {
        Route::get('/search-by-autocomplete', 'CountriesController@searchByAutocomplete');
    });
