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
    <div class="col-lg-12 page-header">
        <h3><i class="fa fa-bar-chart-o fa-fw"></i> Experiment Monitor</h3>
        <p>Real Time Experiment Status And Progress Tracker.</p>
    </div>
    <!-- /.col-lg-12 -->
</div>
  <!-- /.row -->
            <div class="row">       
                <div class="col-lg-6 col-md-12">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row" id="ExprSelction">
                                <div class="col-xs-2">
                                    <i class="fa fa-gears fa-2x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="form-group row text-left">
                                    {{ Form::label('taskname', 'Tool/Task Name:') }}            
                                    {{ Form::select('expertype',array('default' => 'Please select one option') + $tasks,'default', array('id' => 'expertype', 'class' => 'form-control')) }}
                                    </div>
                                    <div class="form-group row text-left">
                                    {{ Form::label('expername', 'Experiment Name:') }} 
                                    <select class="form-control" id="exprid" name="exprid" ></select>           
                                    </div>
                                </div>
                            </div>
                        </div>                        
                            <div class="panel-footer">
<!--                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>-->
                                <div class="clearfix"></div>
                            </div>                        
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row" id="ExprInfo">
                                <div class="col-xs-3">
                                    <i class="fa fa-info-circle fa-2x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div>#Participated</div>
                                    <div class="huge" id="live_summary">124</div>
                                    
                                </div>
                            </div>
                        </div>
                          <div class="panel-footer">
                                <div class="clearfix"></div>
                          </div>
                        
<!--                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>-->
                    </div>
                </div>
  
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">

                </div>
            </div>
            <!-- /.row -->
            
    <script type="text/javascript">
    $(document).ready(function() {      
        $("#expertype").change(function() {
            
            $.getJSON("{{url('/')}}"+"/dropdowns/exprs/"+$("#expertype").val(), function(data) {
                
                var $exprid = $("#exprid");
                $exprid.empty();                
                $.each(data, function(index, itemData) {                    
                    $exprid.append('<option value="' + index +'">' + itemData + '</option>');
                });
            $("#exprid").trigger("change"); // trigger next drop down list not in the example             
            });            
        
        });   
        
        var callLiveSummaryFunc = function liveSummaryFunc() {
            
        ocpu.seturl("https://192.168.56.101/ocpu/library/RDMTkAnalysisR/R");
        var req = ocpu.rpc("rdmtkGetParticipantsCntExpr", {
          
        }, function(output){
            
          $("#live_summary").text(output);
        });
        
        //if R returns an error, alert the error message
        req.fail(function(){
          alert("Server error: " + req.responseText);
        });
        
        };
        
        setInterval(callLiveSummaryFunc, 3000);
    
    });
  
  
    
</script>
@stop



 
