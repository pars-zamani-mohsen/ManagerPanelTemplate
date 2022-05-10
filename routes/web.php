<?php

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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');
/* Clear laravel cache */
Route::get('/cc', 'UserController@clear')->name('Clear-cache');


/**
 * Manager panel
 */
Route::group(['prefix' => '/_manager', 'middleware' => 'auth'], function(){
    Route::get('/dashboard', 'DashboardController@index')->name('Dashboard');

    // Blog
/*    $model = \App\Blog::$modulename;
    Route::resource("/" . $model['en'], $model['model'] . "Controller");
    Route::get($model['en'] . "/{id}/delete", $model['model'] . "Controller@destroy")->name($model['model'] . ".destroy");
    Route::get($model['en'] . "/{id}/activation", $model['model'] . "Controller@activation")->name($model['model'] . ".activation");
    Route::get($model['en'] . "/{id}/history", $model['model'] . "Controller@getHistory")->name($model['model'] . ".history");
    Route::get($model['en'] . "/module/search", $model['model'] . "Controller@search")->name($model['model'] . ".search");*/

    // PermissionToRole
    Route::resource('/permissionToRole', 'PermissionToRoleController');
    Route::get('permissionToRole/{role_id}/{permission_id}/delete', 'PermissionToRoleController@_destroy')->name('PermissionToRole.destroy');
    Route::get('permissionToRole/create/{id}', 'PermissionToRoleController@createWithRole')->name('PermissionToRole.createWithRole');

    // Role
    $model = \App\Role::$modulename;
    Route::resource("/" . $model['en'], $model['model'] . "Controller");
    Route::get($model['en'] . "/{id}/delete", $model['model'] . "Controller@destroy")->name($model['model'] . ".destroy");
//    Route::get($model['en'] . "/{id}/activation", $model['model'] . "Controller@activation")->name($model['model'] . ".activation");
    Route::get($model['en'] . "/{id}/history", $model['model'] . "Controller@getHistory")->name($model['model'] . ".history");
    Route::get($model['en'] . "/module/search", $model['model'] . "Controller@search")->name($model['model'] . ".search");

    // Permission
    $model = \App\Permission::$modulename;
    Route::resource("/" . $model['en'], $model['model'] . "Controller");
    Route::get($model['en'] . "/{id}/delete", $model['model'] . "Controller@destroy")->name($model['model'] . ".destroy");
//    Route::get($model['en'] . "/{id}/activation", $model['model'] . "Controller@activation")->name($model['model'] . ".activation");
    Route::get($model['en'] . "/{id}/history", $model['model'] . "Controller@getHistory")->name($model['model'] . ".history");
    Route::get($model['en'] . "/module/search", $model['model'] . "Controller@search")->name($model['model'] . ".search");

    // ActivityLog
    $model = \App\ActivityLog::$modulename;
    Route::resource("/" . $model['en'], $model['model'] . "Controller");
    Route::get($model['en'] . "/{id}/delete", $model['model'] . "Controller@destroy")->name($model['model'] . ".destroy");
//    Route::get($model['en'] . "/{id}/activation", $model['model'] . "Controller@activation")->name($model['model'] . ".activation");
//    Route::get($model['en'] . "/{id}/history", $model['model'] . "Controller@getHistory")->name($model['model'] . ".history");
    Route::get($model['en'] . "/module/search", $model['model'] . "Controller@search")->name($model['model'] . ".search");

    // User
    $model = \App\User::$modulename;
    Route::resource("/" . $model['en'], $model['model'] . "Controller");
    Route::get($model['en'] . "/{id}/delete", $model['model'] . "Controller@destroy")->name($model['model'] . ".destroy");
//    Route::get($model['en'] . "/{id}/activation", $model['model'] . "Controller@activation")->name($model['model'] . ".activation");
    Route::get($model['en'] . "/{id}/history", $model['model'] . "Controller@getHistory")->name($model['model'] . ".history");
    Route::get($model['en'] . "/module/search", $model['model'] . "Controller@search")->name($model['model'] . ".search");

    // Recycle bin
    $model = \App\Recyclebin::$modulename;
    Route::get($model['en'] . "/", $model['model'] . "Controller@index")->name($model['model'] . ".index");
    Route::get($model['en'] . "/{id}", $model['model'] . "Controller@list")->name($model['model'] . ".list");
    Route::get($model['en'] . "/{model}/{id}/delete", $model['model'] . "Controller@delete")->name($model['model'] . ".destroy");
    Route::get($model['en'] . "/{model}/{id}/restore", $model['model'] . "Controller@restore")->name($model['model'] . ".restore");

});
