<h3>Create User</h3>
			  <form name="AddNewForm" id="add-new-form" method="post" action="">
   	<table><tr><td>
      <label for="username">User Name:</label>
	  </td><td>
      <input  type="text" name="username" id="username" value="" required />
	 </td></tr>
	<tr><td>
      <label for="password">Password:</label>
	  </td><td>
      <input  type="text" name="password" id="password" value="" required />
	 </td></tr>
	 <tr><td>
      <label for="userrole">User Role:</label>
	  </td><td>
	  <select name="userrole" id="userrole" required>
		<option value="">Select</option>
		<option value="Admin">Admin</option>
		<option value="Manager">Manager</option>
		<option value="User">User</option>
	  </select>
	 </td></tr>
	   <tr><td colspan="2">
	 <input type="submit" name="SubmitUser" id="SubmitUser" value="Submit">
	 </td></tr></table>
  </form> 
 

