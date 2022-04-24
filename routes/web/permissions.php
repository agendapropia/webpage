<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes Roles
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

# Roles ...
Route::prefix('roles')->group(function () {
    Route::get('/', 'Permissions\RolesController@index')
        ->middleware('permission:role-module')
        ->name('module-roles');
    Route::post(
        '/',
        'Permissions\RolesController@create'
    )->middleware('permission:role-create');
    Route::put(
        '/',
        'Permissions\RolesController@update'
    )->middleware('permission:role-update');

    # request ajax
    Route::get(
        '/list',
        'Permissions\RolesController@list'
    )->middleware('permission:role-list');
    Route::get(
        '/{role_id}/permissions',
        'Permissions\RolesController@permissions'
    )->middleware('permission:permission-assign');
    Route::post(
        '/{role_id}/assign',
        'Permissions\RolesController@assign'
    )->middleware('permission:permission-assign');
});

# Permissions ...
Route::prefix('permissions')->group(function () {
    Route::get(
        '/',
        'Permissions\PermissionsController@index'
    )->middleware('permission:permission-module')
        ->name('module-permissions');
    Route::post(
        '/',
        'Permissions\PermissionsController@create'
    )->middleware('permission:permission-create');
    Route::put(
        '/',
        'Permissions\PermissionsController@update'
    )->middleware('permission:permission-update');

    # request ajax
    Route::get(
        '/list',
        'Permissions\PermissionsController@list'
    )->middleware('permission:permission-list');
    Route::get(
        '/create',
        'Permissions\PermissionsController@getDataCreate'
    )->middleware('permission:permission-create');
});
