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
$url=$_SESSION['currenturlink'];
$con=mysqli_connect("DBHOST","DBUSER","DBPASS","DBNAME");
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

