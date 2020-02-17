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
        <h3 class="page-header"><i class="fa fa-save fa-fw"></i> Download Experiment's Data</h3>
    </div> 
    <div class="col-lg-12">
    {{ Form::open(array('action' => '/expr/rslts/download')) }}

        <div class="form-group">
            {{ Form::label('taskname', 'Tool/Task Name:') }}            
            {{ Form::select('expertype',array('default' => 'Please select one option') + $tasks,'default', array('id' => 'expertype', 'class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('expername', 'Experiment Name:') }} 
            <select class="form-control" id="exprid" name="exprid" ></select>           
        </div>
        <div class="form-group">
            {{ Form::checkbox('isSummary', 'true') }}
            {{ Form::label('experend_conf_customtext', 'Summary Report') }}            
        </div>
        <div class="form-group">
            {{ Form::submit('Download', array('class' => 'btn btn-success')) }}
            <a href="{{URL::to('dashboard')}}" class="btn btn-danger">Cancel</a>
        </div>
    {{ Form::close() }}
   </div> 
    <!-- /.col-lg-12 -->
</div>
<br>
    <div class="panel panel-danger">
        <div class="panel-heading">
            <i class="fa fa-bell fa-fw"></i> Note
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body panel-danger">
            <p>Current version only supports capability to download experiment data via excel spread
            sheet. To download first select task type and then corresponding experiment.
            Future versions will support advanced reporting framework.</p>
        </div>
        <!-- /.panel-body -->
    </div>
    <!-- /.panel -->

<script type="text/javascript">
    $(document).ready(function() {
        
        
        $("#expertype").change(function() {
            
            $.getJSON("{{url('/')}}"+"/dropdowns/exprs/"+$("#expertype").val(), function(data) {
                
                var $exprid = $("#exprid");
                $exprid.empty();                
                $.each(data, function(index, itemData) {                    
                    $exprid.append('<option value="' + index +'">' + itemData + '</option>');
                });
            $("#exprid").trigger("change"); // trigger next drop down list not in the example             
            });            
        
        });
    });
</script>

@stop




