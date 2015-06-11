<?php
error_reporting(1);
session_start();
include 'include/class/oe_databasemanager.php';
include 'users/controller/user_dbo.php';
$experimentid =$_SESSION['exp'];
$participantid =$_SESSION['MID'];
$random=$_SESSION['random_val'];
$trials_atttempted=$_SESSION['trials_atttempted'];
print_r($_SESSION['dataparticipant_main']);
$date_val=date("Y-m-d H:i:s");
$con=mysqli_connect("DBHOST","DBUSER","DBPASS","DBNAME");
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
for($i=0;$i<$trials_atttempted;$i++){
$trail=$i+1;
$str.="('".$participantid."','".$experimentid."','".$trail."','".$_SESSION['dataparticipant_main'][$i]['stimuli']."','".$_SESSION['dataparticipant_main'][$i]['cor_res']."','".$_SESSION['dataparticipant_main'][$i]['response']."','".$_SESSION['dataparticipant_main'][$i]['score']."','admin','admin','".$date_val."','A'),";
}
$str=trim($str, ",");
mysqli_query($con,"INSERT INTO `nback_expr_data`(`mid`, `experid`,  `trialno`, `stimuli`, `corres`, `response`, `score`, `created_by`, `modified_by`, `created_at`,`exp_flag`) VALUES ".$str);	
$practice_values=$_SESSION['practice_values'];
mysqli_query($con,"INSERT INTO `nback_expr_data`(`mid`, `experid`,  `trialno`, `stimuli`, `corres`, `response`, `score`, `created_by`, `modified_by`, `created_at`,`exp_flag`) VALUES ".$practice_values);	
?>

