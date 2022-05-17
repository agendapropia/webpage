<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('pages.web.home');
});

Route::get('/historias', function () {
    return view('pages.web.histories');
});
Auth::routes();
Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [
        App\Http\Controllers\HomeController::class,
        'index',
    ])->name('home');
});

Route::group(
    [
        'middleware' => 'auth',
        'namespace' => 'App\Http\Controllers\Modules',
    ],
    function () {
        Route::group(['prefix' => 'admin/accounts'], function () {
            require __DIR__ . '/web/users.php';
            require __DIR__ . '/web/permissions.php';
        });
        Route::group(['prefix' => 'admin/configurations'], function () {
            require __DIR__ . '/web/regions.php';
            require __DIR__ . '/web/tags.php';
            require __DIR__ . '/web/countries.php';
        });
        
        Route::group(['prefix' => ''], function () {
            require __DIR__ . '/web/auth.php';
        });
    }
);
