<h3>Create Experiment</h3>
			  <form name="AddNewForm" id="add-new-form" method="post" action="">
   	<table><tr><td>
      <label for="experimentname">Experiment Name:</label>
	  </td><td>
      <input  type="text" name="experimentname" id="experimentname" value="" required />
	 </td></tr>
	  <?php 
	 $weburl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; 
	 $halfstring = explode('?',$weburl);
	 $realurlstring = str_replace("index.php","demo.php",$halfstring[0]);
	 	 ?>
	<tr><td>
      <label for="nooftrials">No Of Trials</label>
	  </td><td>
      <input  type="text" name="nooftrials" id="nooftrials" value="90" required readonly />
	  <input  type="hidden" name="weburl" id="weburl" value="<?php echo $realurlstring; ?>"  />
	 </td></tr>
	 <tr><td>
      <label for="experimentselect">Select Experiment:</label>
	  </td><td>
	  <select name="experimentselect" id="experimentselect" required>
		<option value="">Select</option>
		<option value="CupGameApp">Cup Game App</option>
	  </select>
	 </td></tr>
	<tr><td>
      <label for="confirmationcode">Confirmation Code</label>
	  </td><td>
      <input  type="text" name="confirmationcode" id="confirmationcode" value="" required />
	</td></tr>
	   <tr><td colspan="2">
	 <input type="submit" name="SubmitExperiment" id="SubmitExperiment" value="Submit">
	 </td></tr></table>
  </form> 
 

