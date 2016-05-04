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
        <p class="h4 page-header"><b>Analysis Models for IGT</b></p>
        <p>RDMTk implements the following three most commonly used analysis models for IGT as proof of concept to be
capable of analyzing data fetched from the database on R statistical platform running on Amazon Web Service
(AWS). RDMTk implements a two step approach in analyzing data collected through experiments. In the first step,
the researcher can request to execute a specified model. Results after the computation is stored in a database as the model execution can be sometimes time consuming and results are not available immediately. These results are
made available at a later time when the computation is completed.</p>
        <p>
            To run one of these models, click on the highlighted link in the menu and select the appropriate model that needs to
be run. Currently implemented models are:
        </p>        
<br>
         <ol type="1"> 
            <li><a class="page-scroll" href="#base">Base Model</a></li>
            <li><a class="page-scroll" href="#rnd">Random Model</a></li>
            <li><a class="page-scroll" href="#evl">Expectancy Valence Learning (EVL) Model</a></li>            
        </ol>
 
<br>
<figure class="figure">       
{{ HTML::image('img/toolkit_help/expr_anlys_igt_mdl.png', 'Menu Item to access IGT analysis models', array('class' => 'panel-default figure-img img-fluid img-thumbnail center-block img-responsive')) }}       
<figcaption class="figure-caption text-center"><b>Menu Item to access IGT analysis models</b></figcaption>
</figure>
<br>
<p>Once the model is selected, all the IGT experiments are listed. The researcher has the following three options:</p>
<br>
<ol type="A"> 
    <li><p>View model results – by clicking on <b>“View”</b> button. The button is enabled only if the model result is available to
view.</p></li>
    <li><p>Download model results as a csv file – by clicking on <b>“Dwnld”</b> button. The button is enabled only if the model
result is available to download.</p></li>
    <li><p>Execute model – by clicking the <b>“Exec”</b> button, the researcher submits a job to AWS for running the specified
model on the cloud computing system. Resubmitting a job will override any results from previous runs.</p></li>
        </ol>
<br>
<section id="base" class="container content-section text-justify">
<p class="h4">Base Model Results</p>
<br>
<figure class="figure">       
{{ HTML::image('img/toolkit_help/expr_base_mdl_rslts.png', 'RDMTk Base Model Results Sample', array('class' => 'panel-default figure-img img-fluid img-thumbnail center-block img-responsive')) }}       
<figcaption class="figure-caption text-center"><b>RDMTk Base Model Results Sample</b></figcaption>
</figure>
<br>
</section>
<section id="rnd" class="container content-section text-justify">
<br>
<p class="h4">Random Model Results</p>
<br>
<figure class="figure">       
{{ HTML::image('img/toolkit_help/expr_rand_mdl_rslts.png', 'RDMTk Random Model Results Sample', array('class' => 'panel-default figure-img img-fluid img-thumbnail center-block img-responsive')) }}       
<figcaption class="figure-caption text-center"><b>RDMTk Random Model Results Sample</b></figcaption>
</figure>
<br>
</section>
<section id="evl" class="container content-section text-justify">
<br>
<p class="h4">EVL Model Results</p>
<br>
<figure class="figure">       
{{ HTML::image('img/toolkit_help/expr_evl_mdl_rslts.png', 'RDMTk EVL Model Results Sample', array('class' => 'panel-default figure-img img-fluid img-thumbnail center-block img-responsive')) }}       
<figcaption class="figure-caption text-center"><b>RDMTk EVL Model Results Sample</b></figcaption>
</figure>
<br>
</section>
<br>
 <div class="form-group page-header">            
            <a href="{{URL::to('dashboard')}}" class="btn btn-success">Cancel</a>
 </div> 
</section>
            
  
</div>
</div>


@stop



 
