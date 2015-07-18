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
	<title>Edit DelayD tabel</title>
	
    <style>
    	.pager{

    		text-align: left;
    		margin:10px 0px;
    		display:inline;
    	}
    </style>
</head>
<body>
	<div class="container-fluid">
	  	<div class="panel panel-default" style="margin-top:30px;">
	  		<table class="table table-responsive table-hover">
				
				<tr class="row active lead text-center">
					<td class="col-md-2">#</td>
					<td class="col-md-2">Choice A</td>
					<td class="col-md-2">Choise B</td>
                    <td class="col-md-2">Correct Choice</td>
					<td class="col-md-2"></td>
					<td class="col-md-2"></td>
				</tr>
						
					
					@for($i=1;$i<$result->count();$i++)
						<tr class='row text-center'>
						<td class='col-md-2'>{{$i}}</td>
						<td class='col-md-2'>{{$result[$i]['option_a']}}</td>
						<td class='col-md-2'>{{$result[$i]['option_b']}}</td>
						<td class='col-md-2'>{{$result[$i]['correct_option']}}</td>
						<td class='col-md-2'><form action='{{route("DelayD/edit")}}' method='POST'><input type="hidden" name="id" value={{ $result[$i]['id'] }}><input type='submit' class='btn btn-primary' value='Edit' style='width:100px;'></form></td>
						<td class='col-md-2'><form action='{{route("DelayD/delete")}}' method='POST'><input type='hidden' name='id' value={{$result[$i]['id']}}><input type='submit' class='btn btn-danger' value='Delete' style='width:100px;'></form></td>
						</tr>
						
					@endfor
				
			</table>
	   	</div>
	   	<div class="well well-sm">
	   			
	   			<a role="button" class="btn btn-info" style="display:inline;float:right;" href="{{route('DelayD/new')}}"> Add a new entry</a>
	   			 <form action="{{route('DelayD/random')}}" method="POST" style="display:inline;float:right;margin-right:50px">
	   			 	<span> Randomize questions..? </span>
			        <select name="formGender" role="button" class="btn btn-info">
				  		<option value="">Select...</option>
				  		<option value=1>Yes</option>
				  		<option value=0>No</option>
					</select>       
				<input class="btn btn-info" type="Submit"  value="submit"></form>
	   			{{ $result->links() }}
	   	</div>
	   	
	</div>  
</body>
</html>
@endsection