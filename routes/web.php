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
    return view('auth.login');
});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('addmodules','ModuleController@addmodules');
Route::POST('storemodule','ModuleController@storemodules');
Route::get('getparent/{id}','ModuleController@getparent');

Route::group(['middleware' => ['auth', 'access']], function () {

	Route::get('usermaintenance',['as'=>'usermaintenance','uses'=>'ModuleController@usermaintenance']);
	Route::get('usermaintenance/get','ModuleController@getUsers');
	Route::get('usermaintenance/{id}/edit','ModuleController@editUser');
	Route::POST('usermaintenance/{id}/store','ModuleController@storeUser');
	Route::POST('usermaintenance/{id}/storeaccess','ModuleController@storeAccessUser');

	Route::get('usermaintenance/create_new_user','ModuleController@create_new_user');
    Route::post('usermaintenance/store_user','ModuleController@store_user');
    Route::delete('usermaintenance/{id}/delete_user','ModuleController@delete_user');

	Route::get('company',['as'=>'company','uses'=>'ModuleController@company']);
	Route::get('company/newlink',['as'=>'company','uses'=>'ModuleController@test']);

	Route::get('/user_maintenance/getAccess/{user_id}', 'UsertypeController@getAccess');
	Route::get('/user_maintenance/getusertype/{usertype_id}', 'UsertypeController@getusertypeid');

	Route::get('/user_maintenanceay', 'UsertypeController@index');
	Route::post('user_maintenance/add_usertype',['as'=>'addusertype','uses'=>'UsertypeController@store']);
	Route::post('user_maintenance/add_usertypes', ['as'=>'addusertypes' ,'uses'=> 'UsertypeController@store']);
	Route::post('user_maintenance/edi_tusertypes', ['as'=>'editusertypes' ,'uses'=> 'UsertypeController@editusertypes']);
	Route::post('user_maintenance/delete_usertypes', ['as'=>'deleteusertypes' ,'uses'=> 'UsertypeController@deleteusertypes']);

	Route::get('clients/get', 'ClientController@getClients');
	Route::get('clients/{id}/view', 'ClientController@show');
	Route::get('clients/{id}/viewfamily','ClientFamilyController@viewFamily');
	Route::get('clients/{id}/viewbankaccount', 'BankAccountController@viewBank');
	Route::post('/clients/client_list', 'ClientController@client_list');
	Route::get('/clients/delete/{id}', 'ClientController@destroy');

    Route::get('/family/delete/{id}', 'ClientFamilyController@destroy');

	/*Banks*/
	Route::post('banks/getlist', 'BankController@getlist');
	Route::get('banks/get', 'BankController@getBanks');

	/*Account*/
	Route::get('accounts/get', 'AccountController@getAccounts');
	Route::get('accounts/{id}/close-account', 'AccountController@close_account');
	Route::get('accounts/{id}/deleteaccount', 'AccountController@destroy');
	Route::get('accounts/approved-loan', 'AccountController@approved_loan');
	Route::post('/accounts/store', 'AccountController@storeidentification');
	Route::post('/accounts/{id}/accountloanprocess/updatestatus', 'AccountLoanProcessController@updatestatus');
	Route::get('/accounts/{id}/accountloanprocess/payment-schedule', 'AccountLoanProcessController@payment_schedule');
    Route::get('/accounts/{id}/identification/{ident}/destroy', 'AccountIdentificationController@destroy');
	/*End Account*/

	Route::get('nationality/get','NationalityController@getNationality');
	Route::get('cities/get','CityController@getCity');
	Route::get('barangays/get','BarangayController@getBarangay');
	Route::get('clients/{id}/viewemployment','ClientEmploymentController@viewEmployment');

	/*Loan Amount*/
	Route::get('/loan_amount/getloanamount','LoanAmountController@getloanamount');
	Route::get('/loan_amount/{id}/deleteloanamount','LoanAmountController@destroy');
	Route::get('/loan_amount/{id}/deductions/{deduction_id}/view','DeductionController@viewdeductions');
	Route::patch('/loan_amount/{id}/deductions/{deduction_id}/update','DeductionController@update');
	/*End Loan Amount*/

	/*Payment*/
	Route::get('/payment/{id}/pay-loan', 'PaymentController@edit');
	Route::get('/payment/{id}/renew', 'PaymentController@renew');
	Route::get('/payment/{id}/payout', 'PaymentController@payout');
	Route::get('/payment/{id}/revert', 'PaymentController@revert');
	Route::get('/payment/{id}/pay-schedules', 'PaymentController@payment_schedules');
	Route::post('/payment/{id}/pay-loan', 'PaymentController@payment_loan');
	/*End Payment*/

	/*Cheque Management*/
	Route::post('/chequemanagement/account_numbers', 'ChequeManagementController@account_numbers');
	Route::get('/chequemanagement/get', 'ChequeManagementController@get');
	/*Add Cheque Management*/

	/*Penalties*/
	Route::get('penalties/get','PenaltyController@getPenalties');
	/*End Penalties*/

	/*Release Schedule*/
	Route::get('/accounts/{id}/releaseschedule', 'ReleaseScheduleController@PaymentSchedule');

    /*SOA */
	Route::get('soa', 'SOAController@index');
	Route::get('soa/getclient', 'SOAController@getclient');
	Route::get('soa/getaccounts', 'SOAController@getaccounts');
	Route::post('soa/generatesoa', 'SOAController@generatesoa');

    /*Industry */
    Route::get('industry/get_all', 'IndustryController@get_all');
    Route::get('industry/{id}/delete_industry', 'IndustryController@destroy');

    /*Identification List */
    Route::get('identification_list/get_all', 'IdentificationListController@get_all');

	/*Resource routes goes here*/
	Route::resource('clients', 'ClientController');
	Route::resource('clients.family', 'ClientFamilyController');
	Route::resource('clients.bank_accounts', 'BankAccountController');
	Route::resource('banks','BankController');
	Route::resource('clients.employments', 'EmploymentController');
	Route::resource('accounts', 'AccountController');
	Route::resource('accounts.property_collaterals', 'PropertyCollateralController');
	Route::resource('accounts.identification', 'AccountIdentificationController');
	Route::resource('accounts.accountloanprocess', 'AccountLoanProcessController');
	Route::resource('loan_amount','LoanAmountController');
	Route::resource('loan_amount.deductions','DeductionController');
	Route::resource('cities','CityController');
	Route::resource('nationality','NationalityController');
	Route::resource('barangays','BarangayController');
	Route::resource('identification_list','IdentificationListController');
	Route::resource('penalty','PenaltyController');
	Route::resource('payment','PaymentController');
	Route::resource('penalties','PenaltyController');
	Route::resource('chequemanagement','ChequeManagementController');
    Route::resource('industry', 'IndustryController');
	/*End resource routes*/
});



