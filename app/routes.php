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

 // show a static view for the home page (app/views/home.blade.php)
Route::get('/', function()
{
    return View::make('home');
});


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

Route::get('dropdowns/exprRelns/{expertype}/{expr_design_id}', 'ExprMonitorController@getExprRelns');

Route::get('dropdowns/exprReln/{expertype}/{expr_design_id}/{expr_reln_id}', 'ExprMonitorController@getExprReln');


Route::get('participants/exprs/show/{id}', 'RDMExprController@showParticipants');

Route::get('/experiments/db/DelayD/{id} ',array('before'=>'auth','uses'=>'DelayDdbController@show'));

Route::get('/experiments/db/DelayD/new/{id}',array('before' => 'auth','as'=>'DelayD/new','uses'=>'DelayDdbController@create'));

//Route::get('/monitor/select',array('uses'=>'MonitoringDashboardController@select','before'=>'auth'));

Route::get('/dashboard/tools/monitoring/monitorExpr',array('before' => 'auth','as' => '/dashboard/tools/monitoring/monitorExpr','uses'=>'ExprMonitorController@showMasterSelection'));

Route::get('/dashboard/tools/configaws',array('before' => 'auth','as' => '/dashboard/tools/configaws','uses'=>'ConfigAWSController@show'));

Route::get('/dashboard/tools/firstlook',array('before' => 'auth','as' => '/dashboard/tools/firstlook','uses'=>'AnalysisFirstLook@show'));

Route::get('/dashboard/tools/configaws/edit',array('before' => 'auth','as' => '/dashboard/tools/configaws','uses'=>'ConfigAWSController@edit'));

Route::get('/dashboard/tools/monitoring/expr/anlys/list/base/{exprType}', array('before' => 'auth','as'=>'/dashboard/tools/monitoring/expr/anlys/list/base','uses'=>'ExprAnlysController@showBaseMdlList'));

Route::get('/dashboard/tools/monitoring/expr/anlys/list/rnd/{exprType}', array('before' => 'auth','as'=>'/dashboard/tools/monitoring/expr/anlys/list/rnd','uses'=>'ExprAnlysController@showRNDMdlList'));

Route::get('/dashboard/tools/monitoring/expr/anlys/list/evl/{exprType}', array('before' => 'auth','as'=>'/dashboard/tools/monitoring/expr/anlys/list/evl','uses'=>'ExprAnlysController@showEVLMdlList'));

Route::get('/dashboard/tools/monitoring/expr/anlys/exprs/{id}', 'ExprAnlysController@getExprEnabled');

Route::get('/dashboard/tools/monitoring/expr/anlys/exprs/baseMdlView/{type}/{id}/{mdl}', 'ExprAnlysController@baseMdlView');

Route::get('/dashboard/tools/monitoring/expr/anlys/exprs/rndMdlView/{type}/{id}/{mdl}', 'ExprAnlysController@rndMdlView');

Route::get('/dashboard/tools/monitoring/expr/anlys/exprs/evlMdlView/{type}/{id}/{mdl}', 'ExprAnlysController@evlMdlView');

Route::get('/dashboard/help/intro', function()
{
    if (Auth::check())
{
    // The user is logged in...
        return View::make('dashboard.help_docs.intro_help');
}
else{
    return View::make('users.login');
}
    
});

Route::get('/dashboard/help/accts', function()
{
     if (Auth::check())
{
    // The user is logged in...
       return View::make('dashboard.help_docs.accts_help');
}
else{
    return View::make('users.login');
}
    
});

Route::get('/dashboard/help/dashboard', function()
{
     if (Auth::check())
{
    // The user is logged in...
      return View::make('dashboard.help_docs.dashboard_help');
}
else{
    return View::make('users.login');
}
    
});

Route::get('/dashboard/help/tasks', function()
{
     if (Auth::check())
{
    // The user is logged in...
      return View::make('dashboard.help_docs.tasks_help');
}
else{
    return View::make('users.login');
}
    
});

Route::get('/dashboard/help/exprs', function()
{
     if (Auth::check())
{
    // The user is logged in...
      return View::make('dashboard.help_docs.exprs_help');
}
else{
    return View::make('users.login');
}
    
});

Route::get('/dashboard/help/expr_dsgn', function()
{
     if (Auth::check())
{
    // The user is logged in...
      return View::make('dashboard.help_docs.expr_dsgn_help');
}
else{
    return View::make('users.login');
}
    
});
Route::get('/dashboard/help/data_mngmnt', function()
{
     if (Auth::check())
{
    // The user is logged in...
      return View::make('dashboard.help_docs.data_mngmnt_help');
}
else{
    return View::make('users.login');
}
    
});

Route::get('/dashboard/help/add_task', function()
{
     if (Auth::check())
{
    // The user is logged in...
      return View::make('dashboard.help_docs.add_tasks_help');
}
else{
    return View::make('users.login');
}
    
});

Route::get('/dashboard/help/expr_mntr', function()
{
     if (Auth::check())
{
    // The user is logged in...
    return View::make('dashboard.help_docs.expr_mntr_help');
}
else{
    return View::make('users.login');
}
    
});

Route::get('/dashboard/help/igt_anlys', function()
{
     if (Auth::check())
{
    // The user is logged in...
    return View::make('dashboard.help_docs.igt_anlys_help');
}
else{
    return View::make('users.login');
}
    
});

/**
 * post related routes
 */

Route::post('/login',array('as' => 'login', 'uses' => 'SessionsController@store'));

Route::post('/resetPassword',array('as' => 'resetPassword', 'uses' => 'RDMUserController@resetPassword'));

Route::post('/registration',array('as' => 'registration', 'uses' => 'RDMUserController@storeRegistration'));

Route::post('/expr/rslts/download',array('as' => '/expr/rslts/download', 'uses' => 'ExprResultsController@experRsltDwnld'));

Route::post('/expr/rslts/bart/store',array('as' => '/expr/rslts/bart/store', 'uses' => 'ExprResultsController@storeBart'));

Route::post('/experiments/db/DelayD/edit/{id}',array('as'=>'DelayD/edit','uses'=>'DelayDdbController@edit'));

Route::post('/experiments/db/DelayD/update/{id}',array('as'=>'DelayD/update','uses'=>'DelayDdbController@update'));

Route::post('/experiments/db/DelayD/delete/{id}',array('as'=>'DelayD/delete','uses'=>'DelayDdbController@destroy'));

Route::post('/experiments/db/DelayD/create/{id}',array('as'=>'DelayD/create','uses'=>'DelayDdbController@store'));

Route::post('/experiments/db/DelayD/random',array('as'=>'DelayD/random','uses'=>'DelayDdbController@randomize'));

Route::post('/Task/new/first',array('before'=> 'auth','uses'=>'RDMTaskController@validateFirst'));

Route::post('/Task/new/second',array('before'=> 'auth','uses'=>'RDMTaskController@validateSecond'));

Route::post('/Task/new/third',array('before'=> 'auth','uses'=>'RDMTaskController@validateThird'));

Route::post('/track/store',array('uses'=>'MouseTracker@store'));

Route::post('/dashboard/tools/monitoring/expr/anlys/job/submit/{id}/{type}/{model}', array('uses'=>'ExprAnlysController@submitAnlysJob'));

/*
 * Resource routes
 */

Route::resource('awsconfig', 'ConfigAWSController');

Route::resource('users', 'RDMUserController');

Route::resource('experiments', 'RDMExprController');

Route::resource('exprRelns', 'RDMExprRelnController');