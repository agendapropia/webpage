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
Route::prefix('contents')
    ->namespace('Specials')
    ->group(function () {
        Route::get(
            '/search-by-autocomplete',
            'SpecialContentsController@searchByAutocomplete'
        );
    });

Route::prefix('{specialSlug}/contents')
    ->namespace('Specials')
    ->group(function () {
        Route::get('', 'SpecialContentsController@index')
            ->middleware('permission:special-content-module')
            ->name('module-content');
        Route::put('', 'SpecialContentsController@update')->middleware(
            'permission:special-content-update'
        );
        Route::get(
            '/update',
            'SpecialContentsController@updateInfo'
        )->middleware('permission:special-content-update');
        Route::post(
            '/files',
            'SpecialContentsController@createFiles'
        )->middleware('permission:special-content-update');
        Route::get('/files', 'SpecialContentsController@files')->middleware(
            'permission:special-content-update'
        );

        Route::post(
            '/copies',
            'SpecialContentsController@copy'
        )->middleware('permission:special-content-update');
    });
