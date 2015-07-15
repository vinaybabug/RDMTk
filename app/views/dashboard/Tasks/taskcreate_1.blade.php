@extends('dashboard.dashboard_admin')

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
		<h1 class="page-header">Enter Some Basic Info</h1>
		<br>
		<form method="POST" action="{{URL::to('/Task/new/1')}}">
			<div class="form-group">
				<label>Enter the name of the Task:</label>
				<input type="text" class="form-control" name="task_name">
			</div>
			<br>
			<div class="form-group">
				<label>Enter the abbreviated Task name/Task id:</label>
				<input type="text" class="form-control" name="task_id">
			</div><br>
			<button type="submit" class="btn btn-info">Next</button>
		</form>
	</div>

</body>
</html>

@endsection