<?php
	

	/**
* Copyright (C) 2015  WiSe Lab, Computer Science Department, Western Michigan University
*Project Members Involved: Ajay Gupta, Aakash Gupta, Baba Shiv, Praneet Soni, Shrey Gupta and Vinay B Gavirangaswamy
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
*/


$experimentname="";
if(isset($_POST['submit'])){

	$experimentname="`experimentid`='".$_POST['experimentname']."'";
  header("location:experiment_report_excel.php?experimentname=".$experimentname);    
  }
if (isset($_GET["pages"])) { $pages  = $_GET["pages"]; } else { $pages=1; };
$start_from = ($pages-1) * 5;
$userdbo = new UserDBO();
$viewusers= $userdbo->viewJoinFieldsParticipantCond($experimentname.' order by experimentname, mid, trialno LIMIT '.$start_from.', 5');
$viewusers = json_decode($viewusers);
$countuser=count($viewusers);

	
	$experimentdbo = new UserDBO();
	$viewexperiments= $experimentdbo->viewFieldsExperiment('experimentname,id');
	$viewexperiments = json_decode($viewexperiments);
	$countexperiments=count($viewexperiments);
	

?>
<script>
  $(function() {
     $("#search_button").click(function(){
	// alert("zvjhfbKJZn");
		var experimentname=document.getElementById("experimentname").value;
				
		$(location).attr("href", "index.php?viewassignexperiments=true&experimentname="+experimentname);
		
		
 
 });
   
	

  });
  </script>
<h3>View Experiment Results</h3>
<form action="" method="post">
<div class="slidingDiv">
Choose Experiment:
  <select id="experimentname"  name="experimentname" value="" required>
  <option></option>
		<?php
			for($i=0;$i<$countexperiments;$i++){	
			?>
			<option value="<?php echo $viewexperiments[$i]->id; ?>"><?php echo $viewexperiments[$i]->experimentname; ?></option>
			<?php
			} 
			?>
      
     </select>


</div>


  <input type="submit" id="download" name="submit" value="Download Report"> 
  </form>
