@extends('dashboard.dashboard_admin')
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

@section('page-content') 

<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Create User</h3>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="col-lg-12">
{{ Form::open(array('route' => 'users.store')) }}
    <div class="form-group">
            {{ Form::label('first_name', 'First Name:') }}
            {{ Form::text('first_name', null, array('placeholder'=>'First Name', 'class' => 'form-control')) }}                
            </div>
    <div class="form-group">
            {{ Form::label('last_name', 'Last Name:') }}
            {{ Form::text('last_name', null, array('placeholder'=>'Last Name', 'class' => 'form-control')) }}
            </div>
    <div class="form-group">
            {{ Form::label('role', 'Role:') }}
            {{ Form::select('role', array(
                'ADMIN' => 'Admin',
                'RDM_RESEARCHER' => 'Researcher',
                'END_USER' => 'Participants',                              
                ), null, array('class' => 'form-control')); }}
                </div>
    <div class="form-group">
            {{ Form::label('email', 'Email:') }}
            {{ Form::text('email', null, array('placeholder'=>'Email Address', 'class' => 'form-control')) }}
            </div>
    <div class="form-group">
            {{ Form::label('username', 'Username:') }}
            {{ Form::text('username', null, array('placeholder'=>'Email Address', 'class' => 'form-control')) }}
            </div>
    <div class="form-group">
            {{ Form::label('password', 'Password:') }}
            {{ Form::password('password', array('placeholder'=>'Password', 'class' => 'form-control')) }}            
    </div>
            <div class="form-group">
            {{ Form::label('password', 'Confirm Password:') }}
            {{ Form::password('password_confirmation', array('placeholder'=>'Confirm Password', 'class' => 'form-control')) }}            
    </div>
            <div class="form-group">
            {{ Form::submit('Submit', array('class' => 'btn btn-success')) }}
            <a href="{{URL::to('users')}}" class="btn btn-danger">Cancel</a>
    </div>
{{ Form::close() }}

<!--
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        {{ implode('', $errors->all('<li class="error">:message</li>')) }}
    </ul>
</div>   
@endif    
-->
</div>
@stop



 
