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
        <h3 class="page-header"><i class="fa fa-files-o fa-fw"></i> Experimental Design</h3>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-bars fa-fw"></i> Relations
        </div>
        <div class="panel-body">
            <p>{{ link_to_route('exprRelns.create', 'Create new relation') }}</p>
            @if ($exprRelns->count())
            <div class="table-responsive">

                <table class="table table-striped table-bordered table-hover table-condensed">
                    
                    <thead>
                        <tr>
                            <th class="col-sm-1">Experiment in Group A</th>
                            <th class="col-sm-1">Experiment in Group B</th>                     
                            <th class="col-sm-1">Type of Experimental Design</th>
                        </tr>
                    </thead>

                    <tbody>
                        
                        @foreach ($exprRelns as $exprReln)
                        <tr>
                            <td class="col-md-3 compact"><div>{{ $exprReln->exprname1 }}</div></td>
                            <td class="col-md-3 compact"><div>{{ $exprReln->exprname2 }}</div></td>
                            <td class="col-md-3 compact"><div>{{ $exprReln->expr_dsg_nm }}</div></td>                                                                              
                            <td class="text-center col-md-1">{{ Form::open(array('method' 
=> 'DELETE', 'route' => array('exprRelns.destroy', $exprReln->id))) }}                       
                                {{ Form::submit('Dlt', array('class'
 => 'btn btn-danger')) }}
                                {{ Form::close() }}
                            </td>
                        </tr>
                        @endforeach

                    </tbody>

                </table>

                {{ $exprRelns->links(); }}              


            </div>
            <!-- /.table-responsive -->
            @else
            <div class="well">

                <p> There are no experimental relationships.</p>

            </div>
            @endif
        </div>
        <!-- /.panel-body -->
    </div>
</div>
@stop




