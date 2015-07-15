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
				<li role="presentation"><a href=""class="bg-primary"><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>&nbsp;Step2</a></li>
				<li role="presentation" class="active"><a href="{{URL::to('Task/new/3')}}">Step3</a></li>
			</ul>
		</div>
		<h1 class="page-header">Upload the config.xml file</h1>
		<br>
		<form method="POST" enctype="multipart/form-data" action="{{URL::to('Task/new/3')}}">
		<div class="form-group">
			<label> Task Config File</label>
			<br>
			<input type="file" name="task_xml">
			<p class="help-block">Upload the .xml file which will provide data about the tables to be created in the database, 
				which are required by Task codebase.</p>
			</div>
			<br><br>
			<button type="submit" class="btn btn-info">Finish</button>
			
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#configModal" style="float:right">
				Check out the config file's structure&hellip;
			</button>
			<br><br><br>
			<div class="alert alert-info" role="alert"><span class="glyphicon glyphicon-star" aria-hidden="true"></span>&nbsp;
				 <strong>Note:</strong> The config.xml only allows you to create new table. It doesn't allow initialisation of table with
				 any data.</div>
		
			</div>

			<div class="modal fade" id="configModal" tabindex="-1" role="dialog" >
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h3>Follow the following Tree structure when creating the config file</h3>
						</div>
						<div class="modal-body">
							<p>The config file will provide the toolkit info, about the tables that it needs to create for the new Task to be integrated.</p>

							<p>The xml file needs to adhere to the following Tree structure.</p>

							&#60;<em>tables</em>&#62;<br>
								&emsp;&#60;<em>table</em> name="table_name"&#62;<br>
								
								&emsp;&emsp;	&#60;<em>field_name</em> type="data_type"&#62;Field Name 1 &#60;<em>/field_name</em>&#62;<br>
								&emsp;&emsp;		&#60;<em>field_name</em> type="data_type"&#62; Field Name 2 &#60;<em>/field_name</em>&#62;<br>
								&emsp;&emsp;		...<br>
								&emsp;&emsp;	...<br>
								&emsp;&#60;<em>/table</em>&#62;<br>
								&emsp;&#60;<em>table</em> name="table_name"&#62;<br>
								&emsp;&emsp;	...<br>
								&emsp;&emsp;	...<br>
								&emsp;&#60;/<em>table</em>&#62;<br>
								&emsp;...<br>
								&emsp;...<br>
							&#60;<em>/tables</em>&#62;<br>
							<br><strong>Note: </strong>The data type should be strictly chosen from the following:
							<strong>'integer' , 'float' , 'string' , 'dateTime' .</strong><br>
							The script automatically creates an auto increment primary key field called 'S_no' for each new table. 




						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-success" data-dismiss="modal">Done</button>
						</div>
					</div>
				</div>
			</div>
		</form>	
	</div>

</body>
</html>

@endsection