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
                            <a href="{{URL::to('dashboard/profile')}}"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="{{URL::to('logout')}}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>

@stop


@section('side-menu') 
                    @if(Auth::user()->role =="ADMIN")
                        <li id ="manage_users">
                            <a href="#"><i class="fa fa-users fa-fw"></i> Manage Users<span class="fa arrow"></span></a>
                             <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{action('RDMUserController@create')}}"><i class="fa fa-user fa-fw"></i> Add User</a>
                                </li>
                                <li>
                                    <a href="{{URL::to('users')}}"><i class="fa fa-user fa-fw"></i> View Users</a>
                                </li>
                                
                               <!-- <li>
                                     <a href="{{URL::to('monitor/select')}}"><i class="glyphicon glyphicon-forward"></i> Monitor Experiments</a>
                                </li>-->
                               
                            </ul>
                        </li>
                    @endif
                        <li>
                            <a href="#"><i class="fa fa-files-o fa-fw"></i> Experiments<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{action('RDMExprController@create')}}"><i class="fa fa-bars fa-fw"></i> Add Experiment</a>
                                </li>                                 
                                <li>
                                    <a href="{{URL::to('experiments')}}"><i class="fa fa-bars fa-fw"></i> View Experiments</a>
                                </li>                                          
                                 <li>
                                    <a href="{{URL::to('exprRelns')}}"><i class="fa fa-bars fa-fw"></i> Experimental Design</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>    
                                       
                        <li>
                           <a href="#"><i class="fa fa-tasks fa-fw"></i> Manage Tasks<span class="fa arrow"></span></a>
                           <ul class="nav nav-second-level">
                               <li>
                                <a href="{{URL::to('Task/new/first')}}"> <i class="fa fa-pencil fa-fw"></i> Add a New Task</a>
                               </li>
