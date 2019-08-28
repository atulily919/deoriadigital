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
//Auth::routes();

Route::group(['middleware' => 'disablepreventback'], function () {

	Auth::routes();
	Route::get('/home', 'HomeController@index');
});

//Route::get('home', 'HomeController@index')->name('home');

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/centralclient', 'HomeController@centralclient');
Route::get('/userprofile', 'HomeController@manageprofile');
Route::post('/userprofile/{id}', 'HomeController@updateprofile');
Route::post('/userprofileresetpassword', 'HomeController@resetpassword');

//------------------FeaturesController--------------------------------
Route::resource('/clientfeatures', 'FeaturesController');
Route::post('/editSubfeatures', 'FeaturesController@editSubfeatures');
Route::post('/showsubfeature', 'FeaturesController@showsubfeature');
Route::post('/deletefeaturerow', 'FeaturesController@deletefeaturerow');
Route::post('/showsubfeature', 'FeaturesController@showsubfeature');
Route::get('/editfeatures/{clientid}', 'FeaturesController@editfeatures');
Route::post('/updatefeatures', 'FeaturesController@updateclientfeatures');
Route::get('/ajaxeditclientfeatures/{selfet}', 'FeaturesController@ajaxeditclientfeatures');
Route::get('/editclientfeatures/{clientid}', 'FeaturesController@editclientfeatures');
Route::get('/ajaxeditclientfeatures/{selfet}', 'FeaturesController@ajaxeditclientfeatures');
//----------------AllFeaturesController-----------------------------------
Route::resource('/allfeatures', 'AllFeaturesController');
Route::post('/showallsubfeatures', 'AllFeaturesController@showallsubfeatures');
Route::get('/allfeaturesStatus/{statusid}', 'AllFeaturesController@changeStatus');
Route::post('/savesubfeatures', 'AllFeaturesController@savesubfeatures');
Route::post('/deleteallfeatures', 'AllFeaturesController@deleteallfeatures');
Route::post('/allfeaturesEdit/{id}', 'AllFeaturesController@update');

//----------------ClientController-----------------------------------------
Route::get('/editserverip/{selectedloc}', 'ClientController@editshowserver');
Route::get('/serverip/{selectedloc}', 'ClientController@showserver');
Route::get('checkclient', 'ClientController@checkclient');
Route::get('/allclients', 'ClientController@showallclients');
Route::get('/clients/create_client', 'ClientController@clientform');
Route::post('/clients/save_client', 'ClientController@saveclient');
Route::post('showserverlist', 'ClientController@showserverlist');
Route::get('/create_client', 'ClientController@clientform');
Route::post('/showservercitywise', 'ClientController@showservercitywise');
Route::post('/deleteclientrow', 'ClientController@deleteclientrow');
Route::post('/editSubservers', 'ClientController@editSubservers');
Route::get('/editclient/{clientid}', 'ClientController@editclient');
Route::post('/updateclient', 'ClientController@updateclient');

//----------------LocationServerController------------------------------------
Route::get('locationserver/bulkDelete', 'LocationServerController@bulkDelete');
Route::resource('/locationserver', 'LocationServerController');
Route::get('/validation_server_ip', 'LocationServerController@validation_server_ip');

//----------------Client Users------------------------------------------------
Route::resource('/users', 'ClientUsersController');

Route::get('importExport', 'ClientUsersController@importExport');
Route::get('downloadExcel/{type}', 'ClientUsersController@downloadExcel');
Route::post('importExcel', 'ClientUsersController@importExcel');
Route::post('/listlocationclientwise', 'ClientUsersController@listlocationclientwise');
Route::post('/listserverlocationwise', 'ClientUsersController@listserverlocationwise');
Route::get('/clientuserschangestatus/{clientuserid}', 'ClientUsersController@clientuserschangestatus');
Route::post('/reportsto', 'ClientUsersController@reportsto');
Route::post('/users/resetpassword', 'ClientUsersController@resetpassword');

//-----------------RolesController--------------------------------------------

Route::resource('/roles', 'RolesController');
Route::get('/roleschangestatus/{roleid}', 'RolesController@roleschangestatus');
Route::post('/listfeaturesclientwise', 'RolesController@listfeaturesclientwise');
Route::get('/editroles/{fetid}/{clientid}', 'RolesController@showeditroles');
Route::post('/rolesedgeserver', 'RolesController@pushrole');
Route::get('/checkduplicaterole', 'RolesController@checkduplicaterole');

//-----------------SkillGroupController--------------------------------------------
Route::resource('/skillgroup', 'SkillGroupController');
Route::get('/skillgroupUsers/{clientid}', 'SkillGroupController@showuserslist');
Route::get('/skillgroup/changestaus/{id}', 'SkillGroupController@changestatus');
Route::get('/bulkDelete/', 'SkillGroupController@bulkdelete');

//-----------------CampaignController--------------------------------------------

Route::resource('/createcampaign', 'CampaignController');
Route::get('/clientusers/{clientid}', 'CampaignController@clientusers');
Route::get('/createcampaign/changestaus/{id}', 'CampaignController@changestatus');
Route::post('/campaigncheckdate', 'CampaignController@checkenddate');
Route::get('/checkduplicatecampaign', 'CampaignController@checkduplicatecampaign');

//-----------------AssignCampaignController--------------------------------------------
Route::resource('/assigncampaign', 'AssignCampaignController');
Route::post('/skillgroupclientwise', 'AssignCampaignController@skillcampaignclientwise');
Route::get('/assigncampaignchangestatus/{id}', 'AssignCampaignController@assigncampaignchangestatus');

//---------------AssignPrivilagesController--------------------------------------------
Route::get('/privileges', 'AssignPrivilegesController@show');
Route::post('/storeassignprivileges', 'AssignPrivilegesController@store');

//---------------RegisterClientController--------------------------------------------
Route::resource('/registration', 'RegisterClientController');
Route::get('/registration/changestatus/{clientid}', 'RegisterClientController@changestatus');
Route::get('/clientroles/{clientid}', 'RegisterClientController@clientroles');
Route::get('/editclientroles/{clientid}', 'RegisterClientController@editclientroles');
Route::get('/showregister', 'Auth\RegisterController@showusers');

//-----------------PhoneBookController--------------------------------------------
Route::resource('/phonebook', 'PhoneBookController');
Route::get('/phonebookchangestatus/{pbid}', 'PhoneBookController@phonebookchangestatus');
Route::get('/downloadphonebookexcel/{pbid}', 'PhoneBookController@downloadphonebookexcel');

//-----------------CampaignQueryController--------------------------------------------
Route::resource('/campaignquery', 'CampaignQueryController');
Route::get('/clientscampign/{clientid}', 'CampaignQueryController@campaignname');
Route::post('/campaignqueryrun', 'CampaignQueryController@runquery');

//-----------------DataSynchronizationController--------------------------------------------
Route::get('/synchronization', 'DataSynchronizationController@index');
Route::post('/synchronization', 'DataSynchronizationController@index');

Route::get('/location/{clientname}', 'DataSynchronizationController@clientlocationdata');
Route::post('/syncdata', 'DataSynchronizationController@syncdata');
Route::post('prioritychange', 'DataSynchronizationController@prioritychange');
Route::post('/revertdata', 'DataSynchronizationController@revertdata');
Route::get('/synchronizationview/{id}', 'DataSynchronizationController@view');
Route::get('/synchronization/changestate', 'DataSynchronizationController@changestate');
Route::post('/changePendingStatus', 'DataSynchronizationController@changependingstatus');

//Route::post('/synchronization', 'DataSynchronizationController@index');
