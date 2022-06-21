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
Route::prefix('{specialSlug}/contents')
    ->namespace('Specials')
    ->group(function () {
        Route::get('', 'SpecialContentsController@index')
            ->middleware('permission:content-module')
            ->name('module-content');
        Route::post('', 'SpecialContentsController@create')->middleware(
            'permission:content-create'
        );
        Route::put('', 'SpecialContentsController@update')->middleware(
            'permission:content-update'
        );
        Route::patch('/status', 'SpecialContentsController@status')->middleware(
            'permission:content-update'
        );
        Route::get('/list', 'SpecialContentsController@list')->middleware(
            'permission:content-list'
        );
        Route::get('/create', 'SpecialContentsController@createInfo')->middleware(
            'permission:content-create'
        );
        Route::get('/update', 'SpecialContentsController@updateInfo')->middleware(
            'permission:content-update'
        );
        Route::post('/files', 'SpecialContentsController@createFiles')->middleware(
            'permission:content-update'
        );
        Route::get('/files', 'SpecialContentsController@files')->middleware(
            'permission:content-update'
        );
        Route::get(
            '/search-by-autocomplete',
            'SpecialContentsController@searchByAutocomplete'
        );
    });
