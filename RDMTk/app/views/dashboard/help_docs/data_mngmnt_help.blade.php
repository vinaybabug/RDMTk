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
        <p class="h4 page-header"><b>Data Management</b></p>
        <p>Data from all the individual experiments is stored in one central database. Described next are the menu options that
give access and features to this data.</p>
<br>
      <p class="h4"><b>Download Experiment Results</b></p>   
      <br>
      <p>The current version of toolkit only supports the ability to download data as an Excel workbook. To accomplish this,
follow the steps below:</p>
      <br>
      <p><b>Step 1:</b> Navigate to the download section: Data Management->Download Result.</p>
        <br>
<figure class="figure">       
{{ HTML::image('img/toolkit_help/menu_download.PNG', 'RDMTk Download Experiment Results Menu Item', array('class' => 'panel-default figure-img img-fluid img-thumbnail center-block img-responsive')) }}       
<figcaption class="figure-caption text-center"><b>RDMTk Download Experiment Results Menu Item</b></figcaption>
</figure>
   <br>    
     <p><b>Step 2:</b> Choose the task name which was used to create the desired experiment.</p>
        <br>
        <p><b>Step 3:</b> Choose the experiment's name from the drop down list.</p>
        <br>
         <p><b>Step 4:</b> Click on download.</p>
        <br>
        <figure class="figure">       
{{ HTML::image('img/toolkit_help/Expr_Download.PNG', 'RDMTk Form to download experiment’s data', array('class' => 'panel-default figure-img img-fluid img-thumbnail center-block img-responsive')) }}       
<figcaption class="figure-caption text-center"><b>RDMTk Form to download experiment’s data</b></figcaption>
</figure>
   
<br>
<br>
<br>
 <div class="form-group page-header">            
            <a href="{{URL::to('dashboard')}}" class="btn btn-success">Cancel</a>
 </div> 
</section>
            
  
</div>
</div>


@stop



 
