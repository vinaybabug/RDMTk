@extends('dashboard.dashboard_admin')

@section('page-content') 
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Edit User</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="col-lg-12">
    
{{ Form::model($user, array('method' => 'PATCH', 'route' =>
 array('users.update', $user->id))) }}
        <div class="form-group">
            {{ Form::label('first_name', 'First Name:') }}
            {{ Form::text('first_name', null, array('class' => 'form-control')) }}                
        </div>
        <div class="form-group">
            {{ Form::label('last_name', 'Last Name:') }}
            {{ Form::text('last_name', null, array('class' => 'form-control')) }}
        </div>
            
        <div class="form-group">
            {{ Form::label('role', 'Role:') }}
            {{ Form::select('role', array(
                'ADMIN' => 'Admin',
                'RDM_RESEARCHER' => 'Researcher',
                'END_USER' => 'Participants',                              
                ),null, array('class' => 'form-control')); }}
        </div>
        <div class="form-group">
            {{ Form::label('email', 'Email:') }}
            {{ Form::text('email', null, array('class' => 'form-control')) }}
        </div>
            
        <div class="form-group">
            {{ Form::label('username', 'Username:') }}
            {{ Form::text('username', null, array('class' => 'form-control')) }}
        </div>
            
        <div class="form-group">
            {{ Form::label('password', 'Password:') }}
            {{ Form::password('password', array('class' => 'form-control')) }}            
        </div>
            
        <div class="form-group">
            {{ Form::label('password', 'Confirm Password:') }}
            {{ Form::password('password_confirmation', array('class' => 'form-control')) }}            
        </div>
            
        <div class="form-group">
            {{ Form::submit('Submit', array('class' => 'btn btn-success')) }}
            <a href="{{URL::to('users')}}" class="btn btn-danger">Cancel</a>
                      
        </div>
{{ Form::close() }}

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        {{ implode('', $errors->all('<li class="error">:message</li>')) }}
    </ul>
</div>
@endif
</div>
@stop



 
