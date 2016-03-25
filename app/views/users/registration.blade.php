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
                        <h3 class="panel-title">Register New Account</h3>
                    </div>
                    <div class="panel-body">
					
                        @if (Session::has('message'))
                        <div class="flash alert alert alert-danger">
                            <p>{{ Session::get('message') }}</p>
                            @if ($errors->any())
                            <ul>
                                {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                            </ul>
                            @endif
                        </div>
                        @endif

                        {{Form::open(array('route' => 'registration', 'method'=>'POST')) }}
                        <fieldset>
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    {{ Form::text('first_name', null, array('class'=>'form-control input-sm','placeholder'=>'First Name')) }}                
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    {{ Form::text('last_name', null, array('class'=>'form-control input-sm','placeholder'=>'Last Name')) }}                
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::email('email', null, array('class'=>'form-control input-sm','placeholder'=>'Email Address')) }}
                        </div>
                                              

                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    {{ Form::password('password', array('class'=>'form-control input-sm','placeholder'=>'Password')) }}
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    {{ Form::password('password_confirmation', array('class'=>'form-control input-sm','placeholder'=>'Confirm Password')) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">            
                            <div class="col-xs-6">                                
                                {{ Form::checkbox('role', 'RDM_RESEARCHER'); echo ' Researcher account'}}     
                            </div> 
                        </div>
                        {{ Form::submit('Register', array('class'=>'btn btn-lg btn-success btn-block')) }}
                         </fieldset>
                        {{Form::close()}}
                        <br>
                         <div class="alert alert-warning" role="alert" style="padding:4px;margin:0px;"><h5><span class="glyphicon glyphicon-bell" aria-hidden="true"></span>&nbsp;
                        Please Note that your email will be used as the Username for Sign in.</h5></div>
						
                    </div>
                </div>
            </div>
        </div>

@stop