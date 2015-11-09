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

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="author" content="PraneetSoni">
	<title>Edit DelayD Row</title>
</head>
<body>
	<div class="container col-md-12">
		<div class="panel panel-default" style="margin-top:30px;">
			<div class="panel-heading">
				<h3>Create a New Entry</h3>
			</div>
			<div class="panel-body">
			<form method="POST" action="{{route('DelayD/create')}}">
				<div class="form-group">
	            <h4>Choose Dataset</h4>
	            <select id="dataset" name="dataset" class="form-control">
	            	@foreach($datasets as $dataset)
	            	<option value ="{{$dataset->dataset_name}}">{{$dataset->dataset_name}}</option>
	            	@endforeach
	            	<option value = "ADD_NEW">Create a new Dataset</option>

	            </select>
    			</div>
	  			<br>
	  			<div id="new_set_text" style="display:none;">
	  				<h4>Enter the name of the new Dataset:</h4>
	  			<input type="text"  name="new_set" id="new_set" class="form-control"></input>
				</div>
				<h3>What would you prefer:
				</h3>

				
					<h3>Choice A:</h3>
					<textarea cols="100" rows="5" placeholder ="Enter question for choice A" name= "option_a"></textarea>
					<br><br>
					<h3>Choice B:</h3>
					<textarea cols="100" rows="5" placeholder = "Enter question for choice B" name= "option_b"></textarea>
					<br><br><br>
                    
					<input type="submit" class="btn btn-primary" value="Go"></input>
					<a href="{{URL::to('/experiments/db/DelayD')}}" class="btn btn-default">Cancel</a>
				</form>
				
			</div>
		</div>

	</div>
	<script type="text/javascript">

	$(document).ready(function(){

			$("#dataset").change(function(){

				if($("#dataset").val()=="ADD_NEW"){
					$("#new_set_text").css("display","block");
				}	
				});

			});
	</script>

</body>
</html>
@endsection