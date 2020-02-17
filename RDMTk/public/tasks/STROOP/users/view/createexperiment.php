<!--
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
*-->

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
      <input  type="text" name="nooftrials" id="nooftrials" value="" required />
	  <input  type="hidden" name="weburl" id="weburl" value="<?php echo $realurlstring; ?>"  />
	 </td></tr>
	 <tr><td>
      <label for="experimentselect">Select Experiment:</label>
	  </td><td>
	  <select name="experimentselect" id="experimentselect" required>
		<option value="">Select</option>
		<option value="N-Back">N-Back</option>
	
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
 

