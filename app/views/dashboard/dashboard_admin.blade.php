@extends('layouts.dashboard_master')

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
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>                       
                        
                       
@stop

@section('page-content') 
    <div class="col-lg-12">
                        <h1 class="page-header">Welcome</h1>
    </div>
@stop



 
