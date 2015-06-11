@extends('dashboard.dashboard_admin')

@section('page-content') 
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Edit Experiment Details</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="col-lg-12">
{{ Form::model($experiment, array('method' => 'PATCH', 'route' =>
 array('experiments.update', $experiment->id))) }}


    <div class="form-group">
            {{ Form::label('expername', 'Experiment Name:') }}
            {{ Form::text('expername', null, array('placeholder'=>'Experiment Name', 'class' => 'form-control')) }}                
    </div>
    <div class="form-group">
            {{ Form::label('expertype', 'Tool:') }}
            {{ Form::select('expertype',array('default' => 'Please select one option') + $tasks, null, array('class' => 'form-control')) }}
          
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
                ), null, array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
            {{ Form::label('experend_conf_page_type', 'Confirmation Page Type:') }}
            {{ Form::select('experend_conf_page_type', array('default' => 'Please select one option') + $exprconfirmpg, null, array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
            {{ Form::label('confirmationcode', 'Confimation Code:') }}
            {{ Form::text('confirmationcode', null, array('placeholder'=>'Confimation Code', 'class' => 'form-control')) }}
    </div>
    <div class="form-group">
            {{ Form::checkbox('isCustomText', 'selected') }}
            {{ Form::label('experend_conf_customtext', 'Custom Text:') }}
            {{ Form::textarea('experend_conf_customtext', null, array('placeholder'=>'Custom Text', 'class' => 'form-control')) }}
    </div>
  
    <div class="form-group">
            {{ Form::submit('Submit', array('class' => 'btn btn-success')) }}
            <a href="{{URL::to('experiments')}}" class="btn btn-danger">Cancel</a>
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



 
