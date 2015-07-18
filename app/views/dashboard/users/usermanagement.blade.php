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
        <h1 class="page-header"><i class="fa fa-users fa-fw"></i> Toolkit Users</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            
        </div>
        <div class="panel-body">
            <p>{{ link_to_route('users.create', 'Add new user') }}</p>
             @if ($users->count())
            <div class="table-responsive">
                
                

               
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="col-sm-1">Username</th>
                            <th class="col-sm-1">First Name</th>
                            <th class="col-sm-2">Last Name</th>
                            <th class="col-sm-2">Email</th>
                            <th class="col-sm-1">Role</th>
                            <th class="col-sm-2">Password</th>         
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td class="setWidth concat"><div>{{ $user->username }}</div></td>
                            <td class="setWidth concat"><div>{{ $user->first_name }}</div></td>
                            <td class="setWidth concat"><div>{{ $user->last_name }}</div></td>
                            <td class="setWidth concat"><div>{{ $user->email }}</div></td>                   
                            <td class="setWidth concat"><div>{{ $user->role }}</div></td>
                            <td class="setWidth concat"><div>{{ $user->password }}</div></td>                   
                            <td class="text-center">{{ link_to_route('users.edit', 'Ed',
 array($user->id), array('class' => 'btn btn-info')) }}</td>
                            <td class="text-center">
                                {{ Form::open(array('method' 
=> 'DELETE', 'route' => array('users.destroy', $user->id))) }}                       
                                {{ Form::submit('Dlt', array('class'
 => 'btn btn-danger')) }}
                                {{ Form::close() }}
                            </td>
                        </tr>
                        @endforeach

                    </tbody>

                </table>

                {{ $users->links(); }}                 
               
            </div>
            <!-- /.table-responsive -->
            @else
            <div class="well">                                
                <p> There are no users</p>                                
            </div>
             @endif
        </div>
        <!-- /.panel-body -->
    </div>
</div>
@stop



 
