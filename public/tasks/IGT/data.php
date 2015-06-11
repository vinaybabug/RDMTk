<?php
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