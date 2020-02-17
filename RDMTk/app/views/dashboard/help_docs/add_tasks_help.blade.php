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
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
<div class="col-lg-12">

   <!-- About Section -->
    <section class="container content-section text-justify">
        <p class="h4 page-header"><b>Adding a New Task to RDMTk</b></p>
        <p>RDMTk currently supports six tasks; however this is definitely not a complete list. To enhance toolkit’s usability,
we have developed an easy to use interface that allows adding new tasks to toolkit. Adding a new task is a three step
process. This option is available only to researchers. To access this feature, click on Manage Tasks->Add a New
Task, as highlighted in red below.</p>
<br>     
<p><b><i>Step 1:</i></b> Basic task information</p>
<br>
<figure class="figure">       
{{ HTML::image('img/toolkit_help/Task_add_step1.PNG', ' Step 1 Form to add new Task to toolkit', array('class' => 'panel-default figure-img img-fluid img-thumbnail center-block img-responsive')) }}       
<figcaption class="figure-caption text-center"><b> Step 1 Form to add new Task to toolkit</b></figcaption>
</figure>
   <br>   
   <p>Enter the task name and task id. If any of them is already in use, then the user will get the message to enter different
details.</p>
   <br>
<p><b><i>Step 2:</i></b> Upload the task code files</p>
<br>
<figure class="figure">       
{{ HTML::image('img/toolkit_help/Task_add_step2.PNG', ' Step 2 Form to add new Task to toolkit', array('class' => 'panel-default figure-img img-fluid img-thumbnail center-block img-responsive')) }}       
<figcaption class="figure-caption text-center"><b> Step 2 Form to add new Task to toolkit</b></figcaption>
</figure>
<br>   
   <p>Upload the zip file that includes all of the task files to bei uploaded. A sample zip file can be downloaded for more
understanding.</p>   
   <p><b>NOTE:</b> It is required that the index page in the task is a file named 'task.php'.</p>
<br>

   <br>
<p><b><i>Step 3:</i></b> Upload the configuration file</p>
<br>
<figure class="figure">       
{{ HTML::image('img/toolkit_help/Task_add_step3.PNG', ' Step 3 Form to add new Task to toolkit', array('class' => 'panel-default figure-img img-fluid img-thumbnail center-block img-responsive')) }}       
<figcaption class="figure-caption text-center"><b> Step 3 Form to add new Task to toolkit</b></figcaption>
</figure>
   <br>   
   <p>Upload the config.xml file which is required to create a new table in the database for the task. The table
name may only contain letters, numbers, and dashes. No spaces are allowed. A sample config.xml file is also
available on the page to provide better understanding.</p>   
   <p>The xml file needs to adhere to the following tree structure:</p>   
<br>
<div class="row panel-footer">
    <p style="color:red;"><b>&lt;tables&gt;</b></p>
    <p style="color:blue;"><span style="margin-left:2em"><b>&lt;table name=<i>"table_name"</i>&gt;</b></span></p>
     <p style="color:black;"><span style="margin-left:4em"><b>&lt;field_name type="data_type"&gt; Field Name 1 &lt;/field_name&gt;</b></span></p>
     <p style="color:black;"><span style="margin-left:4em"><b>&lt;field_name type="data_type"&gt; Field Name 2 &lt;/field_name&gt;</b></span></p>
    <p style="color:black;"><span style="margin-left:4em"><b>...</b></span></p>
    <p style="color:black;"><span style="margin-left:4em"><b>...</b></span></p>
    <p style="color:blue;"><span style="margin-left:2em"><b>&lt;/table&gt;</b></span></p>
     <p style="color:blue;"><span style="margin-left:2em"><b>&lt;table name=<i>"table_name"</i>&gt;</b></span></p>
    <p style="color:black;"><span style="margin-left:4em"><b>...</b></span></p>
    <p style="color:black;"><span style="margin-left:4em"><b>...</b></span></p>
    <p style="color:blue;"><span style="margin-left:2em"><b>&lt;/table&gt;</b></span></p>
    <p style="color:black;"><span style="margin-left:2em"><b>...</b></span></p>
    <p style="color:black;"><span style="margin-left:2em"><b>...</b></span></p>
    <p style="color:red;"><b>&lt;/tables&gt;</b></p>
</div>
<br>
<p>The data types should be strictly chosen from the following: 'integer' , 'float' , 'string' , 'dateTime' . The script
automatically creates an auto increment primary key field called 'S_no' for each new table.</p>
 <div class="form-group page-header">            
            <a href="{{URL::to('dashboard')}}" class="btn btn-success">Cancel</a>
 </div> 
</section>
            
  
</div>
</div>


@stop



 
