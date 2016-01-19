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
				<li role="presentation" class="active"><a href="{{URL::to('Task/new/1')}}">Step1</a></li>
				<li role="presentation"><a href="">Step2</a></li>
				<li role="presentation"><a href="">Step3</a></li>
			</ul>
		</div>
		<h3 class="page-header">Basic Task Information</h3>
		<br>
		<form method="POST" action="{{URL::to('/Task/new/first')}}">
			<div class="form-group">
				<label>Enter a name for the task:</label>
				<input type="text" class="form-control" name="task_name">
			</div>
			<br>
			<div class="form-group">
				<label>Give an abbreviated task name/id:</label>
				<input type="text" class="form-control" name="task_id">
			</div><br>
			<button type="submit" class="btn btn-info">Next</button>
		</form>
	</div>

</body>
</html>

@endsection