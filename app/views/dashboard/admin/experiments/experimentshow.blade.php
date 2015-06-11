@extends('dashboard.dashboard_admin')

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




