<?php
error_reporting(1);
session_start();
include 'include/class/oe_databasemanager.php';
include 'users/controller/user_dbo.php';
$myarr =$_POST['myarr'];
$id =$_POST['id'];
$experimentid =$_POST['experimentid'];
$participantid =$_POST['participantid'];
$random_val =$_POST['random_val'];
$list_data_json=$_SESSION['list_data_json'];
$list_data=$_SESSION['list_data'];
$con=mysqli_connect("localhost","root","password","rdmtoolkit");
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}	
$query2="SELECT  * FROM `igt_score_cards` WHERE 1 ";	
$sql2=mysqli_query($con,$query2)or die('Not Executed4');
$card_A_win=array();
$card_B_win=array();
$card_C_win=array();
$card_D_win=array();
$card_A_lose=array();
$card_B_lose=array();
$card_C_lose=array();
$card_D_lose=array();
	while($row=mysqli_fetch_assoc($sql2))
			{
			 $card_A_win[] = $row['card_A_win'];
			 $card_B_win[] = $row['card_B_win'];
			 $card_C_win[] = $row['card_C_win'];
			 $card_D_win[] = $row['card_D_win'];
			 $card_A_lose[] = $row['card_A_lose'];
			 $card_B_lose[] = $row['card_B_lose'];
			 $card_C_lose[] = $row['card_C_lose'];
			 $card_D_lose[] = $row['card_D_lose'];
			
			}
	$myarr=json_decode(stripcslashes($myarr));
/*foreach($myarr  as $product)
{
    $product->initial_total_score;
    $product->final_score;
    $product->selected_card;
    $product->date_created;
    $product->time_track;
}*/
$date_val=date("Y-m-d H:i:s");
for($trialorder=0;$trialorder<count($myarr)-1;$trialorder++)
{
	$trail=$trialorder+1;
	$str.="('".$participantid."','".$experimentid."','".$trail."','".$myarr[$trialorder]->initial_total_score."','".$card_A_win[$trialorder]."','".$card_A_lose[$trialorder]."','".$card_B_win[$trialorder]."','".$card_B_lose[$trialorder]."','".$card_C_win[$trialorder]."','".$card_C_lose[$trialorder]."','".$card_D_win[$trialorder]."','".$card_D_lose[$trialorder]."','".$myarr[$trialorder]->selected_card."','".$myarr[$trialorder]->final_score."','admin','admin','".$date_val."','".$myarr[$trialorder]->time_track."'),";
}
$str=trim($str, ",");
mysqli_query($con,"INSERT INTO `igt_expr_data`( `mid`, `experid`,  `trialno`,`initial_total`,`cash_A_win`,`cash_A_lose`,`cash_B_win`,`cash_B_lose`,`cash_C_win`,`cash_C_lose`,`cash_D_win`,`cash_D_lose`,`selected_card`,`final_total`,`created_by`,`modified_by`,`created_at`,`tracktime`)
VALUES ".$str);	
$con->disconnect();
?>

