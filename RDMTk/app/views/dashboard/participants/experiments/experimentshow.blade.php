@extends('dashboard.participants.dashboard_participants')
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
        <h1 class="page-header"><i class="fa fa-files-o fa-fw"></i> {{ $currentTask->taskname}}</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-bars fa-fw"></i> Experiments
        </div>
        <div class="panel-body">            
            @if ($expers->count())
            <div class="table-responsive">

                <table class="table table-striped table-bordered table-hover table-condensed">
                    <thead>
                        <tr>
                            <th class="col-sm-4">Experiment Name</th>                            
                            <th class="col-sm-4">#Trials</th>                       
                            
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($expers as $exper)
                        <tr>

                            <td class="setWidth concat"><div>{{ $exper->expername }}</div></td>
                            
                            <td class="setWidth concat"><div>{{ $exper->nooftrials }}</div></td>                            
                            <td class="text-center"><div class="col-sm-12" align='center'>{{ link_to($exper->urllink.rand(), 'Start', array('class' => 'btn btn-success', 'target' =>'_blank')) }}</div></td>            
                            
                        </tr>
                        @endforeach

                    </tbody>

                </table>

                {{ $expers->links(); }}              


            </div>
            <!-- /.table-responsive -->
            @else
            <div class="well">

                <p> There are no experiments.</p>

            </div>
            @endif
        </div>
        <!-- /.panel-body -->
    </div>
</div>
@stop




