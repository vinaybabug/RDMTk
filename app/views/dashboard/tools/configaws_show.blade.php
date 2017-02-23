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
        <h1 class="page-header">AWS EC2 Bootstrapping</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="col-lg-12">
    <div class="panel panel-success">
        <div class="panel-heading">
            
            <a class="btn btn-circle" href="{{URL::to('/dashboard/tools/configaws/edit')}}" aria-label="Edit">
                <i class="fa fa-3x fa-pencil-square-o" aria-hidden="true"></i>
            </a>            
        </div>
        <div class="panel-body">
            
            <div class="table-responsive">
            <!--table-striped table-bordered table-hover-->
            <table class="table ">
                <tbody>
                <tr>
                    <td class="col-md-2 "><b>EC2 Instance ID:</b></td>                             
                    <td class="col-md-10">{{ $awsconfig->aws_instanceid }}</td>
                </tr>             
                <tr>
                    <td class="col-md-2 "><b>AWS User Account Key:</b></td>                             
                    <td class="col-md-10">{{ $awsconfig->aws_key }}</td>
                </tr>
                <tr>
                    <td class="col-md-2 "><b>AWS User Account Secret:</b></td>                             
                    <td class="col-md-10">{{ $awsconfig->aws_secret }}</td>
                </tr>
                <tr>
                    <td class="col-md-2 "><b>AWS Instance\'s Region:</b></td>                             
                    <td class="col-md-10">{{ $awsconfig->aws_region }}</td>
                </tr>                     
                <tr>
                    <td>
                    </td>
                </tr>   
                </tbody>                   
            </table>
        </div>
      
           
        </div>
        <div class="panel-footer">
            <a href="{{URL::to('dashboard')}}" class="btn btn-primary">Close</a>
        </div>
                
    </div>
    <br>
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-bell fa-fw"></i> Note
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <p>Workings of automated bootstrap of AWS and RDMTk is in progress. For manual set up of an account please contact us:
            <a href="mailto:cs-rdmtk@wmich.edu"><b>cs-rdmtk@wmich.edu</b></p>
        </div>
        <!-- /.panel-body -->
    </div>
    <!-- /.panel -->
</div>
@stop



 
