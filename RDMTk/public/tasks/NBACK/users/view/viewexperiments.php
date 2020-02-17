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


$userdbo = new UserDBO();
$viewusers= $userdbo->viewFieldsExperiment('experimentname,nooftrials,experimentselect,confirmationcode,urllink');
$viewusers = json_decode($viewusers);
$i=0;

$countuser=count($viewusers);
?>
<h3>View Experiments</h3>
<table cellspacing="2" cellpadding="2">
	<tr><th>Experiment Name</th><th>No Of Trials</th><th>Base Experiment</th><th>Confirmation Code</th><th>URL Link</th></tr>
<?php
for($i=0;$i<$countuser;$i++){	
?> 
<tr><td><?php echo $viewusers[$i]->experimentname; ?> </td>
<td><?php echo $viewusers[$i]->nooftrials; ?> </td>
<td><?php echo $viewusers[$i]->experimentselect; ?> </td>
<td><?php echo $viewusers[$i]->confirmationcode; ?> </td>
<td><?php echo $viewusers[$i]->urllink; ?> </td>	
<?php } 
?>
</table>