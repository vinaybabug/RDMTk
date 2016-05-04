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
        <p class="h4 page-header"><b>Experiments</b></p>
        <p>Inside RDMTk, experiment is a generic term that is used to describe an instance that enables researchers to collect
data from participants for a particular task. A task can be one among BART, CUPS, IGT, etc. Each experiment can
be configured to suit individual necessities. Basic CRUD (create, read, update, delete) operations can be performed
on experiments as described below.</p>
        <ul>
            <li><a class="page-scroll" href="#create">Creating Experiments</a></li>
            <li><a class="page-scroll" href="#view">View Experiments</a></li>
            <li><a class="page-scroll" href="#so">Show Experiments</a></li>
            <li><a class="page-scroll" href="#edit">Edit Experiments</a></li>
            <li><a class="page-scroll" href="#delete">Delete Experiments</a></li>
        </ul>
    </section>

<section id="create" class="container content-section text-justify">
<br>
       <p class="h4"><b>Creating Experiments</b></p> 
<br>
<p><b><i>Step 1:</i></b> Navigate to Experiments menu.</p>
<p>Click on the Experiments tab in the left side menu panel.</p>
<br>
<figure class="figure">       
{{ HTML::image('img/toolkit_help/experiments_menu.PNG', 'RDMTk menu item “Experiments”', array('class' => 'panel-default figure-img img-fluid img-thumbnail center-block img-responsive')) }}       
<figcaption class="figure-caption text-center"><b>RDMTk menu item “Experiments”</b></figcaption>
</figure>
   <br>
<br>
<p><b><i>Step 2:</i></b> Click on Add Experiment.</p>

<br>
<figure class="figure">       
{{ HTML::image('img/toolkit_help/experiments_menu_add.PNG', 'RDMTk Menu item: Experiments->Add Experiment', array('class' => 'panel-default figure-img img-fluid img-thumbnail center-block img-responsive')) }}       
<figcaption class="figure-caption text-center"><b>RDMTk Menu item: Experiments->Add Experiment</b></figcaption>
</figure>
   <br>    
<br>
<p><b><i>Step 3:</i></b> Fill in the form fields to create an RDMTk experiment for your study.</p>

<br>
<figure class="figure">       
{{ HTML::image('img/toolkit_help/Expr_Create.PNG', 'RDMTk Create Experiment Form', array('class' => 'panel-default figure-img img-fluid img-thumbnail center-block img-responsive')) }}       
<figcaption class="figure-caption text-center"><b>RDMTk Create Experiment Form</b></figcaption>
</figure>
   <br>  
   <p><i>Experiment Name:</i> Researcher decides a name for the experiment and the experiment will be stored in the toolkit
with this name.</p>
   <p><i>Task Name:</i> Choose a task (Balloon, IGT, etc.) from a drop-down menu.</p>
   <p><i>Number of trials:</i> The researcher selects the number of trials for the participants of the experiment being created.</p>
   <p><i>Trial Duration Type:</i> Each trial in the experiment can have a randomized outcome or predetermined. For example,
in case of BART task, balloon burst points can be randomized for each participant and trial (RANDOM) or
predetermined fixed balloon burst points across all participants (FIXED). Select the one appropriate to your needs.</p>
   <ul>
       <li><b>Random:</b> The questions would be displayed in random order.</li>
       <li><b>Fixed:</b> The questions would be displayed in the proper sequence.</li>
   </ul>
   <p><i>Confirmation Page Type:</i> Upon completion of all the trials, the participant is shown a confirmation message. This
message can be either a default message which gives participants a code for their successful participation or a
customized message for that particular experiment. If the researcher is integrating an experiment with mTurk or
Qualtrics, it’s suggested they use the default option with a confirmation code.</p>
    <ul>
       <li><b>Default:</b> A default text that is displayed to the participant after the completion of the task.</li>
       <li><b>Confirmation Code:</b> It is the code that would be given to the participant after his completion of the experiment.</li>
       <li><b>Custom Text:</b> If the researcher selects Confirmation Page Type as <i>CUSTOM_TXT"</i> ,he can define the text to be
displayed in this text box.</li>
   </ul>
   <p><i>Add-On features:</i> Additional features that could be included in the experiments.</p>
   <p><i>Enable mouse tracking:</i> It is used to store the data regarding the mouse locations of the participant while going
through the experiment, which can be studied and analyzed further by the researcher.</p>
  
<br>
<p><b><i>Step 4:</i></b> Click Submit.</p>
</section>
   
<section id="view" class="container content-section text-justify">
<br>
       <p class="h4"><b>View Experiments</b></p> 
<br>   
<p>To view, edit or delete an experiment, go to Experiments->View Experiments.</p>   

<br>
<figure class="figure">       
{{ HTML::image('img/toolkit_help/Expr_List.PNG', 'RDMTk Experiments list view', array('class' => 'panel-default figure-img img-fluid img-thumbnail center-block img-responsive')) }}       
<figcaption class="figure-caption text-center"><b>RDMTk Experiments list view</b></figcaption>
</figure>
   <br> 
   <p>
       This will show you all the experiments created by the logged in user along with the options to view details, edit and
delete an experiment. Each page shows 5 experiments at a time and if there are more than five, one can browse these
experiments using navigation links.
   </p>
