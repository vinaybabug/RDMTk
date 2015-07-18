@extends('layouts.login_registration_master')
<!--
* Copyright (C) 2015  WiSe Lab, Computer Science Department, Western Michigan University
* Project Members Involved: Ajay Gupta, Aakash Gupta, Baba Shiv, Praneet Soni, Shrey Gupta and Vinay B Gavirangaswamy
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
-->

@section('content')

 <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        
                        @if (Session::has('flash_error'))
                        <div id="flash_error" class="alert alert-danger">{{ Session::get('flash_error') }}</div>
                        @endif
                        
                        {{Form::open(array('route' => 'login', 'method'=>'POST')) }}
                        <fieldset>
                        
                            <div class="form-group">
                                {{ Form::text('username', null, array('class'=>'form-control input-sm','placeholder'=>'User Name')) }}
                            </div>
                        
                        
                            <div class="form-group">
                                {{ Form::password('password', array('class'=>'form-control input-sm','placeholder'=>'Password')) }}
                            </div>            
                        
                        <div class="row">            
                            <div class="col-xs-6">
                                {{ Form::checkbox('remember', 'Remember Me'); echo ' Remember Me'}}     

                            </div>            
                            <div class="col-xs-6 pull-right" align="right">
                                {{ HTML::linkAction('RegistrationController@showForgotPasswordPage', 'Forgot Password?') }}
                            </div>
                        </div>
                        
                            {{ Form::submit('Login', array('class'=>'btn btn-lg btn-success btn-block')) }}
                        
                        
                            {{ HTML::linkAction('RegistrationController@showMainPage', 'Sign Up for new account.') }}
                        

                        {{Form::close()}}
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>

@stop