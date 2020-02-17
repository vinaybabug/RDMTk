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

<h3>Delete User</h3>
<h4> Are you sure , you want to delete User with Name: <?php echo $_GET['name'];?></h4>


			  <form name="AddNewForm" id="add-new-form" method="post" action="">
  
	  <input  type="hidden" name="id" id="id" value="<?php echo $_GET['deleteuser']; ?>" />
      
	 <input type="submit" name="DeleteUser" id="DeleteUser" value="Delete">
	 <input action="action" type="button" value="Back" onclick="history.go(-1);" />
	 
  </form> 
 

