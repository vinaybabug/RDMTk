<?php


    //$string = file_get_contents("your_data.json");
    //$dataObject = json_decode($string, true);
    $str ="";
    $dataObject = $_POST; //Fetching all posts
    
    
    //file_put_contents('your_data.txt', $json);
    $con=mysqli_connect("DBHOST","DBUSER","DBPASS","DBNAME");
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