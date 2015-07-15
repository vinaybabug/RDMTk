<?php 
$experimentid= $_GET['exp'];
$participantid= $_GET['MID']; 

include 'include/databasemanager.php';
$fields = 'dorandom';
$table = 'random_table';
$db = new DataBaseManager();
$db->connect();
$db->sql('SELECT '.$fields.' FROM '.$table. ' LIMIT 1');
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
			<img src="http://placekitten.com/1170/300" class="img-responsive">
		</div>	
	</div>
	<div class="row" style="padding-top:5px;padding-bottom:5px;">
		<div class="col-md-12">
			<h1>Welcome to Delayed Discount Task</h1>
			<br>
			<p> You will be presented with a series of choices in which you must indicate preference in a form to receive a given quantity of money, for example, between "R$1.00 now" or "R$10.00 in a year's time."
			</p>
			<br>
			<form action=<?php echo "init.php?exp=".$experimentid."&MID=".$participantid ?> method="POST">
			<input class="btn btn-success active" type="submit" value ="Submit" style ="width:100px;">
			<input type="hidden" name="do_random" value="<?php echo $res[0]['dorandom'];  ?>">
			</form>
		</div>

	</div>
	
</div>

</body>
</html>