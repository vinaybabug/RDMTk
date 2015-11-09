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

/* Retrieves the experiment id and user id allotted  */
$experimentid= $_GET['exp'];
$participantid= $_GET['MID']; 

include 'include/class/oe_databasemanager.php';
$fields = 'expertrial_outcome_type';
$table = 'experiments';
$db = new OE_DataBaseManager();
$db->connect();
$db->sql('SELECT '.$fields.' FROM '.$table.' WHERE id="'.$experimentid.'"');
$res = $db->getResult();

$db->disconnect();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charser="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="author" content="PraneetSoni">
	<title>Delayed Discounting Task Intro</title>
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href= "css/style.css" rel ="stylesheet" type="text/css">
	<link href='http://fonts.googleapis.com/css?family=Slabo+27px' rel='stylesheet' type='text/css'>
</head>
<body>
<div class="container">
	
	
	<div class="row" style="padding-top:5px;padding-bottom:5px;">	
		<div class="col-md-12">
			<img src="img/front.jpg" style="height:410px;" class="img-responsive center-block">
		</div>	
	</div>
	<div class="row" style="padding-top:5px;padding-bottom:5px;">
		<div class="col-md-12">
			<h1>Welcome to Delayed Discount Task</h1>
			<br>
			<p> You will be presented with a series of choices in which you must indicate preference in a form to receive a given quantity of money, for example, between "R$1.00 now" or "R$10.00 in a year's time."
			</p>
			
			<!--checks the value of do_random field and sends the value retrieved to the nxt page -->
			<form action=<?php echo "init.php?exp=".$experimentid."&MID=".$participantid ?> method="POST">
			<input class="btn btn-success active" type="submit" value ="Submit" style ="width:100px;">
			<input type="hidden" name="do_random" value="<?php echo $res[0]['expertrial_outcome_type'];  ?>">
			</form>
		</div>

	</div>
</div>

</body>
</html>