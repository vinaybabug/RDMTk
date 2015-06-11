<?php
$userdbo = new UserDBO();
$viewusers= $userdbo->viewFieldsUser('user_name,password,user_role,id');
$viewusers = json_decode($viewusers);
$i=0;

$countuser=count($viewusers);
?>
<h3>View Users</h3>
<table cellspacing="2" cellpadding="2">
	<tr><th>User Name</th><th>Password</th><th>User Role</th><th>Edit</th><th>Delete</th></tr>
<?php
for($i=0;$i<$countuser;$i++){	
?> 
<tr><td><?php echo $viewusers[$i]->user_name; ?> </td>
<td><?php echo $viewusers[$i]->password; ?> </td>
<td><?php echo $viewusers[$i]->user_role; ?> </td>
<td><a href="index.php?edituser=<?php echo $viewusers[$i]->id;?>">Edit</a></td>
<td><a href="index.php?deleteuser=<?php echo $viewusers[$i]->id;?>&name=<?php echo $viewusers[$i]->user_name;?>">Delete</a></td></tr>
	
<?php } 
?>
</table>