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
<?php  $addr= explode("/",$_SERVER['PHP_SELF'],3);
 ?>
<html>
<head>
	
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Integrate A New Task</title>
	<style>
		.row{

			padding:20px 5px 10px 5px;
		}

	</style>
</head>
<body>
	<div class="container col-lg-12">
		<div class="row">
			<ul class="nav nav-tabs">
				<li role="presentation">
					<a href="" class="bg-primary"><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>&nbsp;Step1</a></li>
				<li role="presentation" class="active"><a href="{{URL::to('Task/new/second')}}">Step2</a></li>
				<li role="presentation"><a href="">Step3</a></li>
			</ul>
		</div>
		<h3 class="page-header">Upload The Task code Files</h3>
		<br>
		<form enctype="multipart/form-data" method="POST" action="{{URL::to('Task/new/second')}}">
		<div class="form-group">
			<label> Task CodeBase Input</label>
			<br>
			<input type="file" name="task_files">
			<p class="help-block">Upload the .zip file of the all the files of the new Task. The Task files should be able to operate as a standalone application.</p>
			</div>
			<br><br>
			<button type="submit" class="btn btn-info">Next</button>
			<a type="button" class="btn btn-primary" target="_blank" href="http://{{$_SERVER['SERVER_NAME']}}/{{$addr[1]}}/public/sample/sample_task.zip" download="sample_task.zip" style="position:block;float:right;">Download The sample zip file</a>
		</form>

		<br><br>
		<div class="alert alert-warning" role="alert"><span class="glyphicon glyphicon-bell" aria-hidden="true"></span>&nbsp;
		 Kindly Make sure that the index page of your Task is a file named 'task.php'</div>
		
	</div>

</body>
</html>

@endsection