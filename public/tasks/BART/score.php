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


error_reporting(1);
session_start();
include 'include/class/oe_databasemanager.php';
include 'users/controller/user_dbo.php';

$myarr =$_POST['data'];

$myarr = json_decode($myarr);

$con=mysqli_connect("localhost","root","password","rdmtoolkit");
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}		



for($trialorder=0;$trialorder<count($myarr);$trialorder++)
{
	
	$str.="('"
                .$myarr[$trialorder]->mid."','"
                .$myarr[$trialorder]->experid."','"
                .$myarr[$trialorder]->trialstopindex."','"
                .$myarr[$trialorder]->noofpumps."','"
                .$myarr[$trialorder]->trial_pts."','"
                .$myarr[$trialorder]->total_pts."','"
                .$myarr[$trialorder]->trialno."','"
                .$myarr[$trialorder]->tracktime."','"
                .$myarr[$trialorder]->created_by."','"
                .$myarr[$trialorder]->modified_by."','"
                .$myarr[$trialorder]->created_at."', '"
                .$myarr[$trialorder]->updated_at."'),";
}

$str=trim($str, ",");

mysqli_query($con,"INSERT INTO `bart_expr_data`
(
`mid`,
`experid`,
`trialstopindex`,
`noofpumps`,
`trial_pts`,
`total_pts`,
`trialno`,
`tracktime`,
`created_by`,
`modified_by`,
`created_at`,
`updated_at`) VALUES  ".$str);

mysqli_close($con);

echo "true";

?>

