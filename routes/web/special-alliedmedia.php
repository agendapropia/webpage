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
Route::prefix('/allied-media')
    ->namespace('Specials')
    ->group(function () {
        Route::get('', 'AlliedMediaController@index')
            ->middleware('permission:alliedmedia-module')
            ->name('module-alliedmedia');
        Route::post('', 'AlliedMediaController@create')->middleware(
            'permission:alliedmedia-create'
        );
        Route::put('', 'AlliedMediaController@update')->middleware(
            'permission:alliedmedia-update'
        );
        Route::patch('/status', 'AlliedMediaController@status')->middleware(
            'permission:alliedmedia-update'
        );
        Route::get('/list', 'AlliedMediaController@list')->middleware(
            'permission:alliedmedia-list'
        );
        Route::get('/create', 'AlliedMediaController@createInfo')->middleware(
            'permission:alliedmedia-create'
        );
        Route::get('/update', 'AlliedMediaController@updateInfo')->middleware(
            'permission:alliedmedia-update'
        );
        Route::post('/files', 'AlliedMediaController@createFiles')->middleware(
            'permission:alliedmedia-update'
        );
        Route::get('/files', 'AlliedMediaController@files')->middleware(
            'permission:alliedmedia-update'
        );
        Route::get(
            '/search-by-autocomplete',
            'AlliedMediaController@searchByAutocomplete'
        );
    });
