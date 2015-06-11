@extends('dashboard.dashboard_admin')

@section('page-content') 
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">User Profile</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="col-lg-12">
    <div class="panel panel-info">
        <div class="panel-heading">
            
        </div>
        <div class="panel-body">
            {{ Form::model($user, array('method' => 'PATCH', 'route' => array('users.update', $user->id))) }}

            <fieldset disabled>
               <div class="form-group">
                        {{ Form::label('first_name', 'First Name:') }}
                        {{ Form::text('first_name', null, array('class' => 'form-control')) }}  
               </div>

                <div class="form-group">
                        {{ Form::label('last_name', 'Last Name:') }}
                        {{ Form::text('last_name', null, array('class' => 'form-control')) }}
                </div>
                
               <div class="form-group">
                        {{ Form::label('role', 'Role:') }}
                        {{ Form::select('role', array(
                'ADMIN' => 'Admin',
                'RDM_RESEARCHER' => 'Researcher',
                'END_USER' => 'Participants',                              
                ), null, array('class' => 'form-control')); }}
               </div>
                
                 <div class="form-group">
                        {{ Form::label('email', 'Email:') }}
                        {{ Form::text('email', null, array('class' => 'form-control')) }}
                 </div>
                
                  <div class="form-group">
                        {{ Form::label('username', 'Username:') }}
                        {{ Form::text('username', null, array('class' => 'form-control')) }}
                  </div>
                  
                  
            </fieldset>
            {{ Form::close() }}
        </div>
        <div class="panel-footer">
            <a href="{{URL::to('dashboard_admin')}}" class="btn btn-primary">Close</a>
        </div>
                
    </div>
</div>
@stop



 
