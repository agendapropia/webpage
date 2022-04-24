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

Route::prefix('/toppings')
    ->namespace('Menus\Toppings')
    ->group(function () {
        Route::get('/', 'ToppingController@index')
            ->middleware('permission:menu-topping-module')
            ->name('route-menu-toppings');
        Route::get('/list', 'ToppingController@list')->middleware(
            'permission:menu-topping-module'
        );
        Route::post('/', 'ToppingController@create')->middleware(
            'permission:menu-topping-create'
        );
        Route::put('/', 'ToppingController@update')->middleware(
            'permission:menu-topping-update'
        );

        /** query ajax */
        Route::get(
            '/creation-information',
            'ToppingController@createInformation'
        )->middleware('permission:menu-topping-create');
        Route::get(
            '/update-information',
            'ToppingController@updateInformation'
        )->middleware('permission:menu-topping-update');
        Route::patch('/status', 'ToppingController@changeStatus')->middleware(
            'permission:menu-topping-update'
        );
    });

Route::prefix('/categories')
    ->namespace('Menus\Categories')
    ->group(function () {
        Route::get('/', 'CategorieController@index')
            ->middleware('permission:menu-categorie-module')
            ->name('route-menu-categories');
        Route::get('/list', 'CategorieController@list')->middleware(
            'permission:menu-categorie-module'
        );
        Route::post('/', 'CategorieController@create')->middleware(
            'permission:menu-categorie-create'
        );
        Route::put('/', 'CategorieController@update')->middleware(
            'permission:menu-categorie-update'
        );

        /** query ajax */
        Route::get(
            '/creation-information',
            'CategorieController@createInformation'
        )->middleware('permission:menu-categorie-create');
        Route::get(
            '/update-information',
            'CategorieController@updateInformation'
        )->middleware('permission:menu-categorie-update');
        Route::patch('/status', 'CategorieController@changeStatus')->middleware(
            'permission:menu-categorie-update'
        );
    });
