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


error_reporting(0);		
ob_start();
		$host = "localhost";
       $user = "root";
       $password = "password";
       $db = "stroop";
       
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
		 $y=mysql_query("SELECT oe_experiments.experimentname as experimentid,oe_data.mid as mid,oe_data.uniq_code as uniquecode,oe_data.trail_no as trialno,oe_data.word as word,oe_data.corres as corres,oe_data.response as response,oe_data.score as score,oe_data.date_created as date_created,oe_data.exp_flag as exp_flag,oe_data.time_track as time_track FROM oe_data join oe_experiments ON oe_data.exp_id = oe_experiments.id WHERE  ".$experiment." order by exp_flag, trialno");
		
		 echo 'MID' . "\t" . 'Experiment Name'   ."\t" .'Confirmation Code'  ."\t" . 'Trial No' 
 ."\t" . 'Word'
  ."\t" . 'Corres' ."\t" . 'Response'
  ."\t" . 'Score' ."\t"  . 'Date Created'."\t" . 'Exp Flag'."\t" . 'Time Taken'."\n";
		 while($row=mysql_fetch_array($y))
		 {
echo  $row['mid']. "\t" . $row['experimentid'] ."\t" .$row['uniquecode']. "\t"
. $row['trialno'] ."\t" 
. $row['word'] ."\t"  . $row['corres'] ."\t" 
. $row['response'] ."\t" . $row['score'] ."\t"  . $row['date_created']."\t" . $row['exp_flag']."\t" . $row['time_track']. "\n"; 
}
  ?>