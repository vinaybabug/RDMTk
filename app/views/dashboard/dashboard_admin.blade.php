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
                        <li>
                            <a href="{{URL::to('users')}}"><i class="fa fa-users fa-fw"></i> Manage Users</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-files-o fa-fw"></i> Experiments<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{URL::to('experiments')}}"><i class="fa fa-bars fa-fw"></i> View Experiments</a>
                                </li>
                                 <li>
                                     <a href="{{URL::to('exprRsltsSo')}}"><i class="fa fa-archive fa-fw"></i> Experiment's Result</a>
                                </li>
                               <!-- <li>
                                     <a href="{{URL::to('monitor/select')}}"><i class="glyphicon glyphicon-forward"></i> Monitor Experiments</a>
                                </li>-->
                                <li>
                                    <a href="{{URL::to('Task/new/first')}}"><i class="glyphicon glyphicon-forward"></i>Add a New Task</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
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
        
    </div>
@stop



 
