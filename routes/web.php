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
//sytem setting part
Route::group(
    ['prefix'=>'settings'],function(){
        Route::get('/lists/basejobstatues','SystemSetting\Lists\BasejobStatuesController@index')->name('basejobstatuses');
        Route::get('/lists/basejobstatues/create','SystemSetting\Lists\BasejobStatuesController@create')->name('basejobstatusescreate');
        Route::post('/lists/basejobstatues/createAction','SystemSetting\Lists\BasejobStatuesController@store');
        Route::get('/lists/basejobstatues/deleteAction','SystemSetting\Lists\BasejobStatuesController@destroy');
       
        Route::get('/lists/devicetypes','SystemSetting\Lists\DeviceTypeController@index')->name('devicetypes');
        Route::get('lists/devicetypes/create', 'SystemSetting\Lists\DeviceTypeController@create')->name('devicetypescreate');
        Route::post('/lists/devicetypes/createAction', 'SystemSetting\Lists\DeviceTypeController@store');
        Route::get('lists/devicetypes/deleteAction', 'SystemSetting\Lists\DeviceTypeController@destroy'); 

        Route::get('/lists/jobpriorities','SystemSetting\Lists\JobPrioritiesController@index')->name('jobpriorities');
        Route::get('/lists/jobpriorities/create', 'SystemSetting\Lists\JobPrioritiesController@create')->name('jobprioritiescreate');
        Route::post('/lists/jobpriorities/createAction','SystemSetting\Lists\JobPrioritiesController@store');
        Route::get('/lists/jobpriorities/deleteAction','SystemSetting\Lists\JobPrioritiesController@destroy');

        Route::get('lists/devicediagnosis', 'SystemSetting\Lists\DeviceDiagnosisController@index')->name('devicediagnosis');
        Route::get('/lists/devicediagnosis/create', 'SystemSetting\Lists\DeviceDiagnosisController@create')->name('devicediagnosiscreate');
        Route::post('/lists/devicediagnosis/createAction','SystemSetting\Lists\DeviceDiagnosisController@store');
        Route::get('/lists/devicediagnosis/deleteAction','SystemSetting\Lists\DeviceDiagnosisController@destroy');

        Route::get('lists/services', 'SystemSetting\Lists\ServicesController@index')->name('services');
        Route::get('/lists/services/create', 'SystemSetting\Lists\ServicesController@create')->name('servicescreate');
        Route::post('/lists/services/createAction','SystemSetting\Lists\ServicesController@store');
        Route::get('/lists/services/deleteAction','SystemSetting\Lists\ServicesController@destroy');               
    }    
);
//stock part
Route::group(
    ['prefix'=>'stock'], function(){
        Route::get('/create', 'Stock\StockController@create')->name('addstock');
    }
);