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
 

