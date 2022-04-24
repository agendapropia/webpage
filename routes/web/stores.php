<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes Stores
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('/stores')
    ->namespace('Stores')
    ->group(function () {
        Route::get('/', 'StoresController@index')
            ->middleware('permission:store-module')
            ->name('route-stores');
        Route::post('/', 'StoresController@create')->middleware(
            'permission:store-create'
        );
        Route::put('/', 'StoresController@update')->middleware(
            'permission:store-update'
        );

        /** query ajax */
        Route::patch('/status', 'StoresController@status')->middleware(
            'permission:store-update'
        );
        Route::get('/list', 'StoresController@list')->middleware(
            'permission:store-list'
        );
        Route::get('/create', 'StoresController@createInfo')->middleware(
            'permission:store-create'
        );
        Route::get('/update', 'StoresController@updateInfo')->middleware(
            'permission:store-update'
        );
        Route::get('/search-by-autocomplete', 'StoresController@searchByAutocomplete');
        
        Route::prefix('/{storeId}/schedules')->group(function () {
            Route::get('', 'StoreSchedulesController@list')->middleware(
                'permission:store-schedule'
            );
            Route::post('', 'StoreSchedulesController@create')->middleware(
                'permission:store-schedule-update'
            );
            Route::delete('', 'StoreSchedulesController@delete')->middleware(
                'permission:store-schedule-delete'
            );
        });
    });
