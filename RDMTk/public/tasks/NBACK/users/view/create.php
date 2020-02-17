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
 

