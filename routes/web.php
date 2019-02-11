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
        Route::get('/editUsergroup/{id}', 'UserController@showeditUsergroup')->name('editUsergroup');
        Route::get('/deleteUsergroup/{id}', 'UserController@deleteUsergroup')->name('delete_user_group');
        Route::post('/updateUsergroup', 'UserController@updateUsergroup')->name('updateUsergroup');

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

Route::group(
    ['prefix'=>'job'], function(){
        Route::get('/showAddJob/{client_id}', 'JobController@showAddJob')->name('show_add_job');
        Route::post('/addNewJob', 'JobController@addNewJob')->name('add_new_job');
        Route::get('/showAllJob', 'JobController@showAllJob')->name('show_all_job');
        Route::get('/showAllPriorityJob', 'JobController@showAllPriorityJob')->name('show_all_priority_job');
        Route::get('/showOverview', 'JobController@showOverview')->name('show_overview');
        Route::get('/editJob/{id}', 'JobController@showEditJob')->name('show_edit_job');
        Route::get('/deleteJob/{id}', 'JobController@deleteJob')->name('delete_job');
        Route::post('/updateJob', 'JobController@updateJob')->name('update_Job');
        Route::post('/sendComment', 'JobController@sendComment')->name('send_comment');
        Route::post('/updateDevice', 'JobController@updateDevice')->name('update_device');
        Route::post('/updateMedia', 'JobController@updateMedia')->name('update_media_info');
        Route::post('/addDevice', 'JobController@addDevice')->name('add_device');
        Route::post('/updateService', 'JobController@updateServcie')->name('update_service');
        Route::post('/assignJob', 'JobController@assignJob')->name('assign_job');
        Route::get('/deleteComment/{id}','JobController@deleteComment')->name('delete_comment');
        Route::get('/deleteDevice/{id}','JobController@deleteDevice')->name('delete_device');
        Route::get('/addmissionForm/{id}', 'JobController@addmissionForm')->name('admission_form');
        Route::get('/checkoutForm/{id}', 'JobController@checkoutForm')->name('checkout_form');
        Route::get('/generateInvoice/{id}', 'JobController@generateInvoice')->name('generate_invoice');
        Route::get('/generateQuote/{id}', 'JobController@generateQuote')->name('generate_quote');
        Route::get('/generateMediaReport/{id}', 'JobController@generateMediaReport')->name('generate_media_report');
        Route::get('/viewUrgent', 'JobController@viewUrgent')->name('view_urgent');
        Route::get('/viewCompleted', 'JobController@viewCompleted')->name('view_completed');
        Route::get('/viewPaymentPending', 'JobController@viewPaymentPending')->name('view_payment_pending');
        Route::get('/viewPaid', 'JobController@viewPaid')->name('view_paid');
    }
);

Route::group(
    ['prefix'=>'inventory'], function(){
        Route::get('/showAddInventory', 'InventoryController@showAddInventory')->name('show_add_inventory');
        Route::post('/addNewInventory', 'InventoryController@addNewInventory')->name('add_new_inventory');
        Route::get('/showAllInventory', 'InventoryController@showAllInventory')->name('show_all_inventory');
        Route::get('/edit/{id}', 'InventoryController@edit')->name('editInventory');
        Route::post('/updateAction', 'InventoryController@update')->name('updateInventory');
        Route::get('/deleteAction','InventoryController@destroy')->name('deleteInventory');
        Route::get('/showReleaseFrom', 'InventoryController@showReleaseFrom')->name('show_release_from_job');
        Route::get('/showInventoryUse', 'InventoryController@showInventoryUse')->name('show_inventory_use');
        Route::get('/editInventory/{id}', 'InventoryController@showEditInventory')->name('show_edit_inventory');
        Route::get('/deleteInventory/{id}', 'InventoryController@deleteInventory')->name('delete_inventory');
        Route::post('/updateInventory', 'InventoryController@updateInventory');
    }
);

