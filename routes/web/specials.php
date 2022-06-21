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
    ->namespace('Specials')
    ->group(function () {
        Route::get('/', 'SpecialsController@index')
            ->middleware('permission:special-module')
            ->name('module-special');
        Route::post('/', 'SpecialsController@create')->middleware(
            'permission:special-create'
        );
        Route::put('/', 'SpecialsController@update')->middleware(
            'permission:special-update'
        );

        /** query ajax */
        Route::patch('/status', 'SpecialsController@status')->middleware(
            'permission:special-update'
        );
        Route::get('/list', 'SpecialsController@list')->middleware(
            'permission:special-list'
        );
        Route::get('/create', 'SpecialsController@createInfo')->middleware(
            'permission:special-create'
        );
        Route::get('/update', 'SpecialsController@updateInfo')->middleware(
            'permission:special-update'
        );

        // USERS
        Route::post('/users', 'SpecialUsersController@create');
        Route::get('/users/list', 'SpecialUsersController@list');
        Route::delete('/users', 'SpecialUsersController@delete');

        // ROLES
        Route::get('/roles', 'SpecialRolesController@get');

        // FILES
        Route::post('/files', 'SpecialFilesController@create');
        Route::get('/files', 'SpecialFilesController@get');
    });
