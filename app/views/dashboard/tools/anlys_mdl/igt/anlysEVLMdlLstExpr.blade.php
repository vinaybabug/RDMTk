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
<script type="text/javascript">
     function execMdl(exprId) {        
            
            
            $("#"+exprId+'-view'+"").addClass('disabled');
//            
            $("#"+exprId+'-dwnld'+"").addClass('disabled');
            
        
            ocpu.seturl('{{Config::get('app.opencpu_url')}}');
            var req = ocpu.rpc("rdmtkIGTBaselineModel", {
                taskType:"IGT",
                exprID:exprId,              
            }, function(output){          
           
            
            });
        
            //if R returns an error, alert the error message
            req.fail(function(){
            //alert("Server error: " + req.responseText);
            });
        
    }
    
     function dwnldMdl(exprId) {      
        
        
         ocpu.seturl("https://172.16.88.128/ocpu/library/RDMTkAnalysisR/R");
            var req = ocpu.rpc("rdmtkIGTMdlRslts", {
                taskType:"IGT",
                exprID:exprId,
                mdlType:"EVL_MDL",
            }, function(output){              

                  JSONToCSVConvertor(output.rslt, "Expectancy Valance Learning Report", true);
                
            });
        
            //if R returns an error, alert the error message
            req.fail(function(){
            //alert("Server error: " + req.responseText);
            });
        
    }
    
 
    
    function JSONToCSVConvertor(JSONData, ReportTitle, ShowLabel) {
    //If JSONData is not an object then JSON.parse will parse the JSON string in an Object
    var arrData = typeof JSONData != 'object' ? JSON.parse(JSONData) : JSONData;
    
    var CSV = '';    
    //Set Report title in first row or line
    
    CSV += ReportTitle + '\r\n\n';

    //This condition will generate the Label/Header
    if (ShowLabel) {
        var row = "";
        
        //This loop will extract the label from 1st index of on array
        for (var index in arrData[0]) {
            
            //Now convert each value to string and comma-seprated
            row += index + ',';
        }

        row = row.slice(0, -1);
        
        //append Label row with line break
        CSV += row + '\r\n';
    }
    
    //1st loop is to extract each row
    for (var i = 0; i < arrData.length; i++) {
        var row = "";
        
        //2nd loop will extract each column and convert it in string comma-seprated
        for (var index in arrData[i]) {
            row += '"' + arrData[i][index] + '",';
        }

        row.slice(0, row.length - 1);
        
        //add a line break after each row
        CSV += row + '\r\n';
    }

    if (CSV == '') {        
        alert("Invalid data");
        return;
    }   
    
    //Generate a file name
    var fileName = "RDMTkReport_";
    //this will remove the blank-spaces from the title and replace it with an underscore
    fileName += ReportTitle.replace(/ /g,"_");   
    
    //Initialize file format you want csv or xls
    var uri = 'data:text/csv;charset=utf-8,' + escape(CSV);
    
    // Now the little tricky part.
    // you can use either>> window.open(uri);
    // but this will not work in some browsers
    // or you will not get the correct file extension    
    
    //this trick will generate a temp <a /> tag
    var link = document.createElement("a");    
    link.href = uri;
    
    //set the visibility hidden so it will not effect on your web-layout
    link.style = "visibility:hidden";
    link.download = fileName + ".csv";
    
    //this part will append the anchor tag and remove it after automatic click
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}
    
</script>
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="fa fa-files-o fa-fw"></i> Expectancy Valance Learning Model</h3>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-bars fa-fw"></i> IGT Experiments
        </div>
        <div class="panel-body">
            
            @if ($expers->count())
            <div class="table-responsive">

                <table class="table table-striped table-bordered table-hover table-condensed">
                    <thead>
                        <tr>
                            <th class="col-sm-1">Experiment Name</th>                            
                            <th class="col-sm-1">#Trials</th>
                            <th class="col-sm-1">Trial Duration (Random / Fixed)</th>                            
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($expers as $exper)
                        <tr>

                           <td class="setWidth concat"><div>{{ $exper->expername }}</div></td>                            
                           <td class="setWidth concat"><div>{{ $exper->nooftrials }}</div></td>
                           <td class="setWidth concat"><div>{{ $exper->expertrial_outcome_type }}</div></td>                   
                            
                          
                           <td class="text-center col-sm-1"><a href="{{ url('/dashboard/tools/monitoring/expr/anlys/exprs/evlMdlView/')}}/{{$exper->expertype}}/{{$exper->id}}/{{'EVL_MDL'}}" id="{{$exper->id}}-view" class="btn btn-info disabled"><i class="fa fa-lg fa-eye" aria-hidden="true"></i></a></td>
                           <td class="text-center col-sm-1"><a href="javascript:void(0);" onclick="dwnldMdl('{{$exper->id}}');" id="{{$exper->id}}-dwnld" class="btn btn-info disabled"><i class="fa fa-lg fa-cloud-download" aria-hidden="true"></i></a></td>
                            <td class="text-center col-sm-1">
                               {{ Form::open(array('action' => array('ExprAnlysController@submitAnlysJob', $exper->id, "IGT", "EVL_MDL")))}}                                
                               {{ Form::button('<i class="fa fa-lg fa-flash" aria-hidden="true"></i>', array('type' => 'submit','class'=> 'btn btn-danger')); }}                               
                               {{ Form::close() }}
                               <!--<a href="javascript:void(0);" onclick="execMdl('{{$exper->id}}');" id="{{$exper->id}}-exec" class="btn btn-danger">Exec</a>-->
                           </td>

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

    <script type="text/javascript">
        
    
    
    $(document).ready(function() {       
  
    
        
        var callStatusCheckFunc = function liveSummaryFunc() {
        
              
            $.getJSON("{{url('/')}}"+"/dashboard/tools/monitoring/expr/anlys/exprs/IGT", function(data) {
                
                                
                      for (var i = 0; i < data.length; i++) {                    
                        
                          if(data[i]['anlys_mdl'] == 'EVL_MDL'){
                         
                                $("#"+data[i]['experid']+'-view'+"").removeClass('disabled');
            
                                $("#"+data[i]['experid']+'-dwnld'+"").removeClass('disabled');
                        }   
                    
                    } 
            
            });            
        
     
        };
        
        callStatusCheckFunc();
        
        setInterval(callStatusCheckFunc, 9000);
    
    });  
    
</script>
 


@stop




