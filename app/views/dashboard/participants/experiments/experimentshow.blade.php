@extends('dashboard.participants.dashboard_participants')

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




