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
Route::prefix('/users')
    ->namespace('Users')
    ->group(function () {
        Route::get('/', 'UsersController@index')
            ->middleware('permission:user-module')
            ->name('module-users');
        Route::post('/', 'UsersController@create')->middleware(
            'permission:user-create'
        );
        Route::put('/', 'UsersController@update')->middleware(
            'permission:user-update'
        );

        /** query ajax */
        Route::patch('/status', 'UsersController@status')->middleware(
            'permission:user-update'
        );
        Route::get('/list', 'UsersController@list')->middleware(
            'permission:user-list'
        );
        Route::get('/create', 'UsersController@createInfo')->middleware(
            'permission:user-create'
        );
        Route::get('/update', 'UsersController@updateInfo')->middleware(
            'permission:user-update'
        );
        Route::get('/{user_id}/roles', 'UsersController@roles')->middleware(
            'permission:role-assign'
        );
        Route::post('/{user_id}/assign', 'UsersController@assign')->middleware(
            'permission:role-assign'
        );
    });
