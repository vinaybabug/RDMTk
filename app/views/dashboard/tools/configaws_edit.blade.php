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
        <h3 class="page-header">Edit User</h3>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="col-lg-12">
    
{{ Form::model($awsconfig, array('method' => 'PATCH', 'route' =>
 'awsconfig.update')) }}
        <div class="form-group">
            {{ Form::label('aws_instanceid', 'EC2 Instance ID:') }}
            {{ Form::text('aws_instanceid', null, array('class' => 'form-control')) }}                
        </div>
        <div class="form-group">
            {{ Form::label('aws_key', 'AWS User Account Key:') }}
            {{ Form::text('aws_key', null, array('class' => 'form-control')) }}
        </div>
            
  
        <div class="form-group">
            {{ Form::label('aws_secret', 'AWS User Account Secret:') }}
            {{ Form::text('aws_secret', null, array('class' => 'form-control')) }}
        </div>
            
        <div class="form-group">
            {{ Form::label('aws_region', 'AWS Instance\'s Region:') }}
            {{ Form::text('aws_region', null, array('class' => 'form-control')) }}
        </div>
            
      
            
        <div class="form-group">
            {{ Form::submit('Submit', array('class' => 'btn btn-success')) }}
            <a href="{{URL::to('dashboard/tools/configaws')}}" class="btn btn-danger">Cancel</a>
                      
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



 
