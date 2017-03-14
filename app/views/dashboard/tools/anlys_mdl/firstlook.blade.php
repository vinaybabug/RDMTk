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
    <div class="col-lg-12 col-md-24">
        <div class="panel panel-primary">           
            <a>
                <div class="panel-footer">
                    <span class="pull-left"><h3>Statistical Analysis</h3></span>
                    <span class="pull-right"><i class="fa  fa-empire fa-5x"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
            <div class="panel-heading">
                <div class="row">        
                </div>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
</div>
<div class="col-lg-12">
    <!-- /.col-lg-4 -->
    <div class="col-lg-4">
        <div class="panel panel-success">
            <div class="panel-heading">
                <b>Configure Parameters</b>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    {{ Form::label('taskname', 'Tool/Task Name:') }}            
                    {{ Form::select('expertype',array('default' => 'Please select one option') + $tasks,'default', array('id' => 'expertype', 'class' => 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('expername', 'Experiment Name:') }} 
                    <select class="form-control" id="exprid" name="exprid" ></select>           
                </div>                                    
                <div class="form-group">
                    {{ Form::label('statfuncname', 'Statistical Function:') }} 

                    {{ Form::select('statfunc',array('default' => 'Please select one option', 'BOXPLOT' => 'Box Plot'),'default', array('id' => 'statfunc', 'class' => 'form-control')) }}
                </div>
                <div class="form-group">                                 
                    <a id="execstatfun" href="#" class="btn btn-primary" onclick="RDMTkStatFunctions();">Execute</a>
                </div>
            </div>
            <div class="panel-footer">                            
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-md-16">
        <div class="panel panel-info">
            <div class="panel-heading">

            </div>
            <div class="panel-body">
                <div class="span8">                    
                    <div id="plotdiv"></div>
                </div>  
            </div>
            <div class="panel-footer">
                <div class="clearfix"></div>
            </div>
        </div>


        <!--                        <a href="#">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>-->
    </div>
    <!--
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            {{ implode('', $errors->all('<li class="error">:message</li>')) }}
        </ul>
    </div>   
    @endif    
    -->
    
     <div class="col-lg-8 col-md-16">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <b>Summary Statistics</b>
                        </div>                        
                        <div class="panel-footer">
                           <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Min.</th>
                                            <th>1st Qu.</th>
                                            <th>Median</th>
                                            <th>Mean</th>
                                            <th>3rd Qu.</th>
                                            <th>Max.</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td id="ss_min"></td>
                                            <td id="ss_1st_qu"></td>
                                            <td id="ss_median"></td>
                                            <td id="ss_mean"></td>
                                            <td id="ss_3rd_qu"></td>
                                            <td id="ss_max"></td>
                                        </tr>                                       
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-4 -->
</div>

<style>
#plotdiv {
  margin-left: 10px;
  margin-top: 10px;
  width: 95vh;
  height: 40vh;  
}
</style>

<script type="text/javascript">

    function BoxPlot(exprid, tasktype) {

        //alert(tasktype + ' ' + ' ' + exprid);

        ocpu.seturl('{{Config::get('app.opencpu_url')}}');
        
        var req = $("#plotdiv").rplot("rdmtkBoxPlot", {
            taskType:tasktype,
            exprID:exprid,           
        }).always(function () {
            //$("#plotbutton").removeAttr("disabled");
             console.log(req);
        }).fail(function () {
            alert(req.responseText);
        });
        
        //optional, requires jquery-ui.
        $("#plotdiv").resizable()   
    }


    function SummaryStatistics(exprid, tasktype){
          // Get summary statistics
        
          ocpu.seturl('{{Config::get('app.opencpu_url')}}');
        
            var req = ocpu.rpc("rdmtkSApply", {
                taskType:tasktype,
                exprID:exprid              
            }, function(output){
                        
            $("#ss_min").text(output.min);
            $("#ss_1st_qu").text(output.fst_qu);    
            $("#ss_median").text(output.median);
            $("#ss_mean").text(output.mean);         
            $("#ss_3rd_qu").text(output.trd_qu);
            $("#ss_max").text(output.max);     
            
            });
        
            //if R returns an error, alert the error message
            req.fail(function(){
//            alert("Server error: " + req.responseText);
            });
            
    }
    
    function RDMTkStatFunctions() {

        var taskType = document.getElementById("expertype").value;
        var exprid = document.getElementById("exprid").value; //$("#exprid");
        var statFunc = document.getElementById("statfunc").value; //$("#statfunc")             

        SummaryStatistics(exprid, taskType);
        
        switch (statFunc) {
            case "BOXPLOT":
                BoxPlot(exprid, taskType);
                break;
            default:
                text = "Invalid function!";
        }
        
      
    }
       
    
</script>    
<script type="text/javascript">

    $(document).ready(function () {
        var heights = $(".panel-body").map(function () {
            return $(this).height();
        }).get(),
                maxHeight = Math.max.apply(null, heights);

        $(".panel-body").height(maxHeight);
    });

</script>
<script type="text/javascript">
    $(document).ready(function () {


        $("#expertype").change(function () {

            $.getJSON("{{url('/')}}" + "/dropdowns/exprs/" + $("#expertype").val(), function (data) {

                var $exprid = $("#exprid");
                $exprid.empty();
                $.each(data, function (index, itemData) {
                    $exprid.append('<option value="' + index + '">' + itemData + '</option>');
                });
                $("#exprid").trigger("change"); // trigger next drop down list not in the example             
            });

        });



        $('#execstatfun').click(function (e) {
            e.preventDefault(); /*your_code_here;*/
            return false;
        });


    });
</script>


@stop




