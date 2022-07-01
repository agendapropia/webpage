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
Route::prefix('/regions')
    ->namespace('Configurations\Regions')
    ->group(function () {
        Route::get('/', 'RegionsController@index')
            ->middleware('permission:region-module')
            ->name('module-regions');

        Route::post('/', 'RegionsController@create')->middleware(
            'permission:region-create'
        );
        Route::put('/', 'RegionsController@update')->middleware(
            'permission:region-update'
        );

        /** query ajax */
        Route::patch('/status', 'RegionsController@status')->middleware(
            'permission:region-update'
        );
        Route::get('/list', 'RegionsController@list')->middleware(
            'permission:region-list'
        );
        Route::get('/create', 'RegionsController@createInfo')->middleware(
            'permission:region-create'
        );
        Route::get('/update', 'RegionsController@updateInfo')->middleware(
            'permission:region-update'
        );
        Route::get('/search-by-autocomplete', 'RegionsController@searchByAutocomplete');
    });
