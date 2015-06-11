<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/**
 * Get related routes
 */

Route::get('/test', function()
{
	return View::make('test');
});


Route::get('/', function()
{
	return View::make('hello');
});

Route::get('/hello', function()
{
	return "Hello World!";
});

Route::get('/helloworld', 'HomeController@showWelcome');

Route::get('/dashboard', array( 'before' => 'auth|role', 'as' =>'dashboard'));

Route::get('/dashboard_admin', array('as' =>'dashboard_admin', 'uses' =>'DashBoardController@showAdminPage'));

Route::get('/dashboard_participants', array('before' => 'auth', 'as' =>'dashboard_participants', 'uses' =>'DashBoardController@showParticipantsPage'));

Route::get('/exprRsltsSo', array('before' => 'auth', 'as' =>'exprRsltsSo', 'uses' =>'ExprResultsController@soExperRsltDwnldPg'));

Route::get('/registration', array('as' => 'registration', 'uses' => 'RegistrationController@showMainPage'));

Route::get('/login',array( 'as' =>'login', 'uses' =>'RegistrationController@showLoginPage'));

//Route::controller('/dashboard', 'DashBoardController');

Route::get('/dashboard/profile',array('before' => 'auth','as' => 'dashboard/profile', 'uses' => 'DashBoardController@profile'));

Route::get('/dashboard/participants/profile',array('before' => 'auth','as' => 'dashboard/participants/profile', 'uses' => 'DashBoardController@profileParticipants'));

Route::get('/resetPassword', 'RegistrationController@showForgotPasswordPage');

Route::get('/logout', array('before' => 'auth','as' => 'logout', 'uses' => 'DashBoardController@logout'));

Route::get('dropdowns/exprs/{id}', 'ExprResultsController@getExprids');

Route::get('participants/exprs/show/{id}', 'RDMExprController@showParticipants');


/**
 * post related routes
 */

Route::post('/login',array('as' => 'login', 'uses' => 'SessionsController@store'));

Route::post('/resetPassword',array('as' => 'resetPassword', 'uses' => 'RDMUserController@resetPassword'));

Route::post('/registration',array('as' => 'registration', 'uses' => 'RDMUserController@storeRegistration'));

Route::post('/expr/rslts/download',array('as' => '/expr/rslts/download', 'uses' => 'ExprResultsController@experRsltDwnld'));

Route::post('/expr/rslts/bart/store',array('as' => '/expr/rslts/bart/store', 'uses' => 'ExprResultsController@storeBart'));

/*
 * Resource routes
 */

Route::resource('users', 'RDMUserController');

Route::resource('experiments', 'RDMExprController');