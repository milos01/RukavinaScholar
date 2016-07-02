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
Route::group(['middleware' => ['web']], function () {
    Route::get('/', ['middleware' => 'guest', function () {
    	return view('welcome');
	}]);

	Route::auth();

	Route::group(['prefix'=>'home', 'middleware' => 'auth'], function () {
		Route::get('/', 'HomeController@index');
		Route::get('problem/{id}', 'ProblemController@showProblem');
		Route::get('upgrade/{id}', 'UserController@upgradeAdmin');
		Route::get('downgrade/{id}', 'UserController@donwgradeAdmin');
		Route::post('addStaff', 'UserController@addStaff');
		Route::post('updateUser', 'UserController@updateUser');
		Route::post('saveImage', 'UserController@saveImage');
		Route::post('updatePassword', 'UserController@updatePassword');
		Route::get('user/{id}', 'HomeController@showUserProfile');
		Route::get('takeProblem/{id}', 'ProblemController@takeProblem');
		Route::get('assigned', 'ProblemController@assigned');
		Route::get('inbox', 'InboxController@showInbox');
		Route::get('inbox/{id}', 'InboxController@showUsersMessages');
		Route::post('inbox/sendMessage', 'InboxController@sendMessage');
		Route::post('api/application/getusers','UserController@getApiUsers');
		Route::post('api/application/addModerator', 'ProblemController@addMate');
		Route::get('manage', function(){
			$users = User::all();
			return view('/manageUsers')->with('users', $users);
		});
		Route::get('edit', 'UserController@editUser');
	});
});
