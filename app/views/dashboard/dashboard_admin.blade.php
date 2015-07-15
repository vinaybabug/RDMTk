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
        <div class="row">
            <div class="jumbotron col-lg-4 col-lg-offset-8">
                <div class="container text-center">
                    <div style='font-family:cursive;'><h2>Create a new Task</h2></div>
                    <br>
                    <div style='color:#000080;'>
                        <h4>Follow the simple Three Step Procedure to integrate a new Task </h4>
                        <br>
                        <a href="{{URL::to('Task/new/1')}}" role="button" class="btn btn-primary btn-lg"> Get Started </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@stop



 
