<?php 
include 'include/databasemanager.php';
$fields = 'id,option_a,option_b';
$table = 'delayed_discount_que';
$experimentid= $_GET['exp'];
$participantid= $_GET['MID'];
$count = 1;
$cols='nooftrials';

$db = new DataBaseManager();
$db->connect();
$db->sql('SELECT '.$cols .' FROM experiments WHERE id="'.$experimentid.'"');
$trial= $db->getResult();
$no_trials = $trial[0]['nooftrials'];
$db->sql('SELECT '.$fields.' FROM '.$table. ' WHERE id>0 LIMIT '.$no_trials);
$res = $db->getResult();

$db->disconnect();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charser="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="author" content="Sherry">
	<title>Delayed Discounting task</title>
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="css/task_style.css" rel="stylesheet" type="text/css">
</head>
<body onload="nxt()">
	<div class="container-fluid" >
		<div class="row col-md-12 text-center" style="padding-top:70px;">
			                
            
				<h3>Que. What would you rather prefer:
</h3>				
              
  <script type="text/javascript">
    var clicks = 0;
	var z=0;
    var arr=<?php echo json_encode($res);?>;
    var count=<?php echo $no_trials; ?>;
    var nums = new Array();
    var  ranNums = new Array();
    
    <?php  
    	if($_POST['do_random']){
	    	echo 'for(z=0;z<count;z++)
			nums[z]=z;
			var i = count;
		    var j = 0;
			while (i--) {
				j = Math.floor(Math.random() * (i));
				ranNums.push(nums[j]);
				nums.splice(j,1);
				}';
    		}
    		else{

    			echo 'for(z=0;z<count;z++)
					ranNums[z]=z;';
    		}
    ?>			
    		
    	function nxt() {			 

			if(clicks>=count)
				window.location.href="end.html";
	        else {
	        	document.getElementById("clicks").innerHTML = (clicks+1);
				z=(clicks)*100/(count);
				document.getElementById("que1").innerHTML =arr[ranNums[clicks]]['option_a'];
				document.getElementById("que2").innerHTML =arr[ranNums[clicks]]['option_b'];
				document.getElementById("pro").style.width = z+"%";
				document.getElementById("progressdetail").innerHTML =Math.floor(z)+" % complete" ;
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
        <button type="button" class="btn btn-success" style="width:100px;" onclick="nxt()">A</button>
        &nbsp; &nbsp; 
        <button type="button" class="btn btn-success" style="width:100px;" onclick="nxt()">B</button>
    <p>question No: <span id="clicks">1</span></p> 
    <br>
    
    

        
        
		<br><br>
		<br><br><br>
		<div class="progress">
			<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="11" area-valuemin="0" area-valuemax="100" id="pro" ><a id="progressdetail">0%Complete</a></div>
			</div>
		</div>
	</div>
</body>
</html>