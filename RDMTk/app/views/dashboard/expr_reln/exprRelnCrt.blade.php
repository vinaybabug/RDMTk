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
        <h3 class="page-header">Create Experimental Relationship</h3>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="col-lg-12">
{{ Form::open(array('route' => 'exprRelns.store')) }}

     <div class="form-group">
            {{ Form::label('exprDesgType', 'Experiment design type:') }}
            {{ Form::select('exprDesgType',array('default' => 'Please select one option') + $exprDesgType, 'default', array('class' => 'form-control')) }}
            
    </div>
    <div class="form-group">
            {{ Form::label('tasktype', 'Task type:') }}
            {{ Form::select('tasktype',array('default' => 'Please select one option') + $tasks, 'default', array('class' => 'form-control')) }}
            
    </div>
    <div class="form-group">
            {{ Form::label('expername1', 'Experiment in Group A:') }} 
            <select class="form-control" id="expridA" name="expridA" ></select>           
    </div>
    <div class="form-group">
            {{ Form::label('expername2', 'Experiment in Group B:') }} 
            <select class="form-control" id="expridB" name="expridB" ></select>           
    </div>

    <br>
    <div class="form-group">
            {{ Form::submit('Submit', array('class' => 'btn btn-success')) }}
            <a href="{{URL::to('exprRelns')}}" class="btn btn-danger">Cancel</a>

    </div>
   

{{ Form::close() }}

</div>

<script type="text/javascript">
    $(document).ready(function() {
        
        
        $("#tasktype").change(function() {
            
            $.getJSON("{{url('/')}}"+"/dropdowns/exprs/"+$("#tasktype").val(), function(data) {
                
                var $exprid1 = $("#expridA");
                $exprid1.empty();                
                var $exprid2 = $("#expridB");
                $exprid2.empty();            
                $.each(data, function(index, itemData) {                    
                    $exprid1.append('<option value="' + index +'">' + itemData + '</option>');
                    $exprid2.append('<option value="' + index +'">' + itemData + '</option>');
                });
            $("#expridA").trigger("change"); // trigger next drop down list not in the example             
            $("#expridB").trigger("change"); // trigger next drop down list not in the example             
            });            
        
        });
    });
</script>

@stop



 
