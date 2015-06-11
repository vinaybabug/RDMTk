<?php
error_reporting(1);
session_start();
include 'include/class/oe_databasemanager.php';
include 'users/controller/user_dbo.php';
$experimentid =$_SESSION['exp'];
$participantid =$_SESSION['MID'];
$random=$_SESSION['random_val'];
$click=$_POST['click'];
$myarr=$_POST['result'];
$myarr_p=$_SESSION['arry_p'];
$con=mysqli_connect("localhost","root","password","rdmtoolkit");
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$date_val=date("Y-m-d H:i:s");
for($i=1;$i<=$click;$i++){
if($myarr[$i][response]==68){
  $response_value="RED";
}
if($myarr[$i][response]==70){
  $response_value="YELLOW";
}
if($myarr[$i][response]==74){
  $response_value="GREEN";
}
if($myarr[$i][response]==75){
  $response_value="BLUE";
}
if($response_value==$myarr[$i][corrResp])
{
$score=1;
}else{
$score=0;
}
$str.="('".$participantid."','".$experimentid."','".$i."','".$myarr[$i][word]."','".$myarr[$i][corrResp]."','".$response_value."','".$score."','admin','admin','".$date_val."','A','".$myarr[$i][time_track]."'),";
}
$str=trim($str, ",");
mysqli_query($con,"INSERT INTO `stroop_expr_data`(`mid`, `experid`, `trialno`, `word`, `corres`, `response`, `score`, `created_by`, `modified_by`, `created_at`, `exp_flag`, `tracktime`) VALUES ".$str);

mysqli_query($con,"INSERT INTO `stroop_expr_data`(`mid`, `experid`, `trialno`, `word`, `corres`, `response`, `score`, `created_by`, `modified_by`, `created_at`, `exp_flag`, `tracktime`) VALUES ".$myarr_p);	
?>

