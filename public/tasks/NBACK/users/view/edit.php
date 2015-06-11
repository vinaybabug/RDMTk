<?php 
$userid = $_GET['edituser'];
$userdbo = new UserDBO();
$selectusers= $userdbo->selectUser($userid);
$jselectusers = json_decode($selectusers);
?>
<h3>Edit User</h3>
			  <form name="AddNewForm" id="add-new-form" method="post" action="">
   	<table><tr><td>
      <label for=username">User Name:*</label>
	  </td><td>
	  <input  type="hidden" name="id" id="id" value="<?php echo $jselectusers[0]->id; ?>" />
      <input  type="text" name="username" id="username" value="<?php echo $jselectusers[0]->user_name; ?>" required />
	 </td></tr>
	 <tr><td>
      <label for=password">Password:*</label>
	  </td><td>
      <input  type="text" name="password" id="password" value="<?php echo $jselectusers[0]->password; ?>" required />
	 </td></tr>
	  <tr><td>
      <label for=userrole">User Role:*</label>
	  </td><td>
	  <select name="userrole" id="userrole" required>
		<option value="">Select</option>
		<option value="Admin"<?php if($jselectusers[0]->user_role=='Admin'){ echo 'selected';} ?>>Admin</option>
		<option value="Manager"<?php if($jselectusers[0]->user_role=='Manager'){ echo 'selected';} ?>>Manager</option>
		<option value="User"<?php if($jselectusers[0]->user_role=='User'){ echo 'selected';} ?>>User</option>
	  </select>

	   <tr><td colspan="2">
	 <input type="submit" name="EditUser" id="EditUser" value="Submit">
	 </td></tr></table>
  </form> 
 

