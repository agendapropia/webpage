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
Route::prefix('/')
    ->namespace('Articles')
    ->group(function () {
        Route::get('/', 'ArticlesController@index')
            ->middleware('permission:article-module')
            ->name('module-article');
        Route::post('/', 'ArticlesController@create')->middleware(
            'permission:article-create'
        );
        Route::put('/', 'ArticlesController@update')->middleware(
            'permission:article-update'
        );

        /** query ajax */
        Route::patch('/status', 'ArticlesController@status')->middleware(
            'permission:article-update'
        );
        Route::get('/list', 'ArticlesController@list')->middleware(
            'permission:article-list'
        );
        Route::get('/create', 'ArticlesController@createInfo')->middleware(
            'permission:article-create'
        );
        Route::get('/update', 'ArticlesController@updateInfo')->middleware(
            'permission:article-update'
        );

        // USERS
        Route::post('/users', 'ArticleUsersController@create');
        Route::get('/users/list', 'ArticleUsersController@list');
        Route::delete('/users', 'ArticleUsersController@delete');

        // ROLES
        Route::get('/roles', 'ArticleRolesController@get');

        // FILES
        Route::post('/files', 'ArticleFilesController@create');
        Route::get('/files', 'ArticleFilesController@get');
    });
