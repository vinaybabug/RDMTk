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
        <h1 class="page-header">Create Experiment</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="col-lg-12">
{{ Form::open(array('route' => 'experiments.store')) }}

    <div class="form-group">
            {{ Form::label('expername', 'Experiment Name:') }}
            {{ Form::text('expername', null, array('placeholder'=>'Experiment Name', 'class' => 'form-control')) }}                
    </div>
    <div class="form-group">
            {{ Form::label('expertype', 'Tool:') }}
            {{ Form::select('expertype',array('default' => 'Please select one option') + $tasks, 'default', array('class' => 'form-control')) }}
            
    </div>
    <div class="form-group">
            {{ Form::label('nooftrials', 'Number of Trials:') }}
            {{ Form::text('nooftrials', null, array('placeholder'=>'Trial#', 'class' => 'form-control')) }}
    </div>
    <div class="form-group">
            {{ Form::label('expertrial_outcome_type', 'Trial End Type:') }}
            {{ Form::select('expertrial_outcome_type', array(
                        'default' => 'Please select one option',
                        'FIXED' => 'Fixed',
                        'RANDOM' => 'Random',                               
                ), 'default', array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
            {{ Form::label('experend_conf_page_type', 'Confirmation Page Type:') }}
            {{ Form::select('experend_conf_page_type', array('default' => 'Please select one option') + $exprconfirmpg, 'default', array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
            {{ Form::label('confirmationcode', 'Confimation Code:') }}
            {{ Form::text('confirmationcode', null, array('placeholder'=>'Confimation Code', 'class' => 'form-control')) }}
    </div>
    <div class="form-group">
            {{ Form::checkbox('isCustomText','selected', false) }}
            {{ Form::label('experend_conf_customtext', 'Custom Text:') }}
            {{ Form::textarea('experend_conf_customtext', null, array('placeholder'=>'Custom Text', 'class' => 'form-control')) }}
    </div>
  
    <div class="form-group">
            {{ Form::submit('Submit', array('class' => 'btn btn-success')) }}
            <a href="{{URL::to('experiments')}}" class="btn btn-danger">Cancel</a>
            <span style="float:right">
               <h4> {{Form::checkbox('mouse_track',1 )}} Enable Mouse Tracking</h4>
            </span>

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



 
