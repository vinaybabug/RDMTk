<?php

/**
* Copyright (C) 2015  WiSe Lab, Computer Science Department, Western Michigan University
*Project Members Involved: Ajay Gupta, Aakash Gupta, Baba Shiv, Praneet Soni, Shrey Gupta and Vinay B Gavirangaswamy
*
* This program is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with this program.  If not, see <http://www.gnu.org/licenses/>
*/


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


Route::get('/helloworld', 'HomeController@showWelcome');

Route::get('/dashboard', array( 'before' => 'auth|role', 'as' =>'dashboard'));

Route::get('/dashboard_admin', array('before' => 'auth','as' =>'dashboard_admin', 'uses' =>'DashBoardController@showAdminPage'));

Route::get('/dashboard_researcher', array('before' => 'auth','as' =>'dashboard_researcher', 'uses' =>'DashBoardController@showResearcherPage'));

Route::get('/dashboard_participants', array('before' => 'auth','as' =>'dashboard_participants', 'uses' =>'DashBoardController@showParticipantsPage'));

Route::get('/exprRsltsSo', array('before' => 'auth', 'as' =>'exprRsltsSo', 'uses' =>'ExprResultsController@soExperRsltDwnldPg'));

Route::get('/registration', array('as' => 'registration', 'uses' => 'RegistrationController@showMainPage'));

Route::get('/login',array( 'as' =>'login', 'uses' =>'RegistrationController@showLoginPage'));

Route::get('/Task/new/first',array('before'=> 'auth', 'uses'=>'RDMTaskController@showFirst'));

Route::get('/Task/new/second',array('before'=> 'auth', 'uses'=>'RDMTaskController@showSecond'));

Route::get('/Task/new/third',array('before'=> 'auth','uses'=>'RDMTaskController@showThird'));

Route::get('/dashboard/profile',array('before' => 'auth','as' => 'dashboard/profile', 'uses' => 'DashBoardController@profile'));

Route::get('/dashboard/participants/profile',array('before' => 'auth','as' => 'dashboard/participants/profile', 'uses' => 'DashBoardController@profileParticipants'));

Route::get('/resetPassword', 'RegistrationController@showForgotPasswordPage');

Route::get('/logout', array('before' => 'auth','as' => 'logout', 'uses' => 'DashBoardController@logout'));

Route::get('dropdowns/exprs/{id}', 'ExprResultsController@getExprids');

Route::get('participants/exprs/show/{id}', 'RDMExprController@showParticipants');

Route::get('/experiments/db/DelayD/{id} ',array('before'=>'auth','uses'=>'DelayDdbController@show'));

Route::get('/experiments/db/DelayD/new',array('as'=>'DelayD/new','uses'=>'DelayDdbController@create'));

Route::get('/monitor/select',array('uses'=>'MonitoringDashboardController@select','before'=>'auth'));

/**
 * post related routes
 */

Route::post('/login',array('as' => 'login', 'uses' => 'SessionsController@store'));

Route::post('/resetPassword',array('as' => 'resetPassword', 'uses' => 'RDMUserController@resetPassword'));

Route::post('/registration',array('as' => 'registration', 'uses' => 'RDMUserController@storeRegistration'));

Route::post('/expr/rslts/download',array('as' => '/expr/rslts/download', 'uses' => 'ExprResultsController@experRsltDwnld'));

Route::post('/expr/rslts/bart/store',array('as' => '/expr/rslts/bart/store', 'uses' => 'ExprResultsController@storeBart'));

Route::post('/experiments/db/DelayD/edit',array('as'=>'DelayD/edit','uses'=>'DelayDdbController@edit'));

Route::post('/experiments/db/DelayD/update',array('as'=>'DelayD/update','uses'=>'DelayDdbController@update'));

Route::post('/experiments/db/DelayD/delete',array('as'=>'DelayD/delete','uses'=>'DelayDdbController@destroy'));

Route::post('/experiments/db/DelayD/create',array('as'=>'DelayD/create','uses'=>'DelayDdbController@store'));

Route::post('/experiments/db/DelayD/random',array('as'=>'DelayD/random','uses'=>'DelayDdbController@randomize'));

Route::post('/Task/new/first',array('before'=> 'auth','uses'=>'RDMTaskController@validateFirst'));

Route::post('/Task/new/second',array('before'=> 'auth','uses'=>'RDMTaskController@validateSecond'));

Route::post('/Task/new/third',array('before'=> 'auth','uses'=>'RDMTaskController@validateThird'));

Route::post('/track/store',array('uses'=>'MouseTracker@store'));

/*
 * Resource routes
 */

Route::resource('users', 'RDMUserController');

Route::resource('experiments', 'RDMExprController');