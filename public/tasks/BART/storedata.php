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

    //$string = file_get_contents("your_data.json");
    //$dataObject = json_decode($string, true);
    $str ="";
    $dataObject = $_POST; //Fetching all posts
    
    
    //file_put_contents('your_data.txt', $json);
    $con=mysqli_connect("localhost","root","password","rdmtoolkit");
		// Check connection
		if (mysqli_connect_errno()) {
		  echo "false";
                  
		}
		/* storing into database */
		for($trialorder=0;$trialorder<count($dataObject['data']);$trialorder++)
		{	
			$paytrial = mysqli_real_escape_string($con, $dataObject['data'][$trialorder]['paytrial']);
			$paytotal = mysqli_real_escape_string($con, $dataObject['data'][$trialorder]['paytotal']);
			$noofpumps = mysqli_real_escape_string($con, $dataObject['data'][$trialorder]['noofpumps']);
			$uniquecode = mysqli_real_escape_string($con, $dataObject['data'][$trialorder]['uniquecode']);
			$experimentid = mysqli_real_escape_string($con, $dataObject['data'][$trialorder]['experimentid']);
			$mid = mysqli_real_escape_string($con, $dataObject['data'][$trialorder]['mid']);
			$stopindex = mysqli_real_escape_string($con, $dataObject['data'][$trialorder]['stopindex']);
			$trialno = mysqli_real_escape_string($con, $dataObject['data'][$trialorder]['trialno']);
			
			
			$timetrack = mysqli_real_escape_string($con, $dataObject['data'][$trialorder]['time']);
			$date_created = date("Y-m-d H:i:s");
			
			$str.="('".$paytrial."', '".$paytotal."',".$noofpumps.",'".$experimentid."','".$mid."',".$stopindex.", ".$trialno.",'".$timetrack."','".$date_created."','".$date_created."'),";
			//mysqli_query($con,"INSERT INTO oe_participants (paytrial, paytotal, noofpumps,uniquecode, experimentid, mid,stopindex,trialno, urllink, timetrack, date_created,date_modified)
			//VALUES ('".$paytrial."', '".$paytotal."',".$noofpumps.",'".$uniquecode."', '".$experimentid."','".$mid."',".$stopindex.", ".$trialno.",'".$urllink."','".$timetrack."','".$date_created."','".$date_created."')");
				
		}
		$str=trim($str, ",");
                mysqli_query($con,"INSERT INTO bart_expr_data (trial_pts, total_pts, noofpumps, experid, mid, trialstopindex,trialno, tracktime, created_at,updated_at) VALUES ".$str);
			
		mysqli_close($con);
	//echo $dataObject['data'][0]["paytrial"];
    //echo   "INSERT INTO bart_expr_data (trial_pts, total_pts, noofpumps, experid, mid, trialstopindex,trialno, tracktime, created_at,updated_at) VALUES ".$str;
    echo 'true'; 
?>
