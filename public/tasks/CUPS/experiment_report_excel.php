<?php
error_reporting(0);	
ob_start();
  	   $host = "localhost";    
	   $user = "root";
       $password = "password";
       $db = "cupapp";
       $dbConn = mysql_connect($host,$user,$password)or die("Error: Could not connect to server.");
       if($dbConn){ 
               mysql_select_db($db)or die("Error: Could not connect to database.");
       }
  if(isset($_GET['experimentname'])){
	if(!empty($_GET['experimentname']))
	{
	$experiment=$_GET['experimentname'];
	}
	else{
	$experiment="1";
	
	}}else{
	$experiment="1";
	
	}
 

header( "Content-Type: application/vnd.ms-excel" );
header( "Content-disposition: attachment; filename=ExperimentResults.xls" );
$y=mysql_query("SELECT oe_experiments.experimentname as experimentid,oe_participants.mid as mid,oe_participants.uniquecode as uniquecode,oe_participants.cupsnumber as cupsnumber ,oe_participants.trialno as trialno,oe_participants.amountshown as amountshown,oe_participants.paytrial as paytrial,oe_participants.paytotal as paytotal,oe_participants.paychoice as paychoice,oe_participants.participantchoice as participantchoice,participantposition as participantposition,oe_participants.position as position,oe_participants.date_created as date_created,oe_participants.time_taken as time_taken, oe_participants.cup_color FROM oe_participants 
		join oe_experiments
		ON oe_participants.experimentid = oe_experiments.id
		 WHERE ".$experiment." order by experimentname, mid, trialno");
		 echo 'MID' . "\t" . 'Experiment Name'   ."\t" .'Confirmation Code' . "\t" . 'Number Of Cups'   ."\t" . 'Trial No' 
 ."\t" . 'Amount Shown'
 ."\t" . 'Pay Choices'
 ."\t" . 'Participant Choice'
 ."\t" . 'Position'
  ."\t" . 'Participant Position'
 ."\t" . 'Trial Points'
 ."\t" . 'Risky or Certain'
 ."\t" . 'Domain'
 ."\t" . 'Trial Result'
 ."\t" . 'Total Points' 
 ."\t" . 'Date Created'
 ."\t" . 'Time Taken'. "\n";
		 while($row=mysql_fetch_array($y))
		 {
		 // Calculate trial result
		$trial_result="LOSS";
		if(($row['amountshown']>0 && $row['paytrial'] == $row['amountshown']) || ($row['amountshown']<0 && $row['paytrial'] == 0) || ($row['amountshown']>0 && $row['paytrial'] == 1))
		{
			$trial_result="WIN";
		}		
		else{
			$trial_result="LOSS";
		}
		// determine domain
		$domain = "";
		if($row['cup_color']=='blue'){
			$domain = "Gain";
		}
		else{
			$domain = "Loss";
		}
		$risky = "Risky";
		if($row['paytrial'] == 1 || $row['paytrial'] == -1){
		$risky = "Certain";
		}
		
		
echo  $row['mid']. "\t" . $row['experimentid'] ."\t" .$row['uniquecode']. "\t" . $row['cupsnumber'] ."\t" 
. $row['trialno'] ."\t" 
. $row['amountshown'] ."\t" 
. $row['paychoice'] ."\t" 
. $row['participantchoice'] ."\t" 
. $row['position'] ."\t" 
. $row['participantposition'] ."\t" 
. $row['paytrial'] ."\t" 
. $risky ."\t" 
. $domain ."\t" 
. $trial_result ."\t" 
. $row['paytotal'] ."\t" 
. $row['date_created'] ."\t" 
. $row['time_taken']   . "\n"; //$row['index'] the index here is a field name
}
 
  ?>