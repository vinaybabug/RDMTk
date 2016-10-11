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
                                        {{ Form::label('exprDesgType', 'Experiment design type:') }}
                                        {{ Form::select('exprDesgType',array('default' => 'Please select one option') + $exprDesgType, 'default', array('class' => 'form-control')) }}

                                    </div>
                                    <div class="form-group row text-left">
                                    {{ Form::label('taskname', 'Tool/Task Name:') }}            
                                    {{ Form::select('expertype',array('default' => 'Please select one option') + $tasks,'default', array('id' => 'expertype', 'class' => 'form-control')) }}
                                    </div>
                                    <div class="form-group row text-left">
                                    {{ Form::label('expr_dsg_nm_lbl', 'Experiment Name:') }} 
                                    <select class="form-control" id="expr_dsg_nm" name="expr_dsg_nm" ></select>           
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
                            <div class="row" id="StatInfo">
                                
                                <div class="col-xs-1">
                                    <i class="fa fa-info-circle fa-2x"></i>
                                </div>
                                <div class="row">
                                <div class="col-xs-5 text-right">
                                    <div>Group A Experiment</div>
                                    <div class="huge" id="grp_a_expr"></div>                                    
                                </div>
                                <div class="col-xs-5 text-right">
                                    <div>Group B Experiment</div>
                                    <div class="huge" id="grp_b_expr"></div>                                    
                                </div>
                                </div>
                                 <div class="col-xs-1">                                    
                                 </div>
                                <div class="row">
                                    
                                <div class="col-xs-5 text-right">
                                    <div>#Participated in Group A</div>
                                    <div class="huge" id="p_cnt_a"></div>                                    
                                </div>
                                <div class="col-xs-5 text-right">
                                    <div>#Participated in Group B</div>
                                    <div class="huge" id="p_cnt_b"></div>                                    
                                </div>
                                </div>
                                 </div>
                                 <div class="col-xs-1">                                    
                                 </div>
                                <div class="row">
                                    
                                <div class="col-xs-5 text-right">
                                    <div>Effect Size</div>
                                    <div class="huge" id="effect_size"></div>                                    
                                </div>
                                <div class="col-xs-5 text-right">
                                    <div>Power</div>
                                    <div class="huge" id="power"></div>                                    
                                </div>
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
        
    $( document ).ready(function() {
    var heights = $(".panel-heading").map(function() {
        return $(this).height();
    }).get(),

    maxHeight = Math.max.apply(null, heights);

    $(".panel-heading").height(maxHeight);
});
        
    </script>
    <script type="text/javascript">
        
    var exprAId='NA';
    var exprBId='NA';
    var taskType='NA';
    var exprReln = 'NA';
    var riskLvl = 0.01;
    var sig_level = 0.05;
    
    $(document).ready(function() {      
          
        var callLiveSummaryFunc = function liveSummaryFunc() {
        
        if(exprAId !== 'NA' && exprBId !=='NA' && taskType !=='NA' && exprReln !== 'NA'){            
            
            ocpu.seturl('{{Config::get('app.opencpu_url')}}');
        
            var req = ocpu.rpc("rdmtkExprLiveStats", {
                taskType:taskType,
                exprAID:exprAId,
                exprBID:exprBId,                
                exprReln:exprReln,
                riskLvl:riskLvl,
                sig_level:sig_level,
            }, function(output){
            
            $("#p_cnt_a").text(output.exprA_participants_cnt);
            $("#p_cnt_b").text(output.exprB_participants_cnt);    
            $("#effect_size").text(output.effect_size);
            $("#power").text(output.power);         
            
            });
        
            //if R returns an error, alert the error message
            req.fail(function(){
            //alert("Server error: " + req.responseText);
            });
        }
        };
        
        setInterval(callLiveSummaryFunc, 3000);
    
    });  
    
</script>

<script type="text/javascript">
    $(document).ready(function() {
        
        
        $("#expertype").change(function() {            
            $.getJSON("{{url('/')}}"+"/dropdowns/exprRelns/"+$("#expertype").val()+"/"+$("#exprDesgType").val(), function(data) { 
            
                var $expr_dsg_nm = $("#expr_dsg_nm");
                $expr_dsg_nm.empty();                
                $.each(data, function(index, itemData) {                    
                    $expr_dsg_nm.append('<option value="' + index +'">' + itemData + '</option>');
                });
                $("#expr_dsg_nm").trigger("change"); // trigger next drop down list not in the example             
                
                exprAId = data.exprid1;
                exprBId = data.exprid2;

                taskType=$("#expertype").val();
                exprReln = $("#exprDesgType").val();
            });            
        
        });
        
        $("#exprDesgType").change(function() {            
            $.getJSON("{{url('/')}}"+"/dropdowns/exprRelns/"+$("#expertype").val()+"/"+$("#exprDesgType").val(), function(data) { 
            
                var $expr_dsg_nm = $("#expr_dsg_nm");
                $expr_dsg_nm.empty();                
                $.each(data, function(index, itemData) {                    
                    $expr_dsg_nm.append('<option value="' + index +'">' + itemData + '</option>');
                });
                $("#expr_dsg_nm").trigger("change"); // trigger next drop down list not in the example    
                
                exprAId = data.exprid1;
                exprBId = data.exprid2;

                taskType=$("#expertype").val();
                exprReln = $("#exprDesgType").val();
            });            
        
        });
        
        
            $("#expr_dsg_nm").change(function() {            
            $.getJSON("{{url('/')}}"+"/dropdowns/exprReln/"+$("#expertype").val()+"/"+$("#exprDesgType").val()+"/"+$("#expr_dsg_nm").val(), function(data) { 
            
             $("#grp_a_expr").text(data.exprname1);
             $("#grp_b_expr").text(data.exprname2);
            
             exprAId = data.exprid1;
             exprBId = data.exprid2;
             taskType=$("#expertype").val();
             exprReln = $("#exprDesgType").val();
         
            });            
        
        });
    });
</script>

@stop



 
