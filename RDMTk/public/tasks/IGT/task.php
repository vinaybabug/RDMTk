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
include 'include/class/oe_databasemanager.php';
include 'users/controller/user_dbo.php';
 $experimentid= $_GET['exp'];
$participantid= $_GET['MID'];
$db = new OE_DataBaseManager();
$db->connect();
$db->sql('SELECT mouse_track FROM experiments WHERE id="'.$experimentid.'"');
$trial= $db->getResult();
$db->disconnect();
$mouse_track = $trial[0]['mouse_track'];
$userdbo = new UserDBO();
$viewusers= $userdbo->viewFieldsExperimentCond('nooftrials,urllink,confirmationcode','id="'.$experimentid.'"');
$viewusers = json_decode($viewusers);
$countexists=count($viewusers);
if(($countexists > 0)&&($participantid!==""))
{
$trials_atttempted = $viewusers[0]->nooftrials;
$viewexpts= $userdbo->viewFieldsParticipantCond('*','mid="'.$participantid.'" and experid="'.$experimentid.'" order by trialno');
$viewexpts = json_decode($viewexpts);
$trialno = count($viewexpts);
$list_data_json= $userdbo->listdata('*','LIMIT '.$trials_atttempted.'');
$list_data = json_decode($list_data_json);
$_SESSION['list_data_json']=$list_data_json;
$_SESSION['list_data']=$list_data;
$trialno = count($viewexpts);
$paytot = count($viewexpts);
$paytot=$paytot-1;
if($trialno > 0)
{
	$final_final_total=$viewexpts[$paytot]->final_total;
}
else
{
	$final_final_total=4000;
	$random=$viewusers[0]->confirmationcode;
	$_SESSION['random_val']=$random;
}
$random=$_SESSION['random_val'];
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
<script type="text/javascript" src="../../js/track.js"></script>

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
	var plus_var=$('#cont').width();
	$('#start').click(function(){
		$('#main_process_bar').css('display', 'block');
		$('#main_texts').css('display', 'block');
		$('#main_card').css('display', 'block');
		$('#start').css('display', 'none');
		$('#welcometext').css('display', 'none');
	});
	var click_val=<?php echo $trialno-1;?>;
	var myarr =[];
	if(click_val==0){
	$('#main_process_bar').css('display', 'none');
		$('#main_texts').css('display', 'none');
		$('#main_card').css('display', 'none');
		var starttimesec = new Date().getTime();
		myarr.push({initial_total_score:4000,final_score:0,selected_card:0,date_created:starttimesec,time_track:0});
		var t=myarr[click_val].initial_total_score;
	}
	$('.card').click(function(){
		var time_click = new Date().getTime();
		var id= this.id;
		myarr.push({initial_total_score:0,final_score:0,selected_card:id,date_created:time_click,time_track:0});
		if(click_val!=0){
		var time_click1 = new Date().getTime();
			var t=myarr[click_val-1].final_score;
			myarr[click_val].initial_total_score=t;
		}else{
			myarr[click_val].selected_card=id;
		}
		
		var time_ui=myarr[click_val].date_created;
		var timetrack = (parseInt(time_click)-parseInt(time_ui))/1000;
		myarr[click_val].time_track=timetrack;
		click_val=click_val+1;
		var trial=<?php echo $trials_atttempted;?>;
		if(trial>=click_val){
		var data_v=[];
			$.ajax({ type: 'POST',
						url:"data.php",
						data: { 
							'click': click_val,
							'id':id
						},
						success:function(result){
							data_v=result.split(',');
							final_win=data_v[0];
							final_lose=data_v[1];
			var t=myarr[click_val-1].initial_total_score;
			var final_total=(+t + +(+final_win + +final_lose));
			myarr[click_val-1].final_score=final_total;
			if((final_win!=0)&&(final_lose!=0)){
				$('#lose_test').css('display','none');
				$('#win_test').css('display','block');
				$('#main_card').css('display','none');
				$('#main_process_bar').css('display','none');
				$('#pick_text').css('display','none');
				$("#win_text_number").text(" $"+final_win);
				var sec = 3;
				var timer = setInterval(function() { 
					$('#s_timer span').text(sec--);
					if (sec == -1) {
						$('#win_test').css('display','none');
						$('#lose_test').css('display','block');
						$('#lose_text').css('display','none');
						$("#lose_text_number").text(" But You Lost $"+final_lose);
						$('#main_card').css('display','none');
						$('#main_process_bar').css('display','none');
						$('#pick_text').css('display','none');
						var sec1= 3;
						var timer = setInterval(function() { 
							$('#s_timer1 span').text(sec1--);
							if (sec1 == -1) {
							
								$('#main_card').css('display','block');
								$('#main_process_bar').css('display','block');
								$('#pick_text').css('display','block');
								$('#lose_test').css('display','none');
								var clicks=click_val+1;
								$('#trail').html('Trial: '+clicks+'/'+trial);
								
							} 
						}, 200);	
					} 
				}, 200);
			}
			if((final_win!=0)&&(final_lose==0)){
				$('#win_test').css('display','block');
				$("#win_text_number").text(" $"+final_win);
				$('#main_card').css('display','none');
				$('#main_process_bar').css('display','none');
				$('#pick_text').css('display','none');
				var sec = 3;
				var timer = setInterval(function() { 
					$('#s_timer span').text(sec--);
					if (sec == -1) {
						$('#main_card').css('display','block');
						$('#main_process_bar').css('display','block');
						$('#pick_text').css('display','block');
						$('#win_test').css('display','none');
						var clicks=click_val+1;
						$('#trail').html('Trial: '+clicks+'/'+trial);
							
					} 
				}, 200);
			}
			if((final_lose!=0)&&(final_win==0)){
				('#lose_test').css('display','block');
				$("#borrow_amount").text("Previous Score $"+minus);
				$("#cash_pile_amount").text("Previous Score $"+plus);
				$('#main_card').css('display','none');
				$('#main_process_bar').css('display','none');
				$('#pick_text').css('display','none');
				var sec = 10;
				var timer = setInterval(function() { 
					$('#s_timer span').text(sec--);
					if (sec == -1) {
						$('#main_card').css('display','block');
						$('#main_process_bar').css('display','block');
						$('#pick_text').css('display','block');
						$('#lose_test').css('display','none');
						var clicks=click_val+1;
						$('#trail').html('Trial: '+clicks+'/'+trial);
						
					} 
				}, 200);
			}
			$("#final_score_value").text(final_total+"$");
			final_total_val=final_total/80;
			final_total_val=final_total_val*1;
			if(final_total<0){
				final_total_val_positive=Math.abs(final_total_val);
				$('#scale').attr('src','images/scale_down.jpg');
				if(final_total_val_positive>100){
					$('#scale').attr('src','images/db_scale_down.png');
					final_total_val_positive=final_total_val_positive/2;
				}
				$('#cont_total').css('background','#FF0000');
				$('#cont_total').animate({width: final_total_val_positive+'%'},100);
			}		
			if(final_total>0){
				$('#scale').attr('src','images/scale_up.jpg');
				if(final_total_val>100){
					$('#scale').attr('src','images/db_scale_up.png');
					final_total_val=final_total_val/2;
				}
				$('#cont_total').css('background','#00FF00');
				$('#cont_total').animate({width: final_total_val+'%'},100);
			}	
			if(final_total==0){
				$('#cont_total').animate({width: final_total_val+'%'}, 100);
			}
			
				
			var json = JSON.stringify(myarr);
			if(trial==click_val){
				<?php if($mouse_track==1){

                        echo '$("#unload").trigger("click");';
                    }
                    ?>
				$('#trail').css('display','none');
				$('#main_card').css('display','none');
				$.ajax({ type: 'POST',
						url:"score.php",
						data: { 
							'myarr': json, 
							'id': id ,
							'experimentid': '<?php echo $experimentid;?>', 
							'participantid': '<?php echo $participantid;?>',
							'random_val': '<?php echo $random;?>'
						},
						success:function(result){
							window.location="task.php?&exp=<?php echo $experimentid;?>&MID=<?php echo $participantid;?>";
						}
				 });
			}
			}
			});
		}else{
			window.location="task.php?&exp=<?php echo $experimentid;?>&MID=<?php echo $participantid;?>";
		}
	});
});
</script>
</head>
<body>
<div style="width:100%;height:100%">
	<div style="width:100%;height:10%;" id="bartappheading">
		<h3>Welcome to the card gambling game!</h3>
		<div id="s_timer" style="display:none;">0<span>3</span>:00</div>
		<div id="s_timer1" style="display:none;">0<span>3</span>:00</div>
	</div>
	<?php
	if($trialno==1){
	?>
		<div align="left" style="width:90%;height:90%; margin-top: 3%; padiing:6%" id="welcometext">
			<p><img align="center" src="images/gambling_screenshot1.png" style="width:64%;"/></p>
			<p style="font-size: 109%;font-family: Arial;">In this experiment, you will be asked to repeatedly select a card from one of the four decks above. You select a card by clicking the mouse on one of the decks.</p>
			<p style="font-size: 109%;font-family: Arial;">With each card, you can win some money. But you can also lose some. Some decks will be more profitable than others. Try to choose cards from the most profitable decks so that your total winnings will be as high as possible.</p>
			<p style="font-size: 109%;font-family: Arial;">You will get 100 chances to select a card from the decks that you think will give you the highest winnings. Your total earnings and the number of cards selected will be displayed on screen.</p>
			<p style="font-size: 109%;font-family: Arial;">You start with $4000.</p>
			<div style="color: #084285;font-size: x-large;">
			Good luck!
			</div>
			<input type="button" id="start" value="Start" style="background: none repeat scroll 0 0 #084285;color: white;font-size: x-large;height: -4%;margin-left: 44%;"/>
		</div>

	<?php
	}
	?>
	<div id="main_process_bar" style="width:100%;height:20%;display:block;">
		<div style="width: 68%; margin-left: 5%;">
			<img src="images/scale_up.jpg" style="margin-left: -6%;width: 71%;" id="scale" />
		</div>
		<div style="width:100%">
			<div style="width:5%;float:left;">  
				<div style=" font-family: arial;font-size: large;margin-left: -21%;">Amount:</div>
				<div style="font-family: arial;font-size: large;margin-left: -21%;" id="final_score_value"><?php echo $final_final_total;?>$</div>
			</div>

			<div style="width:35%;border:1px solid black;float:left;">
				<div id='cont_total' >
				</div>
			</div>
		</div>
		<div style="clear:both;"></div>
		<div id="trail" style="  background: none repeat scroll 0 0 #3399ff;color: #ffffff;float: right;font-size: xx-large;margin-right: 9%;margin-top: -4%;">Trails 1/<?php echo $trials_atttempted;?></div>
	</div>
	<div id="main_texts" style="width:100%;height:20%;margin-top: 3%;display:block;">
		<span id="pick_text" >Pick a Card</span>
		<div id="win_test" style="display:none;width:38%;margin-left:36%">
			<img src="images/1024px-Smiley.svg.png" style="width:30%;"/>
			<div style=" margin-left: -8%;margin-top: 3%;">
				<span id="win_text" style="font-size:xx-large;">You Won</span>
				<span id="win_text_number" style="font-size:xx-large;"></span>
			</div>
		</div>
		<div id="lose_test" style="display:none;width:38%;margin-left:36%">
			<img src="images/sad-smiley.png" style="width:30%;"/>
			<div style=" margin-left: -8%;margin-top: 3%;width:100%;">
				
				<span id="lose_text" style="font-size:xx-large;">You Lost</span>
				<span id="lose_text_number" style="font-size:xx-large;"></span>
			</div>
		</div>
	</div>
	<div id="main_card" style="width:100%;height:50%;margin-top: 3%; margin-left: 9%;display:block;">
		<div style="width:18%;float:left">
			<img src="images/DeckImage.jpg" id="card_A" class="card"/>
			<div id="card_a" style="font-size: xx-large;font-weight: bolder;margin-left: 30%;">A</div>
		</div>
		<div style="width:18%;float:left">
			<img src="images/DeckImage.jpg" id="card_B" class="card"/>
			<div id="card_b" style="font-size: xx-large;font-weight: bolder;margin-left: 30%;">B</div>
		</div>
		<div style="width:18%;float:left">
			<img src="images/DeckImage.jpg" id="card_C" class="card"/>
			<div id="card_c" style="font-size: xx-large;font-weight: bolder;margin-left: 30%;">C</div>
		</div>
		<div style="width:18%;float:left">
			<img src="images/DeckImage.jpg" id="card_D" class="card"/>
			<div id="card_d" style="font-size: xx-large;font-weight: bolder;margin-left: 30%;">D</div>
		</div>
	</div>
</div>

<?php 
 }
 else
 {
 ?>
<div style="width:100%;height:10%;" id="bartappheading">
	<h1 style="color: rgb(8, 66, 133)">Welcome to the card gambling game!</h1>
</div>
<div align="left" style="width:90%;height:90%; margin-top: 3%; padiing:6%;font-family: arial;" id="welcometext">
 Thank you for your participation in this task.<br> You earned   <strong> Total Score:$ <?php echo $final_final_total; ?></strong>.<br>

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