//sytem setting part
Route::group(
    ['prefix'=>'settings'],function(){
        Route::get('/lists/basejobstatues','SystemSetting\Lists\BasejobStatuesController@index')->name('basejobstatuses');
        Route::get('/lists/basejobstatues/create','SystemSetting\Lists\BasejobStatuesController@create')->name('basejobstatusescreate');
        Route::post('/lists/basejobstatues/createAction','SystemSetting\Lists\BasejobStatuesController@store');
        Route::get('/lists/basejobstatues/deleteAction','SystemSetting\Lists\BasejobStatuesController@destroy');
        Route::get('/lists/basejobstatues/editJobStatus/{id}', 'SystemSetting\Lists\BasejobStatuesController@edit')->name('editJobStatus');
        Route::post('/lists/basejobstatues/updateAction', 'SystemSetting\Lists\BasejobStatuesController@update')->name('updateStatus');
       
        Route::get('/lists/devicetypes','SystemSetting\Lists\DeviceTypeController@index')->name('devicetypes');
        Route::get('lists/devicetypes/create', 'SystemSetting\Lists\DeviceTypeController@create')->name('devicetypescreate');
        Route::post('/lists/devicetypes/createAction', 'SystemSetting\Lists\DeviceTypeController@store');
        Route::get('lists/devicetypes/deleteAction', 'SystemSetting\Lists\DeviceTypeController@destroy');
        Route::get('/lists/devicetypes/edit/{id}', 'SystemSetting\Lists\DeviceTypeController@edit')->name('editDeviceType');
        Route::post('/lists/devicetypes/updateAction', 'SystemSetting\Lists\DeviceTypeController@update')->name('updateDeviceType'); 

        Route::get('/lists/jobpriorities','SystemSetting\Lists\JobPrioritiesController@index')->name('jobpriorities');
        Route::get('/lists/jobpriorities/create', 'SystemSetting\Lists\JobPrioritiesController@create')->name('jobprioritiescreate');
        Route::post('/lists/jobpriorities/createAction','SystemSetting\Lists\JobPrioritiesController@store');
        Route::get('/lists/jobpriorities/deleteAction','SystemSetting\Lists\JobPrioritiesController@destroy');
        Route::get('/lists/jobpriorityes/edit/{id}', 'SystemSetting\Lists\JobPrioritiesController@edit')->name('editJobPriority');
        Route::post('/lists/jobpriorityes/updateAction', 'SystemSetting\Lists\JobPrioritiesController@update')->name('updateJobPriority');

        Route::get('lists/devicediagnosis', 'SystemSetting\Lists\DeviceDiagnosisController@index')->name('devicediagnosis');
        Route::get('/lists/devicediagnosis/create', 'SystemSetting\Lists\DeviceDiagnosisController@create')->name('devicediagnosiscreate');
        Route::post('/lists/devicediagnosis/createAction','SystemSetting\Lists\DeviceDiagnosisController@store');
        Route::get('/lists/devicediagnosis/deleteAction','SystemSetting\Lists\DeviceDiagnosisController@destroy');
        Route::get('/lists/devicediagnosis/edit/{id}','SystemSetting\Lists\DeviceDiagnosisController@edit')->name('editDeviceDiagnosis');
        Route::post('/lists/devicediagnosis/updateAction','SystemSetting\Lists\DeviceDiagnosisController@update')->name('updateDeviceDiagnosis');

        Route::get('lists/services', 'SystemSetting\Lists\ServicesController@index')->name('services');
        Route::get('/lists/services/create', 'SystemSetting\Lists\ServicesController@create')->name('servicescreate');
        Route::post('/lists/services/createAction','SystemSetting\Lists\ServicesController@store');
        Route::get('/lists/services/deleteAction','SystemSetting\Lists\ServicesController@destroy');
        Route::get('/lists/services/edit/{id}','SystemSetting\Lists\ServicesController@edit')->name('editService');
        Route::post('/lists/services/updateAction','SystemSetting\Lists\ServicesController@update')->name('updateService');               
    }    
);
//stock part
Route::group(
    ['prefix'=>'stock'], function(){
        Route::get('/allview', 'Stock\StockController@index')->name('allstocks');
        Route::get('/create', 'Stock\StockController@create')->name('addstock');
        Route::post('/createAction', 'Stock\StockController@store')->name('createstock');
        Route::get('/resetAction', 'Stock\StockController@reset');
        Route::get('/deleteAction', 'Stock\StockController@destroy');
        Route::get('/edit/{id}', 'Stock\StockController@edit')->name('editStock');
        Route::post('/updateAction', 'Stock\StockController@update')->name('updateStock');
    }
);
//clients part
Route::group(
    ['prefix'=>'clients'], function(){
        Route::get('/add', 'ClientsController@create')->name('addClinet');
        Route::get('/allview', 'ClientsController@index')->name('allclients');
        Route::post('/createAction', 'ClientsController@store');
        Route::get('/resetAction', 'ClientsController@reset');
        Route::get('/deleteAction', 'ClientsController@destroy');
        Route::get('/editClient/{id}', 'ClientsController@edit')->name('editClient');
        Route::post('/updateClient', 'ClientsController@update')->name('updateClient');
    }
);

//invoice part
Route::group(
    ['prefix'=>'invoice'], function(){
        Route::get('/add', 'InvoiceController@create')->name('add_invoice');
        Route::get('/allview', 'InvoiceController@index')->name('allInvoices');
        Route::post('/createAction', 'InvoiceController@store')->name('createInvoice');
        Route::post('/invoiceDetails/createjob', 'InvoiceController@storeJob')->name('createInvoiceJob');
        Route::post('/getdetailjob', 'InvoiceController@getDetailJob');
        Route::get('/resetAction', 'InvoiceController@reset');
        Route::get('/deleteAction', 'InvoiceController@destroy');
        Route::get('/edit/{id}', 'InvoiceController@edit')->name('editInvoice');
        Route::post('/updateAction', 'InvoiceController@update')->name('updateInvoice');
    }
);

//expense part
Route::group(['prefix' => 'expense'], function () {
    Route::get('/add', 'ExpenseController@create')->name('add_expense');
    Route::get('/allview', 'ExpenseController@index')->name('allExpenses');
    Route::post('/createAction', 'ExpenseController@store')->name('createExpense');
    Route::get('/deleteAction', 'ExpenseController@destroy');
    Route::get('/resetAction', 'ExpenseController@reset');
    Route::get('/edit/{id}', 'ExpenseController@edit')->name('editExpense');
    Route::post('/updateAction', 'ExpenseController@update')->name('updateExpense');
});

//quote part

Route::group(['prefix' => 'quote'], function () {
    Route::get('/add', 'QuoteController@create')->name('add_quote');
    Route::get('/allview', 'QuoteController@index')->name('allQuotes');
    Route::post('/getdetailjob', 'QuoteController@getDetailJob');
    Route::post('/createAction', 'QuoteController@store')->name('createQuote');
    Route::get('/deleteAction', 'QuoteController@destroy');
    Route::get('/resetAction', 'QuoteController@reset');
    Route::get('/editQuote/{id}', 'QuoteController@edit')->name('editQuote');
    Route::post('/updateAction', 'QuoteController@update')->name('updateQuote');
});