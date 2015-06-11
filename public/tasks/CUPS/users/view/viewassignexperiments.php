<?php
	
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
