@extends('layouts.dashboard_master')
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

@section('dropdowns') 

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li>                            
                            <a href="{{URL::to('dashboard/participants/profile')}}"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="{{URL::to('logout')}}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>

@stop


@section('side-menu') 
                       
                        <li>
                            <a href="#"><i class="fa fa-files-o fa-fw"></i> Tasks<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                 @foreach ($tasks as $task)
                                <li>
                                    <a href="{{ URL::to('/participants/exprs/show', array('id'=>$task->id))}}">{{ $task->taskname }}</a>
                                </li>                           
                                 @endforeach
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>                       
                        
                       
@stop

@section('page-content') 
    <div class="col-lg-12">
        <h1 class="page-header">Welcome</h1>
            <p><h4>RDMTk toolkit used for studying risky decision making. It is developed as a highly extensible web based open source framework. 
            It will include a range of easy to use functionalities for managing experiments, ers and data collection.
             RDMTk will support a good number of tasks used to study different aspects of decision making.</h4>
        <p><h4>It provides a free environment to conduct experiment’s globally and hence fosters collaboration.</h4></p>
        

    </div>
@stop



 
