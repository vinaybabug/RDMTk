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

include 'include/class/oe_databasemanager.php';
 $dataObject = $_POST; //Fetching all posts
$db = new OE_DataBaseManager();
$db->connect();
$table = "delayd_expr_data";
for($trialorder=0;$trialorder<count($dataObject['data']);$trialorder++)
	{	

		
		$experimentid = $dataObject['data'][$trialorder]['experid'];
		$mid = $dataObject['data'][$trialorder]['mid'];
		$option_selected = $dataObject['data'][$trialorder]['option_selected'];
		$que_id =$dataObject['data'][$trialorder]['que_id'];
		$trialno = $dataObject['data'][$trialorder]['trialno'];

		$params= array("mid"=>$mid,"experid"=>$experimentid,"option_selected"=>$option_selected,"que_id"=>$que_id,"trialno"=>$trialno,"created_by"=>$mid,"modified_by"=>$mid);
		$db->insert($table,$params);


		}
$db->disconnect();
?>