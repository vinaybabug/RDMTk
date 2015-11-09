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
        <h1 class="page-header">Select the Experiment to Monitor</h1>
    </div>
</div>
<div class="row">
	<div class="col-lg-12">
		<form action="{{route('generate')}}" method="POST">
			<div class="form-group">
				<label for="select">Select the Tool:</label>
				<select class="form-control" id="exptype" name="exptype">
					<option value="">Select One of the Options</option>
					@foreach(array_keys($tasks) as $key)
						<option value="{{$key}}">{{tasks[$key]}}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label for="select">Select the experiment:</label>
				<select class="form-control" id ="expid" name="expid">					
				</select>
			</div>
			<div class="form-group">
				<label for="select">Select the Userid:</label>
				<select class="form-control" id ="userid" name="userid">
				</select>
			</div>
			<br><br>
			
			<input type="submit" class="btn btn-success" id="submit">

		</form>
	</div>
</div>


<script type="text/javascript">
	$(document).ready(function(){

			$("#exptype").change(function(){

				$.getJSON("{{url('/')}}"+"dropdwns/expid/track/"+$("#exptype").val(),function(data){

					var exp = $("#expid");
					exp.empty();
					exp.append('<option value="">Select one of the options</option>');
					$.each(data,function(index,itemData){
						exp.append('<option value="'+index+'">'+itemData+'</option>' );
					});
					exp.trigger("change");
				});

			});

			$("#expid").change(function(){
				
				$.getJSON("{{url('/')}}"+"dropdwns/userid/track/"+$("#expid").val(),function(data){

					var exp = $("#userid");
					exp.empty();
					exp.append('<option value="">Select one of the options</option>');
					$.each(data,function(index,itemData){
						exp.append('<option value="'+itemData+'">'+itemData+'</option>' );
					});
					exp.trigger("change");
				});

			});

	});
</script>
@stop