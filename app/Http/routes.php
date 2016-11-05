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
    Route::get('/', ['middleware' => 'guest', function () {
    	return view('welcome');
	}]);

	Route::auth();

	Route::group(['prefix'=>'home', 'middleware' => 'auth'], function () {
		Route::get('/', 'HomeController@index');
		Route::get('problem/{id}', 'ProblemController@showProblem');
		Route::get('problem/{id}/download', 'ProblemController@problemDownload');
		Route::get('problem/{id}/payment/{pyid}', 'PaymentController@problemPaymentShow');
		Route::get('myproblem/{id}', 'ProblemController@showMyProblem');
		Route::post('updateUser', 'UserController@updateUser');
		Route::post('saveImage', 'UserController@saveImage');
		Route::post('updatePassword', 'UserController@updatePassword');
		Route::get('user/{id}', 'HomeController@showUserProfile');
		Route::get('takeProblem/{id}', 'ProblemController@takeProblem');
		Route::get('assigned', 'ProblemController@assigned');
		Route::get('inbox', 'InboxController@showInbox');
		Route::get('newproblem', 'ProblemController@newProblem');
		Route::get('inbox/{id}', 'InboxController@showUsersMessages');
		Route::post('inbox/sendMessage', 'InboxController@sendMessage');
		Route::post('api/application/getusers','UserController@getApiUsers');
		Route::post('api/application/getusers2','UserController@getApiUsers2');
		Route::post('api/application/addModerator', 'ProblemController@addMate');
		Route::post('api/application/deleteWorker', 'ProblemController@deleteWorker');
		Route::get('api/application/getuserproblems', 'ProblemController@getAllProblems');
		Route::get('api/application/getuser', 'UserController@getApiUser');
		Route::post('api/application/newproblemsubmit', 'ProblemController@newproblemsubmit');
		Route::post('api/application/getproblemoffers', 'ProblemController@getproblemoffers');
		Route::post('api/application/placeOffer', 'PaymentController@placeOffer');
		Route::post('api/application/makePayment', 'PaymentController@makePayment');
		Route::get('api/application/getOneUserProblems', 'ProblemController@getOneUserProblems');
		Route::post('api/application/getProblem', 'ProblemController@getProblem');

		Route::group(['middleware' => 'admin'], function(){
			Route::get('manage', 'UserController@showManage');
			Route::get('manage/upgrade/{id}', 'UserController@upgradeAdmin');
			Route::get('manage/downgrade/{id}', 'UserController@donwgradeAdmin');
			Route::get('manage/deleteUser/{id}', 'UserController@deleteUser');
			Route::get('manage/activateUser/{id}', 'UserController@activateUser');
			Route::post('manage/addStaff', 'UserController@addStaff');
		});
		
		Route::get('edit', 'UserController@editUser');
		Route::post('uploadProblem', 'ProblemController@uploadProblem');
	});
