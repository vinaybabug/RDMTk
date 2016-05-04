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
        <h3 class="page-header">Random Model Results</h3>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="col-lg-12">

    <div class="panel-body">

        <div class="table-responsive">
            
             <table id="rsltTable" class="table table-striped table-bordered table-hover table-condensed">
                    <thead class="thead-inverse">
                        <tr>
                            <th class=" col-sm-1">#</th>
                            <th class=" col-sm-1">Participant id</th>                            
                            <th class="col-sm-1">#Trials</th>
                            <th class="col-sm-1">G2Rand</th>                            
                        </tr>
                    </thead>

                    <tbody>
                        
                    </tbody>

             </table>
        </div>
        <!-- /.table-responsive -->
        <div class="form-group">
            <a href="{{URL::to('dashboard/tools/monitoring/expr/anlys/list/rnd/IGT')}}" class="btn btn-primary">Close</a>
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

 <script type="text/javascript">
        
    $expertype='{{$expertype}}';
    $exprId='{{$exprId}}';
    $mdlType='{{$mdlType}}';
    
    $(document).ready(function() {       
        
//        alert($expertype +' '+ $exprId+' '+$mdlType);
        
         ocpu.seturl("https://172.16.88.128/ocpu/library/RDMTkAnalysisR/R");
            var req = ocpu.rpc("rdmtkIGTMdlRslts", {
                taskType:$expertype,
                exprID:$exprId,
                mdlType:$mdlType,
            }, function(output){          
           
//                alert(output.rslt[0][0]);
                
//                alert(output.rslt.length);
                var table = document.getElementById("rsltTable");
                
                for(i=0; i< output.rslt.length; i++){
                    var row = table.insertRow(i+1);
                    var cell0 = row.insertCell(0);
                    var cell1 = row.insertCell(1);
                    var cell2 = row.insertCell(2);
                    var cell3 = row.insertCell(3);
                    
                    // Add some text to the new cells:
                    cell0.innerHTML = i+1;
                    cell1.innerHTML = output.rslt[i][0];
                    cell2.innerHTML = output.rslt[i][1];
                    cell3.innerHTML = output.rslt[i][2];                    
                }
                 
                
            });
        
            //if R returns an error, alert the error message
            req.fail(function(){
            //alert("Server error: " + req.responseText);
            });
    });
    
 </script>
 
@stop




