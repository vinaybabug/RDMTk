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
$list_data=$_SESSION['data'];

$cupno = $_SESSION['data'][$clicks]['cupno'];
$pay = $_SESSION['data'][$clicks]['pay'];
	echo $cupno.",".$pay;

?>