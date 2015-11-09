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


include 'include/class/oe_databasemanager.php';
include 'users/controller/user_dbo.php';
$fields = 'id,option_a,option_b';
$table = 'delayed_discount_que';
$experimentid= $_GET['exp'];
$participantid= $_GET['MID'];
$count = 1;
$cols='nooftrials,mouse_track,select_dataset';

/*  Fetch all the Questions from the Database */
$db = new OE_DataBaseManager();
$db->connect();
$db->sql('SELECT '.$cols .' FROM experiments WHERE id="'.$experimentid.'"');
$trial= $db->getResult();
$mouse_track = $trial[0]['mouse_track'];
$no_trials = $trial[0]['nooftrials'];
$dataset = $trial[0]['select_dataset'];
$db->sql('SELECT '.$fields.' FROM '.$table.' WHERE dataset_name="'.$dataset.'"');//. ' WHERE id>0 LIMIT '.$no_trials);
$res = $db->getResult();
$total_que= count($res);
$db->disconnect();
$userdbo = new UserDBO();
$viewexpts = $userdbo->viewFieldsParticipantCond('*', 'mid="' . $participantid . '" and experid="' . $experimentid . '" order by trialno');
$viewexpts = json_decode($viewexpts); 
$trialAttempted = count($viewexpts);
if($trialAttempted>0){

 	$url = 'http://' . $_SERVER['HTTP_HOST'];            // Get the server
    $url .= rtrim(dirname($_SERVER['PHP_SELF']), '/\\'); // Get the current directory
    $url .= '/end.php?exp='.$experimentid.'&MID='.$participantid;         
    header('Location: ' . $url, true, 302);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charser="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="author" content="Sherry">
	<title>Delayed Discounting task</title>
	
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="../../js/jquery.min.js"></script>
	<script type="text/javascript" src="../../js/track.js"></script>
</head>
<body onload="nxt()">
	<div class="container-fluid" >
		<div class="row col-md-12 text-center" style="padding-top:70px;">
			                
            
				<h3>Que. What would you rather prefer:
</h3>				
   <!--  The following script iterates through the questions and changes the contents of HTML DOM element holding the question everytime an option is selected -->           
  <script type="text/javascript">
    var jsonExpData = {data:[]};
    var clicks = 0;
	var z=0;
    var arr=<?php echo json_encode($res);?>;
    var count=<?php echo $no_trials; ?>;
    var total_que=<?php echo $total_que;?>;
    var nums = new Array();
    var ranNums = new Array();
    
    <?php  
    //order of the questions is randomized if do_random variable is set     
    	if($_POST['do_random']=="RANDOM"){
	    	echo 'for(z=0;z<total_que;z++)
			nums[z]=z;
			var i = count;
		    var j = 0;
			while (i--) {
				j = Math.floor(Math.random() * (total_que-1));
				ranNums.push(nums[j]);
				nums.splice(j,1);
				}';
    		}
    		elseif($_POST['do_random']=="FIXED"){

    			echo 'for(z=0;z<count;z++)
					ranNums[z]=z;';
    		}
    ?>			
    	function select_a(){

    		var current = 'a';
    		nxt(current);
    	}

    	function select_b(){

    		var current = 'b';
    		nxt(current);
    	}
    		
    	function nxt(current) {			 
    		var uri = "<?php  echo 'http://' . $_SERVER['SERVER_NAME'].str_replace('init.php','storedata.php',$_SERVER['PHP_SELF']) ; ?>"; 
			if(clicks>=count){
				<?php if($mouse_track==1){

                        echo '$("#unload").trigger("click");';
                    }
                    ?>
                jsonExpData.data.push({
	        		mid: "<?php echo $participantid; ?>",
                    experid: "<?php echo $experimentid; ?>",
                    que_id: arr[ranNums[clicks-1]]['id'],
                   	option_selected:current,
                   	trialno:clicks
                });

                $.ajax({
                        type: "POST",
                        url: uri,         
                        data: jsonExpData,                                   
                        dataType: "json"
                    }).done(function(){

                    	alert("data sent!");
                    });
				window.location.href="end.php?exp=<?php echo $experimentid;?>&MID=<?php echo $participantid;?>";
			}
	        else { 
        
	        	if(clicks>0){
	        	jsonExpData.data.push({
	        		mid: "<?php echo $participantid; ?>",
                    experid: "<?php echo $experimentid; ?>",
                    que_id: arr[ranNums[clicks-1]]['id'],
                   	option_selected:current,
                   	trialno:clicks
                });  }
                
	        	document.getElementById("clicks").innerHTML = (clicks+1);
				z=(clicks)*100/(count);
				document.getElementById("que1").innerHTML =arr[ranNums[clicks]]['option_a'];
				document.getElementById("que2").innerHTML =arr[ranNums[clicks]]['option_b'];
				document.getElementById("pro").style.width = z+"%";
				document.getElementById("progressdetail").innerHTML =Math.floor(z)+"% complete" ;
			} clicks += 1;
    }

   
    </script>
   	</div>
   	
		<div class="row" >
			<div class="col-md-6 text-center" style="padding-top:60px;">
				<button type="button" disabled ="disabled" class="btn btn-default">A</button>
				<span id="que1"> <?php //echo $res[0]['option_a']; ?></span>
			</div>
			
			<div class="col-md-6 text-center" style="padding-top:60px;">
				<button type="button" disabled ="disabled" class="btn btn-default">B</button>
				<span id="que2"> <?php //echo $res[0]['option_b']; ?></span>
			</div>
		</div>
		<br>
		<br><br>
        
        
        
        
		<div class="row text-center" >
        <button type="button" class="btn btn-success" style="width:100px;" onclick="select_a()">A</button>
        &nbsp; &nbsp; 
        <button type="button" class="btn btn-success" style="width:100px;" onclick="select_b()">B</button>
    <p>question No: <span id="clicks">1</span></p> 
    <br><br><br><br><br><br>
		
		<div class="progress">
			<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="11" area-valuemin="0" area-valuemax="100" id="pro" ><a id="progressdetail">0% Complete</a></div>
			</div>
		</div>
	</div>
</body>
</html>