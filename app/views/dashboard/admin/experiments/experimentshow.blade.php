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
        <h1 class="page-header">Experiment Details</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="col-lg-12">

    <div class="panel-body">

        <div class="table-responsive">

            <table class="table table-striped table-bordered table-hover">
                <tbody>
                <tr>
                    <td class="col-md-2 info"><b>Experiment Name</b></td>                             
                    <td class="col-md-10">{{ $experiment->expername }}</td>
                </tr>             
                <tr>
                    <td class="col-md-2 info"><b>Tool/Task</b></td>                             
                    <td class="col-md-10">{{ $experiment->expertype }}</td>
                </tr>
                <tr>
                    <td class="col-md-2 info"><b>Number of Trials</b></td>                             
                    <td class="col-md-10">{{ $experiment->nooftrials }}</td>
                </tr>
                <tr>
                    <td class="col-md-2 info"><b>Trial End (Random / Fixed)</b></td>                             
                    <td class="col-md-10">{{ $experiment->expertrial_outcome_type }}</td>
                </tr>
                <tr>
                    <td class="col-md-2 info"><b>Confirmation Code</b></td>                             
                    <td class="col-md-10">{{ $experiment->confirmationcode }}</td>
                </tr>
                <tr>
                    <td class="col-md-2 info"><b>Confirmation Type</b></td>                             
                    <td class="col-md-10">{{ $experiment->experend_conf_page_type }}</td>
                </tr>
                <tr>
                    <td class="col-md-2 info"><b>Confirmation Text</b></td>                             
                    <td class="col-md-10">{{ $experiment->experend_conf_customtext }}</td>
                </tr>
                 <tr>
                    <td class="col-md-2 info"><b>URL</b></td>                             
                    <td class="col-md-10">{{ $experiment->urllink }}</td>
                </tr>      
               
                </tbody>                   
            </table>
        </div>
        <!-- /.table-responsive -->
        <div class="form-group">
            <a href="{{URL::to('experiments')}}" class="btn btn-primary">Close</a>
        </div>
    </div>
    <!-- /.panel-body -->

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            {{ implode('', $errors->all('<li class="error">:message</li>')) }}
        </ul>
    </div>   
    @endif 
</div>
@stop