</section>
   
<section id="so" class="container content-section text-justify">
<br>
       <p class="h4"><b>Show Experiment</b></p> 
<br>   
<p>To see details for an existing experiment, click on the highlighted “So” button.</p>   

<br>
<figure class="figure">       
{{ HTML::image('img/toolkit_help/Expr_List_so.PNG', 'RDMTk “So” button to view experiment details', array('class' => 'panel-default figure-img img-fluid img-thumbnail center-block img-responsive')) }}       
<figcaption class="figure-caption text-center"><b>RDMTk “So” button to view experiment details</b></figcaption>
</figure>
   <br> 
   <p>
       The <b>“So”</b> button will give access to the experiment URL, which is used to integrate with mTurk and Qualtrics. It
also lists other relevant details for the experiment as shown below.
   </p>
   <br>
<figure class="figure">       
{{ HTML::image('img/toolkit_help/Expr_View.PNG', 'RDMTk form listing experiment details', array('class' => 'panel-default figure-img img-fluid img-thumbnail center-block img-responsive')) }}       
<figcaption class="figure-caption text-center"><b>RDMTk form listing experiment details</b></figcaption>
</figure>
   <br> 
</section>
   
   <section id="edit" class="container content-section text-justify">
<br>
       <p class="h4"><b>Edit Experiment</b></p> 
<br>   
<p>To edit details for an existing experiment, click on the highlighted “Ed” button corresponding to it.</p>   

<br>
<figure class="figure">       
{{ HTML::image('img/toolkit_help/Expr_List_ed.PNG', 'RDMTk “Ed” button to edit existing experiment details', array('class' => 'panel-default figure-img img-fluid img-thumbnail center-block img-responsive')) }}       
<figcaption class="figure-caption text-center"><b>RDMTk “Ed” button to edit existing experiment details</b></figcaption>
</figure>
   <br> 
   <p>
       The <b>“Ed”</b> button will pull up a form very similar to one in “create experiment”. Here, a researcher can modify
experiment parameters for an already existing experiment. It should be noted that these changes will not reflect in
the data collected for participants who already took a test.
   </p>
   <br>
<figure class="figure">       
{{ HTML::image('img/toolkit_help/Expr_Edit.PNG', 'RDMTk edit experiment details form', array('class' => 'panel-default figure-img img-fluid img-thumbnail center-block img-responsive')) }}       
<figcaption class="figure-caption text-center"><b>RDMTk edit experiment details form</b></figcaption>
</figure>
   <br> 
      <p><i>Experiment Name:</i> Researcher decides a name for the experiment and the experiment will be stored in the toolkit
with this name.</p>
   <p><i>Task Name:</i> Choose a task (Balloon, IGT, etc.) from a drop-down menu.</p>
   <p><i>Number of trials:</i> The researcher selects the number of trials for the participants of the experiment being created.</p>
   <p><i>Trial Duration Type:</i> Each trial in the experiment can have a randomized outcome or predetermined. For example,
in case of BART task, balloon burst points can be randomized for each participant and trial (RANDOM) or
predetermined fixed balloon burst points across all participants (FIXED). Select the one appropriate to your needs.</p>
   <ul>
       <li><b>Random:</b> The questions would be displayed in random order.</li>
       <li><b>Fixed:</b> The questions would be displayed in the proper sequence.</li>
   </ul>
   <p><i>Confirmation Page Type:</i> Upon completion of all the trials, the participant is shown a confirmation message. This
message can be either a default message which gives participants a code for their successful participation or a
customized message for that particular experiment. If the researcher is integrating an experiment with mTurk or
Qualtrics, it’s suggested they use the default option with a confirmation code.</p>
    <ul>
       <li><b>Default:</b> A default text that is displayed to the participant after the completion of the task.</li>
       <li><b>Confirmation Code:</b> It is the code that would be given to the participant after his completion of the experiment.</li>
       <li><b>Custom Text:</b> If the researcher selects Confirmation Page Type as <i>CUSTOM_TXT"</i> ,he can define the text to be
displayed in this text box.</li>
   </ul>
   <p><i>Add-On features:</i> Additional features that could be included in the experiments.</p>
   <p><i>Enable mouse tracking:</i> It is used to store the data regarding the mouse locations of the participant while going
through the experiment, which can be studied and analyzed further by the researcher.</p>  
<br>   
</section>
   <section id="delete" class="container content-section text-justify">
<br>
       <p class="h4"><b>Delete Experiment</b></p> 
<br>   
<p>To delete an experiment permanently, click on the highlighted <b>“Dlt”</b> button corresponding to it.</p>   

<br>
<figure class="figure">       
{{ HTML::image('img/toolkit_help/Expr_List_dlt.PNG', 'RDMTk “Dlt” button to delete an experiment', array('class' => 'panel-default figure-img img-fluid img-thumbnail center-block img-responsive')) }}       
<figcaption class="figure-caption text-center"><b>RDMTk “Dlt” button to delete an experiment</b></figcaption>
</figure>
   <br> 
   
</section>
<section class="container content-section text-justify">
<br>
 <div class="form-group page-header">            
            <a href="{{URL::to('dashboard')}}" class="btn btn-success">Cancel</a>
 </div> 
</section>
            
  
</div>
</div>


@stop



 
