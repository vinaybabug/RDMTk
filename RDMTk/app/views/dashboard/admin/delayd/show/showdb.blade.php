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
		<br>
		<div class="alert alert-info" role="alert"><span class="glyphicon glyphicon-bell" aria-hidden="true"></span>&nbsp;
		     	You can only edit or delete those questions which have been added by you. DEFAULT questions cannot be modified.</div>
	  	<div class="panel panel-default" style="margin-top:30px;">
	  		
	  		
	  		<table class="table table-responsive table-hover">
				
				<tr class="row active lead text-center">
					<td class="col-md-2">#</td>
					<td class="col-md-2">Choice A</td>
					<td class="col-md-2">Choise B</td>
                    <td class="col-md-2">Dataset</td>
					<td class="col-md-2"></td>
					<td class="col-md-2"></td>
				</tr>
						
					
					@for($i=0;$i<$result->count();$i++)
						<tr class='row text-center'>
						<td class='col-md-2'>{{$i+1}}</td>
						<td class='col-md-2'>{{$result[$i]['option_a']}}</td>
						<td class='col-md-2'>{{$result[$i]['option_b']}}</td>
						<td class='col-md-2'>{{$result[$i]['dataset_name']}}</td>
						@if($result[$i]['dataset_name']=="DEFAULT")
						<script type="text/javascript">
						$(document).ready(function(){
						$("input#edit_{{$i}}").attr("disabled","disabled");
						$("input#delete_{{$i}}").attr("disabled","disabled");
						});
						</script>
						@endif
						<td class='col-md-2'><form action='{{route("DelayD/edit",array($expr_id))}}' method='POST'><input type="hidden" name="id" value={{ $result[$i]['id'] }}><input type='submit' class='btn btn-primary' value='Edit' style='width:100px;' id ="edit_{{$i}}"></form></td>
						<td class='col-md-2'><form action='{{route("DelayD/delete",array($expr_id))}}' method='POST'><input type='hidden' name='id' value={{$result[$i]['id']}}><input type='submit' class='btn btn-danger' value='Delete' style='width:100px;' id ="delete_{{$i}}"></form></td>
						</tr>
						
					@endfor
				
			</table>
	   	</div>
	   	<div class="well well-sm">
                               
	   			{{ link_to_route('experiments.edit', 'Cancel', array($expr_id), array('class' => 'btn btn-danger', 'style'=>'display:inline;float:right;')) }}
                                <a style="display:inline;float:right;"> &nbsp; </a>
	   			<a role="button" class="btn btn-info" style="display:inline;float:right;" href="{{route('DelayD/new',array($expr_id))}}"> Add a new entry</a>
                                <a style="display:inline;float:right;"> &nbsp; </a>	   			
	   			{{ $result->links() }}
	   	</div>
	   	
	</div>  
</body>
</html>
@endsection