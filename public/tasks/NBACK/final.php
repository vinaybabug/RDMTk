<?php
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

