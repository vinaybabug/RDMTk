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
$char_press =$_POST['char_press'];
$click=$_SESSION['sessionvalue']-1;
$trials_atttempted=$_SESSION['trials_atttempted'];
$trialattempted_pract=$_SESSION['trialattempted_pract'];
$count_prac=count($_SESSION['dataparticipant']);
$count_main=count($_SESSION['dataparticipant_main']);
 $initial_char=(string)$_SESSION['initial_char'];
$prev_char=(string)$_SESSION['prev_char'];
$click_main=$_SESSION['sessionvalue_main']-1;

 $initial_char_main=(string)$_SESSION['initial_char_main'];
$prev_char_main=(string)$_SESSION['prev_char_main'];
if(($count_prac>0)&&($count_prac<=21)){
$key_val=0; 
if($click>=3){
if($char_press==32){
 if($prev_char==$initial_char){
	$_SESSION['dataparticipant'][$click]['score']=1;
	$_SESSION['dataparticipant'][$click]['response']=1;	
 }else{
	$_SESSION['dataparticipant'][$click]['score']=3;
	$_SESSION['dataparticipant'][$click]['response']=0;	
	
 }

}
}else{
	if($_SESSION['sessionvalue']==0){
		$_SESSION['dataparticipant'][$click]['score']=3;
	}else{
		$_SESSION['dataparticipant'][$click]['score']=3;
	}
}
}
if(($count_main>1)&&($count_main<$trials_atttempted)){
$key_value=1;
if($click_main>=3){
if($char_press==32){
 if($prev_char_main==$initial_char_main){
	$_SESSION['dataparticipant_main'][$click_main]['score']=1;
	$_SESSION['dataparticipant_main'][$click_main]['response']=1;	
 }else{
	$_SESSION['dataparticipant_main'][$click_main]['score']=3;
	$_SESSION['dataparticipant_main'][$click_main]['response']=0;	
	
 }

}
}else{
	if($_SESSION['sessionvalue_main']==0){
		$_SESSION['dataparticipant_main'][$click_main]['score']=3;
	}else{
		$_SESSION['dataparticipant_main'][$click_main]['score']=3;
	}
}
}
if($key_value==0){
echo $_SESSION['dataparticipant'][$click]['score'];
}
if($key_value==1){
echo $_SESSION['dataparticipant_main'][$click_main]['score'];
}
?>

