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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index');
Auth::routes();


/*
|--------------------------------------------------------------------------
| admins
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {

    Route::get('login',['uses'=>'LoginController@showLoginForm' ,'as'=>'admin.login']);
    Route::post('login', ['uses'=>'LoginController@login' ,'as'=>'admin.login']);
    Route::post('logout', 'LoginController@logout');
    Route::get('logout', ['uses'=>'LoginController@logout','as'=>'admin.logout']);

    Route::group(['middleware' => ['admin.auth', 'admin.menu','admin.permission']], function () {
        Route::get('index', ['uses' => 'IndexController@index', 'as' => 'admin.index']);

        //管理员
        Route::get('admin/list', ['uses' => 'AdminController@index', 'as' => 'admin.admin.list']);
        Route::get('admin/create', ['uses' => 'AdminController@create', 'as' => 'admin.admin.create']);
        Route::get('admin/detail/{id}', ['uses' => 'AdminController@detail', 'as' => 'admin.admin.detail']);
        Route::get('admin/update/{id}', ['uses' => 'AdminController@update', 'as' => 'admin.admin.update']);
        Route::get('admin/profile/{id}', ['uses' => 'AdminController@profile', 'as' => 'admin.admin.profile']);

        //权限管理
        Route::get('permission/list/{cid?}', ['uses' => 'PermissionController@index', 'as' => 'admin.permission.list']);
        Route::get('permission/create/{cid}', [ 'uses' => 'PermissionController@create', 'as' => 'admin.permission.create']);
        Route::get('permission/update/{id}', [ 'uses' => 'PermissionController@update', 'as' => 'admin.permission.update']);

        Route::get('role/list', ['uses' => 'RoleController@index', 'as' => 'admin.role.list']);
        Route::get('role/create', [ 'uses' => 'RoleController@create', 'as' => 'admin.role.create']);
        Route::get('role/update/{id}', [ 'uses' => 'RoleController@update', 'as' => 'admin.role.update']);
//        Route::get('permission/manage', ['as' => 'admin.permission.manage', 'uses' => 'PermissionController@index']);
//        Route::get('permission/{cid?}', ['as' => 'admin.permission.index', 'uses' => 'PermissionController@index']);

        //角色
        Route::get('admin/list', ['uses' => 'AdminController@index', 'as' => 'admin.admin.list']);
        Route::get('admin/create', ['uses' => 'AdminController@create', 'as' => 'admin.admin.create']);
        Route::get('admin/detail/{id}', ['uses' => 'AdminController@detail', 'as' => 'admin.admin.detail']);
        Route::get('admin/update/{id}', ['uses' => 'AdminController@update', 'as' => 'admin.admin.update']);
        Route::get('admin/profile/{id}', ['uses' => 'AdminController@profile', 'as' => 'admin.admin.profile']);
    });
});

/*
|--------------------------------------------------------------------------
| admins api
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'api', 'namespace' => 'Api'], function () {
    Route::group(['middleware' => 'admin.auth'], function () {
        //管理员
        Route::post('admin/index', ['uses' => 'AdminController@index', 'as' => 'api.admin.list']);
        Route::post('admin/save', ['uses' => 'AdminController@save', 'as' => 'api.admin.save']);
        Route::get('admin/delete', ['uses' => 'AdminController@delete', 'as' => 'api.admin.delete']);

        //权限管理
        Route::post('permission/index', ['uses' => 'PermissionController@index', 'as' => 'api.permission.list']);
        Route::post('permission/save', ['uses' => 'PermissionController@save', 'as' => 'api.permission.save']);
        Route::get('permission/delete', ['uses' => 'PermissionController@delete', 'as' => 'api.permission.delete']);

        //角色
        Route::post('role/index', ['uses' => 'RoleController@index', 'as' => 'api.role.list']);
        Route::post('role/save', ['uses' => 'RoleController@save', 'as' => 'api.role.save']);
        Route::get('role/delete', ['uses' => 'RoleController@delete', 'as' => 'api.role.delete']);

    });
});