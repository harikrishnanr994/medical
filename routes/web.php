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
use Illuminate\Support\Facades\Notification;
Route::view('/', 'welcome');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/registration', 'HomeController@registration')->name('registration.index');
Route::get('/forgetPassword', function () {
    return view('auth.passwords.email');
})->name('forgetPassword.email');
$this->get('logout', 'Auth\LoginController@logout')->name('auth.logout');

Auth::routes();

/////////////////////////////////////       ADMIN ROUTE          //////////////////////////////////////
Route::group( ['prefix'=>'super','middleware' => ['auth','Admin'],'namespace' =>'Admin'], function() {
    Route::resource('users', 'UserController');
    Route::resource('roles', 'RoleController');
    Route::resource('permissions','PermissionController');

    Route::post('/user/update-status', 'Admin\UserController@updateUserStatus')->name('admin.user.updateStatus');

    Route::get('/admins', 'AdminController@index')->name('admins.index');
    Route::get('/admins/create', 'AdminController@create')->name('admins.create');
    Route::post('/admins', 'AdminController@store')->name('admins.store');

});


/////////////////////////////////////       ADMIN ROUTE          //////////////////////////////////////
Route::group( ['prefix'=>'admin','middleware' => ['auth'],'namespace' =>'MAdmin'], function() {

    Route::get('/hq', 'HqController@index')->name('hq.index');
    Route::get('/hq/create', 'HqController@create')->name('hq.create');
    Route::post('/hq', 'HqController@store')->name('hq.store');
    Route::get('/hq/{id}', 'HqController@edit')->name('hq.edit');
    Route::post('/hq/{id}', 'HqController@update')->name('hq.update');
    Route::delete('/hq', 'HqController@destroy')->name('hq.destroy');

});