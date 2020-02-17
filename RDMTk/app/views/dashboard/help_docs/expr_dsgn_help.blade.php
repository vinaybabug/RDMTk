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
        <p class="h4 page-header"><b>Experimental Design</b></p>
        <p>A researcher can create an experimental design before a study by selecting the highlighted “Experimental Design”
link in the menu.</p>

  <br>
<figure class="figure">       
{{ HTML::image('img/toolkit_help/experiments_menu_design.PNG', 'RDMTk Menu item for “Experimental Design”', array('class' => 'panel-default figure-img img-fluid img-thumbnail center-block img-responsive')) }}       
<figcaption class="figure-caption text-center"><b>RDMTk Menu item for “Experimental Design”</b></figcaption>
</figure>
   <br>
   <p>Upon selecting to design a study using preexisting experiments, first currently existing study designs are listed.</p>
   <br>
   
<figure class="figure">       
{{ HTML::image('img/toolkit_help/experiments_menu_design_list.PNG', 'RDMTk existing experimental design list and link to add new relations', array('class' => 'panel-default figure-img img-fluid img-thumbnail center-block img-responsive')) }}       
<figcaption class="figure-caption text-center"><b>RDMTk existing experimental design list and link to add new relations</b></figcaption>
</figure>
   <br>
   <p>Click on <i>“Create new relation”</i> to add a new experimental design. This link will give access to a form that will let
the researcher design a study.</p>
  <br>
<figure class="figure">       
{{ HTML::image('img/toolkit_help/experiments_menu_design_add.PNG', 'RDMTk Create Experimental Relationship Form', array('class' => 'panel-default figure-img img-fluid img-thumbnail center-block img-responsive')) }}       
<figcaption class="figure-caption text-center"><b>RDMTk Create Experimental Relationship Form</b></figcaption>
</figure>
   <br>
   <p>In the above form, a researcher can select either the “Between Subjects” or “Independent Measures” design.
Existing experiments are listed in group A and B list, upon selecting a particular task type. Experiments listed in
group A and B will be of the same type. For creating a “Between Subjects Design,” the experiment in “Group A”
needs to be different from the one in group B. However, to create an “Independent Measure Design” study, the
experiments in group A and B should be same.</p>
<br>
<br>
 <div class="form-group page-header">            
            <a href="{{URL::to('dashboard')}}" class="btn btn-success">Cancel</a>
 </div> 
</section>
            
  
</div>
</div>


@stop



 
