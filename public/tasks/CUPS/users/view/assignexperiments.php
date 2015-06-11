<?php
	
	$questionpaperdbo = new UserDBO();
	$viewquestionpapers= $questionpaperdbo->viewFieldsExperiment('experimentname,id');
	$viewquestionpapers = json_decode($viewquestionpapers);
	$countqps=count($viewquestionpapers);
	
?>
<h3>Assign Experiments - Add Participants - Urls</h3>
			  <form name="AddNewForm" id="add-new-form" method="post" action="">
   	<table>
	 <tr><td>
      <label for="experimentname">Experiment Name</label>
	  </td><td>
           <select id="experimentname"  name="experimentname" value="" required>
		<?php
			for($i=0;$i<$countqps;$i++){	
			?>
			<option value="<?php echo $viewquestionpapers[$i]->id; ?>"><?php echo $viewquestionpapers[$i]->experimentname; ?></option>
			<?php
			} 
			?>
      
     </select>
	 </td></tr>
	 
	   <tr><td colspan="2">
	 <input type="submit" name="SubmitAssignExperiment" id="SubmitAssignExperiment" value="Submit">
	 </td></tr></table>
  </form> 
 