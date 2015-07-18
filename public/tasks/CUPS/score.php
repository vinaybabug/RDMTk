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
$myarr =$_POST['myarr'];
$id =$_POST['id'];
$experimentid =$_POST['experimentid'];
$participantid =$_POST['participantid'];
$random_val =$_POST['random_val'];
$url=$_SESSION['currenturlink'];
$con=mysqli_connect("localhost","root","password","rdmtoolkit");
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}		

$myarr=json_decode(stripcslashes($myarr));
/*foreach($myarr  as $product)
{
        $product->color_rand;
        $product->side_rand;
	$product->size;
	$product->amount;
	$product->assign_val;	
	$product->total_score;
	$product->amount_assign;
	$product->selected_cup;
	$product->selected_side;
	$product->time_taken;
	$product->date_created;
}*/
$date_val=date("Y-m-d H:i:s");
for($trialorder=0;$trialorder<count($myarr)-1;$trialorder++)
{
	$trail=$trialorder+1;
	$str.="('".$participantid."','"
                .$experimentid."','"
                .$myarr[$trialorder]->size."','"
                .$myarr[$trialorder]->amount."','"
                .$myarr[$trialorder]->amount_assign."','"
                .$myarr[$trialorder]->side_rand."','"
                .$myarr[$trialorder]->selected_cup."','"
                .$myarr[$trialorder]->selected_side."','"
                .$trail."','"
                .$myarr[$trialorder]->assign_val."','"
                .$myarr[$trialorder]->total_score.
                "','admin','admin','"
                .$date_val."','"
                .$myarr[$trialorder]->time_taken."', '"
                .$myarr[$trialorder]->color_rand."'),";
}
$str=trim($str, ",");
mysqli_query($con,"INSERT INTO `cups_expr_data`( `mid`, `experid`, `cupsnumber`, `amountshown`, `paychoice`, `position`, `participantchoice`, `participantposition`, `trialno`, `trial_pts`, `total_pts`, `created_by`, `modified_by`, `created_at`,`tracktime`, `cup_color`) VALUES  ".$str);
$con->disconnect();
?>

