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
    ->namespace('Articles')
    ->group(function () {
        Route::get(
            '/search-by-autocomplete',
            'ArticleContentsController@searchByAutocomplete'
        );
    });

Route::prefix('{articleSlug}/contents')
    ->namespace('Articles')
    ->group(function () {
        Route::get('', 'ArticleContentsController@index')
            ->middleware('permission:article-content-module')
            ->name('module-content');
        Route::put('', 'ArticleContentsController@update')->middleware(
            'permission:article-content-update'
        );
        Route::get(
            '/update',
            'ArticleContentsController@updateInfo'
        )->middleware('permission:article-content-update');
        Route::post(
            '/files',
            'ArticleContentsController@createFiles'
        )->middleware('permission:article-content-update');
        Route::get('/files', 'ArticleContentsController@files')->middleware(
            'permission:article-content-update'
        );

        Route::post(
            '/copies',
            'ArticleContentsController@copy'
        )->middleware('permission:article-content-update');
    });
