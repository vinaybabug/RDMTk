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
        <p class="h4 page-header"><b>Monitor Experiments</b></p>
        <br>
        <p>Experiment monitoring feature give real time status and progress tracker for a selected experimental design. This
tool helps a researcher to assess the number of participants that took part in the experiment(s), and also gives cues on
when to stop recording data. This tool is built based upon power analysis or power test. Traditionally, the researcher
would perform power test prior to conducting an actual experiment to determine the minimum sample size (in our
case, participants) that would give good statistical significance for desired properties. The implementation in
RDMTk is different from contemporary approaches because, in this case, the researcher would start the experiment
without any predetermined sample size. During the course of an experiment, the researcher would assess statistical
significance of the data collected so far by looking at effect size and power value. Based on these two values, it can
be determined whether to stop the experiment or continue collecting data.</p>
        <p>The experiment monitor feature can be accessed by clicking on the “Experiment Monitor” link in the menu. Upon
clicking the menu dashboard shows the screen for monitoring an experiment. It consists of two sections, where in
the first part, the researcher needs to select the experiment design and task type. Upon which, previously configured
experimental designs are listed in the third dropdown list. Selecting one of the experimental designs starts the
monitoring feature as shown in the figure below.</p>
<br>
        <figure class="figure">       
{{ HTML::image('img/toolkit_help/experiment_monitor.png', 'Form to monitor real time experimental status and progress tracker', array('class' => 'panel-default figure-img img-fluid img-thumbnail center-block img-responsive')) }}       
<figcaption class="figure-caption text-center"><b>Form to monitor real time experimental status and progress tracker</b></figcaption>
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



 
