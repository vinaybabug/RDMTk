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
$clicks =$_POST['click'];
$id =$_POST['id'];
$experimentid =$_POST['experimentid'];
$participantid =$_POST['participantid'];
$random_val =$_POST['random_val'];
$list_data_json=$_SESSION['list_data_json'];
$list_data=$_SESSION['list_data'];
$card_A_win = $list_data[$clicks-1]->card_A_win;
$card_A_lose = $list_data[$clicks-1]->card_A_lose;
$card_B_win = $list_data[$clicks-1]->card_B_win;
$card_B_lose = $list_data[$clicks-1]->card_B_lose;
$card_C_win = $list_data[$clicks-1]->card_C_win;
$card_C_lose = $list_data[$clicks-1]->card_C_lose;
$card_D_win = $list_data[$clicks-1]->card_D_win;
$card_D_lose = $list_data[$clicks-1]->card_D_lose;
			
			
	if($id=="card_A"){
	$final_win = $card_A_win;
	$final_lose = $card_A_lose;

	}
	if($id=="card_B"){
	
		$final_win = $card_B_win;
	$final_lose = $card_B_lose;
	
	}
	if($id=="card_C"){

		$final_win = $card_C_win;
	$final_lose = $card_C_lose;
	
	}
	if($id=="card_D"){
	
		$final_win = $card_D_win;
	$final_lose = $card_D_lose;
	
	}
	echo $final_win.",".$final_lose;

?>