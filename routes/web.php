<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Route::auth();
Route::get('/logout', 'Auth\LoginController@logout');
Route::group(['middleware' => ['auth']], function () {
    
    /**
     * Main
     */
        Route::get('/', 'PagesController@dashboard');
        Route::get('dashboard', 'PagesController@dashboard')->name('dashboard');
        
    /**
     * Users
     */
    Route::group(['prefix' => 'users'], function () {
        Route::get('/data', 'UsersController@anyData')->name('users.data');
        Route::get('/mdata/{id}', 'UsersController@mData')->name('users.mdata');
        Route::get('/taskdata/{id}', 'UsersController@taskData')->name('users.taskdata');
        Route::get('/leaddata/{id}', 'UsersController@leadData')->name('users.leaddata');
        Route::get('/clientdata/{id}', 'UsersController@clientData')->name('users.clientdata');
        Route::get('/users', 'UsersController@users')->name('users.users');
        Route::post('/upload/{id}', 'DocumentsController@upload');
    });
        Route::resource('users', 'UsersController');

	 /**
     * Roles
     */
        Route::resource('roles', 'RolesController');
    /**
     * Clients
     */
    Route::group(['prefix' => 'clients'], function () {
        Route::get('/data', 'ClientsController@anyData')->name('clients.data');
        Route::post('/create/cvrapi', 'ClientsController@cvrapiStart');
        Route::post('/upload/{id}', 'DocumentsController@upload');
        Route::patch('/updateassign/{id}', 'ClientsController@updateAssign');
    });
        Route::resource('clients', 'ClientsController');
	    Route::resource('documents', 'DocumentsController');
	
      
    /**
     * Tasks
     */
    Route::group(['prefix' => 'tasks'], function () {
        Route::get('/data', 'TasksController@anyData')->name('tasks.data');
        Route::patch('/updatestatus/{id}', 'TasksController@updateStatus');
        Route::patch('/updateassign/{id}', 'TasksController@updateAssign');
        Route::post('/updatetime/{id}', 'TasksController@updateTime');
    });
        Route::resource('tasks', 'TasksController');

    /**
     * Leads
     */
    Route::group(['prefix' => 'leads'], function () {
        Route::get('/data', 'LeadsController@anyData')->name('leads.data');
        Route::patch('/updateassign/{id}', 'LeadsController@updateAssign');
        Route::patch('/updatestatus/{id}', 'LeadsController@updateStatus');
        Route::patch('/updatefollowup/{id}', 'LeadsController@updateFollowup')->name('leads.followup');
    });
        Route::resource('leads', 'LeadsController');
        Route::post('/comments/{type}/{id}', 'CommentController@store');
    /**
     * Settings
     */
    Route::group(['prefix' => 'settings'], function () {
        Route::get('/', 'SettingsController@index')->name('settings.index');
        Route::patch('/permissionsUpdate', 'SettingsController@permissionsUpdate');
        Route::patch('/overall', 'SettingsController@updateOverall');
    });

    /**
     * Departments
     */
        Route::resource('departments', 'DepartmentsController');

    /**
     * Locales cuongnv
     */
    Route::resource('locales', 'LocalesController');

    /**
     * Integrations
     */
    Route::group(['prefix' => 'integrations'], function () {
        Route::get('Integration/slack', 'IntegrationsController@slack');
    });
        Route::resource('integrations', 'IntegrationsController');

    /**
     * Notifications
     */
    Route::group(['prefix' => 'notifications'], function () {
        Route::post('/markread', 'NotificationsController@markRead')->name('notification.read');
        Route::get('/markall', 'NotificationsController@markAll');
        Route::get('/{id}', 'NotificationsController@markRead');
    });

    /**
     * Invoices
     */
    Route::group(['prefix' => 'invoices'], function () {
        Route::post('/updatepayment/{id}', 'InvoicesController@updatePayment')->name('invoice.payment.date');
        Route::post('/reopenpayment/{id}', 'InvoicesController@reopenPayment')->name('invoice.payment.reopen');
        Route::post('/sentinvoice/{id}', 'InvoicesController@updateSentStatus')->name('invoice.sent');
        Route::post('/newitem/{id}', 'InvoicesController@newItem')->name('invoice.new.item');
    });
        Route::resource('invoices', 'InvoicesController');

    /**
     * Data
     */
    Route::group(['prefix' => 'data'], function () {
        Route::get('/importexportuser', ['uses' => 'DataController@importExportUser', 'as' => 'data.importexportuser'] );
        Route::post('/importuser', ['uses' => 'DataController@importUser', 'as' => 'data.importuser'] );
        Route::get('/downloaduserform/{type}', ['uses' => 'DataController@downloadUserForm', 'as' => 'data.downloaduserform'] );

        Route::get('/importexportclient', ['uses' => 'DataController@importExportClient', 'as' => 'data.importexportclient'] );
        Route::post('/importclient', ['uses' => 'DataController@importClient', 'as' => 'data.importclient'] );
        Route::get('/downloadclientform/{type}', ['uses' => 'DataController@downloadClientForm', 'as' => 'data.downloadclientform'] );

        Route::get('/importexportlocale', ['uses' => 'DataController@importExportLocale', 'as' => 'data.importexportlocale'] );
        Route::post('/importlocale', ['uses' => 'DataController@importLocale', 'as' => 'data.importlocale'] );
        Route::post('/importlocaleuser', ['uses' => 'DataController@importLocaleUser', 'as' => 'data.importlocaleuser'] );
        Route::get('/downloadlocaleform/{type}', ['uses' => 'DataController@downloadLocaleForm', 'as' => 'data.downloadlocaleform'] );
        Route::get('/downloadlocaleuserform/{type}', ['uses' => 'DataController@downloadLocaleUserForm', 'as' => 'data.downloadlocaleuserform'] );

        Route::get('/importexportrole', ['uses' => 'DataController@importExportRole', 'as' => 'data.importexportrole'] );
        Route::post('/importroleuser', ['uses' => 'DataController@importRoleUser', 'as' => 'data.importroleuser'] );
        Route::get('/downloadroleuserform/{type}', ['uses' => 'DataController@downloadRoleUserForm', 'as' => 'data.downloadroleuserform'] );

        Route::get('/importexportdepartment', ['uses' => 'DataController@importExportDepartment', 'as' => 'data.importexportdepartment'] );
        Route::post('/importdepartmentuser', ['uses' => 'DataController@importDepartmentUser', 'as' => 'data.importdepartmentuser'] );
        Route::get('/downloaddepartmentuserform/{type}', ['uses' => 'DataController@downloadDepartmentUserForm', 'as' => 'data.downloaddepartmentuserform'] );

    });
});
