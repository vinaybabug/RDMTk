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
        <p class="h4 page-header"><b>Toolkit Dashboard</b></p>
        <p>  Dashboard has a simple user interface; it is divided into three sections: a top toolbar, left side menu items, and on the
            right side there is a main display section.</p>
<br>
   <p class="h4"><b>A quick start with the Researcher’s account</b></p>
   <p>As showing in Figure 3, a researcher account’s dashboard allows one to access advanced features to conduct
psychological experiments for RDM globally. They have advanced features compared to participants, such as access
to:</p>
        <ul>
            <li>Experiments</li>
            <li>Adding new tasks</li>
            <li>Data management</li>
            <li>Analysis Tools</li>
        </ul>
   <p>Each of these features is discussed in detail during later sections.</p>
 <br>
<figure class="figure">       
{{ HTML::image('img/toolkit_help/researcher_dashboard.PNG', 'RDMTk Researcher’s Dashboard View', array('class' => 'panel-default figure-img img-fluid img-thumbnail center-block img-responsive')) }}       
<figcaption class="figure-caption text-center"><b>Researcher’s Dashboard View</b></figcaption>
</figure>
   <br>
<p class="h4"><b>A quick start with the Participant account</b></p>
<br>
<figure class="figure">       
{{ HTML::image('img/toolkit_help/participants_dashboard.PNG', 'RDMTk Participant’s Dashboard View', array('class' => 'panel-default figure-img img-fluid img-thumbnail center-block img-responsive')) }}       
<figcaption class="figure-caption text-center"><b>RDMTk Participant’s Dashboard View</b></figcaption>
</figure>
<br>
<p>As illustrated in Figure above, a Participant account provides the user with a task list in the left navigation menu. On
clicking a task, all of its experiments are visible to the user, among which the user may choose and participate in
one. The participant can start the experiment by clicking the Start button next to the experiment name.</p>

    
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



 
