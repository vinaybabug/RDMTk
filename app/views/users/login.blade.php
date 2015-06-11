@extends('layouts.login_registration_master')

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