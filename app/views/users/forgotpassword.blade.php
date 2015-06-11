@extends('layouts.login_registration_master')

@section('content')

<div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Reset Password</h3>
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

                        {{Form::open(array('route' => 'resetPassword', 'method'=>'POST')) }}
                        <fieldset>
                        
                            <div class="form-group">
                                {{ Form::email('email', null, array('class'=>'form-control input-sm','placeholder'=>'Email Address')) }}
                            </div>
                        
                        
                            
                                <div class="form-group">
                                    {{ Form::password('password', array('class'=>'form-control input-sm','placeholder'=>'Password')) }}
                                </div>
                            
                            
                                <div class="form-group">
                                    {{ Form::password('password_confirmation', array('class'=>'form-control input-sm','placeholder'=>'Confirm Password')) }}
                                </div>
                            
                      

                        {{ Form::submit('Submit', array('class'=>'btn btn-lg btn-success btn-block')) }}
                        </fieldset>
                        {{Form::close()}}
                        
                    </div>
                </div>
            </div>
        </div>

@stop