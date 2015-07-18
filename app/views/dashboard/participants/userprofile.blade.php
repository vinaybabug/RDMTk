@extends('dashboard.participants.dashboard_participants')
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
        <h1 class="page-header">User Profile</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="col-lg-12">
    <div class="panel panel-info">
        <div class="panel-heading">
            
        </div>
        <div class="panel-body">
            {{ Form::model($user, array('method' => 'PATCH', 'route' => array('users.update', $user->id))) }}

            <fieldset disabled>
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
                ), null, array('class' => 'form-control')); }}
               </div>
                
                 <div class="form-group">
                        {{ Form::label('email', 'Email:') }}
                        {{ Form::text('email', null, array('class' => 'form-control')) }}
                 </div>
                
                  <div class="form-group">
                        {{ Form::label('username', 'Username:') }}
                        {{ Form::text('username', null, array('class' => 'form-control')) }}
                  </div>
                  
                  
            </fieldset>
            {{ Form::close() }}
        </div>
        <div class="panel-footer">
            <a href="{{URL::to('dashboard_participants')}}" class="btn btn-primary">Close</a>
        </div>
                
    </div>
</div>
@stop



 
