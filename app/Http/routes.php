<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use App\User;

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');
Route::get('/home/admin', 'HomeController@showAdminHome');
Route::get('/home/admin/upgrade/{id}', 'UserController@upgradeAdmin');
Route::get('/home/admin/downgrade/{id}', 'UserController@donwgradeAdmin');
Route::post('/home/admin/addStaff', 'UserController@addStaff');
Route::post('/home/admin/updateUser', 'UserController@updateUser');
Route::post('/home/admin/saveImage', 'UserController@saveImage');
Route::post('/home/admin/updatePassword', 'UserController@updatePassword');
Route::get('/home/{id}', 'HomeController@showUserProfile');
Route::get('/home/admin/manage', function(){
	$users = User::all();
	return view('manageUsers')->with('users', $users);
});
Route::get('/home/admin/edit', 'UserController@editUser');

Route::get('/home', function(){
    return "home of regular user";
});