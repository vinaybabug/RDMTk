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
				<li role="presentation"><a href=""class="bg-primary"><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>&nbsp;Step2</a></li>
				<li role="presentation" class="active"><a href="{{URL::to('Task/new/third')}}">Step3</a></li>
			</ul>
		</div>
		<h3 class="page-header">Upload configuration file</h3>
		<br>
		<form method="POST" enctype="multipart/form-data" action="{{URL::to('Task/new/third')}}">
		<div class="form-group">
			<label> Task's configuration file</label>
			<br>
			<input type="file" name="task_xml">
                        <p class="help-block">Upload a .xml file named <b>config.xml</b> which will be used to configure task's database, user interface etc.</p>
			</div>
			<br><br>
			<button type="submit" class="btn btn-info">Finish</button>
			
			<button type="button" class="btn btn-success" data-toggle="modal" data-target="#configModal" style="float:right">
				Check out the config file's structure&hellip;
			</button>&nbsp;&nbsp;
			<a type="button" class="btn btn-primary" target="_blank" href="http://{{$_SERVER['SERVER_NAME']}}/{{$addr[1]}}/public/sample/config.xml" download="config.xml" style="float:right;position:block;margin-right:10px">Download The sample config file</a>
			<br><br><br>
			<div class="alert alert-info" role="alert">
				 <strong>Note:</strong> <ul><li>The config.xml only allows you to create new table. It doesn't allow initialisation of table with
				 any data.</li>
				 <li>The table name may only contain letters, numbers, dashes and without any white spaces.</li>
				</ul>
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