<?php
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


