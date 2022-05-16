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
    return view('home');
});

Route::get('/historias', function () {
    return view('histories');
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
        Route::group(['prefix' => ''], function () {
            require __DIR__ . '/web/auth.php';
        });
    }
);
