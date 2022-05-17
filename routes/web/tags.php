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
Route::prefix('/tags')
    ->namespace('Configurations\Tags')
    ->group(function () {
        Route::get('/', 'TagsController@index')
            ->middleware('permission:tag-module')
            ->name('module-tags');

        Route::post('/', 'TagsController@create')->middleware(
            'permission:tag-create'
        );
        Route::put('/', 'TagsController@update')->middleware(
            'permission:tag-update'
        );

        /** query ajax */
        Route::patch('/status', 'TagsController@status')->middleware(
            'permission:tag-update'
        );
        Route::get('/list', 'TagsController@list')->middleware(
            'permission:tag-list'
        );
        Route::get('/create', 'TagsController@createInfo')->middleware(
            'permission:tag-create'
        );
        Route::get('/update', 'TagsController@updateInfo')->middleware(
            'permission:tag-update'
        );
    });
