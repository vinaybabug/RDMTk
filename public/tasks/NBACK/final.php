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
$trials_atttempted=$_SESSION['trialattempted_pract'];
$date_val=date("Y-m-d H:i:s");
for($i=0;$i<$trials_atttempted;$i++){
$trail=$i+1;
$str.="('".$participantid."','".$experimentid."','".$trail."','".$_SESSION['dataparticipant'][$i]['stimuli']."','".$_SESSION['dataparticipant'][$i]['cor_res']."','".$_SESSION['dataparticipant'][$i]['response']."','".$_SESSION['dataparticipant'][$i]['score']."','admin','admin','".$date_val."','P'),";
}
$str=trim($str, ",");
$_SESSION['practice_values']=$str;
?>

