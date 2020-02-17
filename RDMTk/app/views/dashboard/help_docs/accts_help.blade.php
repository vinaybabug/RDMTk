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
        <p class="h4 page-header"><b>RDMTk Toolkit Accounts</b></p>
                
        <p>Toolkit primarily supports 3 different types of accounts:</p>
        
        <ul>
            <li>Administrators</li>
            <li>Researchers</li>
            <li>Participants</li>
        </ul>
        
        <p>Toolkit is primarily intended for the later two, i.e. people conducting empirical experiments and participating in
            them.</p>
        <br>       
        <p class="h4"><b> Administrators</b></p>
                
<p>Administrator is the person who plays vital roles in overall operation of the RDMTk application. The Administrator
    will be the point of contact to troubleshoot problems or issues related to deployment and accessibility. </p>
<br>
<p class="h4"><b> Researchers</b></p>

<p>Toolkit categorizes researchers into two different types of audience:</p>
        <ul>
            <li>Researchers focusing on task design and development</li>
            <li>Researchers conducting empirical studies</li>            
        </ul>
<br>
<p class="h4"><b> Participants</b></p>

<p>People using the toolkit for participating in an experiment are categorized as participants. There are two interfaces
for participants to access experiments. Participants can be access the experiment via mTurk or Qualtrics or through
another online labor and data collection framework.</p>
<p>Use of one common interface to access the software makes using Toolkit simple. Figure below shows the login page,
which has a link to sign up for a new participant account as well as the login screen.</p>
<br>
<figure class="figure">
{{ HTML::image('img/toolkit_help/toolkit_signin01.PNG', 'RDMTk Login Screen', array('class' => 'panel-default figure-img img-fluid img-thumbnail center-block img-responsive')) }}
<figcaption class="figure-caption text-center"><b>RDMTk Login Screen</b></figcaption>
</figure>

<br> 
<p>A participant will have to click on the link to sign up for a new account.</p>
<br>

<figure class="figure">
{{ HTML::image('img/toolkit_help/toolkit_signin02.PNG', 'RDMTk Account Registration Page', array('class' => 'panel-default figure-img img-fluid img-thumbnail center-block img-responsive')) }}
<figcaption class="figure-caption text-center"><b>RDMTk Account Registration Page</b></figcaption>
</figure>
<br>

<p>In the account registration page, one can create an account for participating in the tasks or by checking the Research
Account check box to create a researcher’s account. Participant accounts will only allow taking tests and provide a
dashboard for them only listing available experiments that are set up. However, a researcher’s account will allow
one to manage different experiments, collect data and analyze results.</p>
<br>
<br>

 <div class="form-group page-header">            
            <a href="{{URL::to('dashboard')}}" class="btn btn-success">Cancel</a>
 </div> 
</section>
            
  
</div>
</div>


@stop



 
