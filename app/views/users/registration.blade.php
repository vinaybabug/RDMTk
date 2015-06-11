@extends('layouts.login_registration_master')

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
                                {{ Form::checkbox('role', 'ADMIN'); echo ' Admin account'}}     
                            </div> 
                        </div>
                        {{ Form::submit('Register', array('class'=>'btn btn-lg btn-success btn-block')) }}
                         </fieldset>
                        {{Form::close()}}
						
                    </div>
                </div>
            </div>
        </div>

@stop