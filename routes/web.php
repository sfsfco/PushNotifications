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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/notfy', 'NotfyController@index')->name('notfy');
/*
Route::group([['prefix' => 'adm','middleware' => ['admin']]), function () {
	Route::get('/','Dashboard@index')->name('dashboard');
});
*/
Route::get(env('Dashboard').'/login', 'admin\LoginController@index')->name('adminlogin');
Route::post(env('Dashboard').'/login', 'admin\LoginController@login');

Route::get('adm/setCookie','admin\LoginController@setCookie')->name('setCookie');

Route::group( ['prefix' => env('Dashboard'),  'middleware' => 'admin'], function()
{
	Route::get('/logout','admin\LoginController@logout')->name('adminlogout');
	

	Route::get('/','admin\Dashboard@index')->name('dashboard');
	
	Route::get('admins/getBasicData','admin\AdminController@getBasicData');
	Route::resource('admins','admin\AdminController');
	
	Route::get('campaigns/getBasicData','admin\CampaignController@getBasicData');
	Route::post('campaigns/getcount','admin\CampaignController@getcount');
	Route::resource('campaigns','admin\CampaignController');
	
	
	Route::resource('subscribers','admin\SubscriberController');

   
});