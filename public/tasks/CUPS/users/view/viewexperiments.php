<?php
$userdbo = new UserDBO();
$viewusers= $userdbo->viewFieldsExperiment('experimentname,nooftrials,experimentselect,urllink,confirmationcode');
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