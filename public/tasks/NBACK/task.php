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


error_reporting(1);
session_start();
ob_start(); 
$_SESSION['sessionvalue']=0;
$_SESSION['sessionvalue_main']=0;
include 'include/class/oe_databasemanager.php';
include 'users/controller/user_dbo.php';
 $experimentid= $_GET['exp'];
$participantid= $_GET['MID'];
$userdbo = new UserDBO();
$viewusers= $userdbo->viewFieldsExperimentCond('nooftrials,urllink,confirmationcode','id="'.$experimentid.'"');
$viewusers = json_decode($viewusers);
$countexists=count($viewusers);
if(($countexists > 0)&&($participantid!==""))
{
$_SESSION['dataparticipant']=array();
$_SESSION['dataparticipant_main']=array();
$_SESSION['exp']=$experimentid;
$_SESSION['MID']=$participantid;
$trials_atttempted = $viewusers[0]->nooftrials;
$viewexpts= $userdbo->viewFieldsParticipantCond('*','mid="'.$participantid.'" and experid="'.$experimentid.'" order by trialno');
$viewexpts = json_decode($viewexpts);
$trialno = count($viewexpts);
$list_data_json= $userdbo->listdata('*','WHERE 1');
$list_data = json_decode($list_data_json);
$_SESSION['list_data_json']=$list_data_json;
$_SESSION['list_data']=$list_data;
$trialattempted_pract = count($list_data);
$list_data_main_json= $userdbo->listdata_main('*','LIMIT '.$trials_atttempted.'');
$list_data_main = json_decode($list_data_main_json);
$_SESSION['list_data_main_json']=$list_data_main_json;
$_SESSION['list_data_main']=$list_data_main;
$trialno = count($viewexpts);
$paytot = count($viewexpts);
$paytot=$paytot-1;
if($trialno > 0)
{
	$initial_char= $list_data[$paytot]->score_values;
	$initial_char_main= $list_data_main[$paytot]->score_values;
}
else
{
	$initial_char= $list_data[0]->score_values;
	$initial_char_main= $list_data_main[0]->score_values;
	$_SESSION['initial_char']=$initial_char;
	$_SESSION['initial_char_main']=$initial_char_main;
	$_SESSION['dataparticipant'][$_SESSION['sessionvalue']]['stimuli']=$initial_char;
	$_SESSION['dataparticipant_main'][$_SESSION['sessionvalue_main']]['stimuli']=$initial_char_main;
	$random=$viewusers[0]->confirmationcode;
	$_SESSION['random_val']=$random;
}
$random=$_SESSION['random_val'];
$_SESSION['trials_atttempted']=$trials_atttempted;
$_SESSION['trialattempted_pract']=$trialattempted_pract;

$_SESSION['clicks']=$trialno;
$trialno = $trialno+1;
if($trialno <= $trials_atttempted)
{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Welcome to the Card Gambling </title>
<script type="text/javascript" src="src/js/jquery.min.js"></script>

<link rel="stylesheet" type="text/css" href="src/css/demo.css">
<style>

#pick_text{
	font-family: Arial;
	font-size: 300%;
	color: royalblue;
	margin-left:40%;
}

#cont_total{
    border: 1px solid #000;
    height: 26px;
    overflow:hidden;
    width:50%;
	background:#00FF00;
}

