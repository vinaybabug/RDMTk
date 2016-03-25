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
 