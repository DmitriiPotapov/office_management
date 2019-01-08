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
    return redirect()->route('login');
});

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::group(
    ['prefix'=>'user'], function(){
        Route::get('/showAddUser', 'UserController@showAdduser')->name('show_add_user');
        Route::post('/addnewuser', 'UserController@addnewuser')->name('add_new_user');
        Route::get('/showAllUser', 'UserController@showAlluser')->name('show_all_user');
        Route::get('/editUser/{id}', 'UserController@showeditUser')->name('show_edit_user');
        Route::get('/deleteUser/{id}', 'UserController@deleteUser')->name('delete_user');
        Route::post('/updateUser', 'UserController@updateUser')->name('update_user');
    }
);
