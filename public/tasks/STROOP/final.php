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
$experimentid =$_SESSION['exp'];
$participantid =$_SESSION['MID'];
$random=$_SESSION['random_val'];
$click=$_POST['click'];
$myarr_p=$_POST['result_p'];
$date_val=date("Y-m-d H:i:s");
	for($i=1;$i<=36;$i++){
	if($myarr_p[$i][response]==68){
	  echo $response_value="RED";
	}
	if($myarr_p[$i][response]==70){
	  echo $response_value="YELLOW";
	}
	if($myarr_p[$i][response]==74){
	  echo $response_value="GREEN";
	}
	if($myarr_p[$i][response]==75){
	  echo $response_value="BLUE";
	}
	if($response_value==$myarr_p[$i][corrResp])
	{
	$score=1;
	}else{
	$score=0;
	}
	$str_p.="('".$participantid."','".$experimentid."','".$i."','".$myarr_p[$i][word]."','".$myarr_p[$i][corrResp]."','".$response_value."','".$score."','admin','admin','".$date_val."','P','".$myarr_p[$i][time_track]."'),";
}
$str_p=trim($str_p, ",");
$_SESSION['arry_p']=$str_p;
?>


