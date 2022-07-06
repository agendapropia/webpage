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
})->name('/');

Route::get('/historias', function () {
    return view('pages.web.histories');
})->name('historias');

Route::get('/articulo-interno', function () {
    return view('pages.web.internal-article');
})->name('articulo-interno');

Route::get('/integrantes', function () {
    return view('pages.web.team-work');
})->name('integrantes');

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
        Route::group(['prefix' => 'admin/specials'], function () {
            require __DIR__ . '/web/specials.php';
            require __DIR__ . '/web/special-alliedmedia.php';
            require __DIR__ . '/web/special-contents.php';
        });

        Route::group(['prefix' => ''], function () {
            require __DIR__ . '/web/auth.php';
        });
    }
);

// -------------------------------------------------------------------------------
// ---------------------------- FILES S3 AMAZON ----------------------------------
// -------------------------------------------------------------------------------
Route::group(
    [
        'namespace' => 'App\Http\Controllers\Utils',
    ],
    function () {
        Route::post(
            'uploadfiles_s3',
            'UploadS3\UploadS3Controller@upload_files'
        );
        Route::post(
            'destroyfiles_s3',
            'UploadS3\UploadS3Controller@destroy_files'
        );
        Route::get('download_s3', 'UploadS3\UploadS3Controller@getFile');
        Route::get(
            'download_s3_public',
            'UploadS3\UploadS3Controller@getFilePublic'
        );
    }
);