<!--                                <li>
                                <a href="#"> <i class="fa fa-pencil fa-fw"></i> View Tasks</a>
                               </li>-->
                           </ul>
                        </li>
                        
                         <li>
                            <a href="#"><i class="fa fa-database fa-fw"></i> Data Management<span class="fa arrow"></span></a>
                           <ul class="nav nav-second-level">
                               <li>
                                     <a href="{{URL::to('exprRsltsSo')}}"><i class="fa fa-save fa-fw"></i> Download Results</a>
                                </li>
                           </ul>
                        </li>        
                        
                        <li>
                            <a href="#"><i class="fa fa-gears fa-fw"></i> Analysis Tools<span class="fa arrow"></span></a>
                           <ul class="nav nav-second-level">
                               <li>
                                   <a href="{{URL::to('dashboard/tools/configaws')}}"><i class="fa fa-cloud fa-fw"></i> Bootstrap AWS</a>                                   
                                   <a href="{{URL::to('dashboard/tools/monitoring/monitorExpr')}}"><i class="fa fa-refresh fa-spin fa-fw"></i> Experiment Monitor</a>
                                   <a href="{{URL::to('dashboard/tools/firstlook')}}"><i class="fa  fa-empire fa-spin fa-fw"></i> Statistical Analysis</a>
                                </li>
                                <li>
                                     <a href="#"><i class="fa fa-gear fa-fw"></i> IGT</a>
                                     <ul class="nav nav-third-level">
                                         <li>
                                        <a href="{{URL::to('dashboard/tools/monitoring/expr/anlys/list/base/IGT')}}"><i class="fa fa-gear fa-fw"></i> Baseline Model</a>
                                        <a href="{{URL::to('dashboard/tools/monitoring/expr/anlys/list/rnd/IGT')}}"><i class="fa fa-gear fa-fw"></i> Random Model</a>
                                        <a href="{{URL::to('dashboard/tools/monitoring/expr/anlys/list/evl/IGT')}}"><i class="fa fa-gear fa-fw"></i> EVL Model</a>
                                         </li>
                                     </ul>
                                </li>
                           </ul>
                        </li>                       
                                        
                        <li>
                           <a href="#"><i class="fa fa-info fa-fw"></i> Help<span class="fa arrow"></span></a>                          
                           
                           <ul class="nav nav-second-level">
                                <li>
                                     <a href="{{URL::to('/dashboard/help/intro')}}"><i class="fa fa-book fa-fw"></i> Introduction</a>                                     
                                </li>                                                          
                           
                               <li>
                                     <a href="{{URL::to('/dashboard/help/accts')}}"><i class="fa fa-book fa-fw"></i> RDMTk Toolkit Accounts</a>                                        
                                </li>
                                <li>
                                     <a href="{{URL::to('/dashboard/help/dashboard')}}"><i class="fa fa-book fa-fw"></i> Dashboard</a>                                        
                                </li>
                                <li><a href="{{URL::to('/dashboard/help/tasks')}}"><i class="fa fa-book fa-fw"></i> Tasks</a></li>
                                <li>
                                     <a href="{{URL::to('/dashboard/help/exprs')}}"><i class="fa fa-book fa-fw"></i> Experiments</a>                                       
                                </li>
                                <li><a href="{{URL::to('/dashboard/help/expr_dsgn')}}"><i class="fa fa-book fa-fw"></i> Experimental Design</a></li>
                                <li>
                                     <a href="{{URL::to('/dashboard/help/data_mngmnt')}}"><i class="fa fa-book fa-fw"></i> Data Management</a>  
                               
                                </li>
                                <li><a href="{{URL::to('/dashboard/help/add_task')}}"><i class="fa fa-book fa-fw"></i> Adding New Task to RDMTk</a></li>                               
                                 <li>
                                     <a href="#"><i class="fa fa-book fa-fw"></i> Analysis Tools</a>   
                                     <ul class="nav nav-third-level">
                                         <li><a href="{{URL::to('/dashboard/help/expr_mntr')}}"><i class="fa fa-book fa-fw"></i> Experiment Monitor</a></li>                                                 
                                         <li><a href="{{URL::to('/dashboard/help/igt_anlys')}}"><i class="fa fa-book fa-fw"></i> Analysis Models for IGT</a></li>
                                     </ul>
                                 </li>                          
                           </ul>
                        </li>           
                        
@stop

@section('flash-content')
    @if(Session::has('message'))
    <div class="col-lg-12">
        <div class="row" style="padding:15px 5px 5px 5px;">
            <div class="alert alert-info" role="alert" style="margin:0px;padding:15px 10px 10px 10px;"><h4>
                <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>&nbsp;{{Session::get('message')}}</h4></div>
        </div>
    </div>
    @endif
@endsection

@section('error-message')
        @if($errors->has())
            <div class="col-lg-12">
                <div class="row" style="padding:15px 5px 5px 5px;">
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger" role="alert" style="margin:0px;padding:15px 10px 10px 10px;"><h5>
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp;{{$error}}</h5></div> 
                @endforeach
                </div>
            </div>

        @endif
@endsection
@section('page-content') 
    <div class="col-lg-12">
    <h1 class="page-header">Welcome</h1>
    <br>
    <p style="font-family:arial; text-align:justify">RDMTk toolkit is used for studying risky decision making. It is developed as a highly extensible web based open source framework. 
            It includes a range of easy to use functionalities for managing experiments, 
            users and data collection. RDMTk supports a good number of tasks developed by psychology researcher's to study different aspects of decision making.
            These include Balloon Task, Iowa Gambling Task, CUPS Task, Delayed Discounting Task, STROOP Task, and N-BACK Task</p>
        <p style="font-family:arial; text-align:justify">It provides a web-based environment to researchers for conducting experiments
            that are not restricted to a geographic location, can be scaled easily, foster collaboration, and thus gain better insights into decision making processes.</p>
        
    </div>
@stop



 
