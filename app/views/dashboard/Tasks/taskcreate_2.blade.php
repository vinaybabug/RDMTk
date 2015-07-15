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
				<li role="presentation">
					<a href="" class="bg-primary"><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>&nbsp;Step1</a></li>
				<li role="presentation" class="active"><a href="{{URL::to('Task/new/2')}}">Step2</a></li>
				<li role="presentation"><a href="">Step3</a></li>
			</ul>
		</div>
		<h1 class="page-header">Upload The Task code Files</h1>
		<br>
		<form enctype="multipart/form-data" method="POST" action="{{URL::to('Task/new/2')}}">
		<div class="form-group">
			<label> Task CodeBase Input</label>
			<br>
			<input type="file" name="task_files">
			<p class="help-block">Upload the .zip file of the all the files of the new Task</p>
			</div>
			<br><br>
			<button type="submit" class="btn btn-info">Next</button>
		</form>
		<br><br>
		<div class="alert alert-warning" role="alert"><span class="glyphicon glyphicon-bell" aria-hidden="true"></span>&nbsp;
		 Kindly Make sure that the index page of your Task is a file named 'Task.php'</div>
		
	</div>

</body>
</html>

@endsection