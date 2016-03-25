  
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

 echo "<h3>Welcome ".$_SESSION['oe_user_username']."</h3>"; ?>
  	<ul>
		<li><a href="index.php?viewusers=true">View Users</a></li>
		<li><a href="index.php?createuser=true">Create Users</a></li>
		<li><a href="index.php?createexperiment=true">Create Experiment</a></li>
		<li><a href="index.php?viewexperiments=true">View Experiments</a></li>
		<li><a href="index.php?viewassignexperiments=true">View Experiment Results</a></li>
		<li><a href="index.php?logoutuser=true">LogOut</a></li>
	</ul>