</style>
<script> 
$(document).ready(function(){
	var click_val=<?php echo $trialno-1;?>;
	var char_val='<?php echo $initial_char;?>';
	var click_val_main='<?php echo $_SESSION['sessionvalue_main'];?>';
	var char_val_main='<?php echo $initial_char_main;?>';
	if(click_val==0){
		$('#main_process_bar').css('display', 'none');
		$('#main_texts').css('display', 'none');
		$('#main_card').css('display', 'none');
	}
	$('#start').click(function(){
	$('#main_card').css('display', 'block');
		$('#start').css('display', 'none');
		$('#welcometext').css('display', 'none');
	click_val=click_val+1;
	$.ajax({ type: 'POST',
						url:"task1.php",
						data: { 
							'click': click_val,
							'result':char_val
						},
						success:function(result){
						 $("#main_card").html(result);						 
						}
						});

		
	});
	$('#practice_test').click(function(){
	 	window.location="task.php?&exp=<?php echo $experimentid;?>&MID=<?php echo $participantid;?>";
	 });
	$('#start_main').click(function(){
	
	$("#main_test_text").css('display','none');
	$("#main_card_main_test").css('display','block');
	$("#main_card_main_test").html(char_val_main);
	
	$.ajax({ type: 'POST',
						url:"task2.php",
						data: { 
							'click': click_val_main,
							'result':char_val_main
						},
						success:function(result){
						 $("#main_card_main_test").html(result);						 
						}
						});
						
	
	});
	
$(document.body).keyup(function (evt) {
 if(<?php echo $_SESSION['sessionvalue']; ?> <=<?php echo $trialattempted_pract;?>){

	var char_press=evt.keyCode;
	$.ajax({ type: 'POST',
						url:"score.php",
						data: { 
							'char_press': char_press,
						},
						success:function(result){
					if(char_press==32){
						$("#main_card_main_test").css("font-size", "1500%");
						$("#main_card").css("font-size", "1500%");
						if(result==1){
							$("#main_card").css("color", "green");
							$("#main_card_main_test").css("color", "green");
						}else{
							$("#main_card").css("color", "red");
							$("#main_card_main_test").css("color", "red");
						}
					}else{
						$("#main_card_main_test").css("color", "black");
					}					 
						}
						});
						}
						
});

});
</script>
</head>
<body>
<div style="width:100%;height:100%">
	<div style="width:100%;height:10%;" id="bartappheading">
		<h3>Welcome to N-Back</h3>
		<div id="s_timer" style="display:none;">0<span>3</span>:00</div>
		
	</div>
	<?php
	if($trialno==1){
	?>
		<div align="left" style="width:90%;height:90%; margin-top: 3%; padiing:6%" id="welcometext">
			<p style="font-size: 109%;font-family: Arial;">Using your right hand, put your thumb on the spacebar.</p>
			<p style="font-size: 109%;font-family: Arial;">You will see a string of letters presented one at a time.if the letters you saw is the same as the letter before the last one,press the spacebar as soon as you can.</p>
			<p style="font-size: 109%;font-family: Arial;">For example,if you see a sequence line '...m k h k p...',then you should press the spacebar on the second 'k'.</p>
			<p style="font-size: 109%;font-family: Arial;">Press on Start button when you are ready to start a short practice.</p>
			<div style="color: #084285;font-size: x-large;">
			Good luck!
			</div>
			<input type="button" id="start" value="Start" style="background: none repeat scroll 0 0 #084285;color: white;font-size: x-large;height: -4%;margin-left: 44%;"/>
		</div>

	<?php
	}
	?>
	
	<input type="hidden" id="currenttrial" name="currenttrial" value=""  >
			<input type="hidden" id="totaltrial" value="">
				<input type="hidden" id="present_char" value=""  >
			<input type="hidden" id="previous_char" value="0">
			<input type="hidden" id="score" value="">
			
	<div id="main_card" style="width:17%;margin-top:12%;display:block;font-size:1100%;margin-left:37%" align="center">
	
	<?php echo $initial_char; ?>
	</div>
	<div id="main_test_text" style="width:100%;margin-top:12%;display:none;font-size:200%;">
	This is the End of the Practice.Please press start button below.
	<input type="button" name="start" id="start_main" value="Start"/>
	<input type="button" name="practice_test" id="practice_test" value="Practice test"/>
	</div>
	<div id="main_card_main_test" style="width:17%;margin-top:12%;display:none;font-size:1100%;margin-left:37%" align="center">
	
	<span><?php echo $initial_char_main; ?></span>
	
	
	</div>
</div>

<?php 
 }
 else
 {
 ?>
<div style="width:100%;height:10%;" id="bartappheading">
	<h1 style="color: rgb(8, 66, 133)">Welcome to the Card Gambling</h1>
</div>
<div align="left" style="width:90%;height:90%; margin-top: 3%; padiing:6%;font-family: arial;" id="welcometext">
 Thank you for your participation in this task.<br> 

 Please note the <strong>Confirmation code: <?php echo $random; ?></strong>. Please input this in the survey that directed you to this experiment. That will allow you to continue on with the HIT and get paid for your time.
</div>
<?php 
}
}
else
{
?>
Sorry, Your URL Does Not Match Our Database, Please Get The Right URL And Get Back to Us Later.
<?php 
}
?>
</body>
</html>


