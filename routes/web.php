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
        Route::post('/updateUser', 'UserController@updateUser');

        Route::get('/showAddUsergroup', 'UserController@showAddusergroup')->name('show_add_user_group');
        Route::post('/addnewusergroup', 'UserController@addnewusergroup')->name('add_new_user_group');
        Route::get('/showAllUsergroup', 'UserController@showAllusergroup')->name('show_all_user_group');
        Route::get('/editUsergroup/{id}', 'UserController@showeditUsergroup')->name('show_edit_user_group');
        Route::get('/deleteUsergroup/{id}', 'UserController@deleteUsergroup')->name('delete_user_group');
        Route::post('/updateUsergroup', 'UserController@updateUsergroup');

        Route::get('/showAddPermission', 'UserController@showAddPermission')->name('show_add_Permission');
        Route::post('/addnewPermission', 'UserController@addnewPermission')->name('add_new_Permission');
        Route::get('/showAllPermission', 'UserController@showAllPermission')->name('show_all_Permission');
        Route::get('/editPermission/{id}', 'UserController@showeditPermission')->name('show_edit_Permission');
        Route::get('/deletePermission/{id}', 'UserController@deletePermission')->name('delete_Permission');
        Route::post('/updatePermission', 'UserController@updatePermission');

        Route::get('/showAddrole', 'UserController@showAddrole')->name('show_add_role');
        Route::post('/addnewrole', 'UserController@addnewrole')->name('add_new_role');
        Route::get('/showAllrole', 'UserController@showAllrole')->name('show_all_role');
        Route::get('/editrole/{id}', 'UserController@showeditrole')->name('show_edit_role');
        Route::get('/deleterole/{id}', 'UserController@deleterole')->name('delete_role');
        Route::post('/updaterole', 'UserController@updaterole');

    }
);
