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
session_start();
ob_start();
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
$_SESSION['exp']=$experimentid;
$_SESSION['MID']=$participantid;
$total_trials = $viewusers[0]->nooftrials;
$viewexpts= $userdbo->viewFieldsParticipantCond('*','mid="'.$participantid.'" and experid="'.$experimentid.'" order by trialno');
$viewexpts = json_decode($viewexpts);
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
	$random=$viewusers[0]->confirmationcode;
	$_SESSION['random_val']=$random;
}
$random=$_SESSION['random_val'];
$_SESSION['clicks']=$trialno;
$trialno = $trialno+1;
if($trialno <= $total_trials)
{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Welcome to the Stroop </title>
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
	var practice=0;
	var main=0;
	var click_val=<?php echo $trialno-1;?>;
	var break_count=0;
	var data_trial = [[]];
	var data_trial_p = [[]];
	var data_word = [[]];
	var data_words = [[]];
	var data_word_p = [[]];
	var data_words_p = [[]];
	var myarr =[];
	var myarr_p =[];
	for(p=1; p<=36;p++){
		var j =(p - Math.floor((p - 1) / 9)*9);
		if((p<4)&&(j<4)){
			data_word_p[p] = new Array(1);
			data_word_p[p][0]="YELLOW";
			data_word_p[p][1]=1;
		}
		if((p>3)&&(p<7)&&(j<7)){
			data_word_p[p] = new Array(1);
			data_word_p[p][0]="RED";
			data_word_p[p][1]=1;
		}
		if((p>6)&&(p<10)&&(j<10)){
			data_word_p[p] = new Array(1);
			data_word_p[p][0]="BLUE";
			data_word_p[p][1]=1;
		}
		if((p>9)&&(p<13)&&(j<4)){
			data_word_p[p] = new Array(1);
			data_word_p[p][0]= "GREEN";
			data_word_p[p][1]=1;
		}
		if((p>12)&&(p<16)&&(j<7)){
			data_word_p[p] = new Array(1);
			data_word_p[p][0]= "RED";
			data_word_p[p][1]=2;
		}
		if((p>15)&&(p<19)&&(j<10)){
			data_word_p[p] = new Array(1);
			data_word_p[p][0]= "GREEN";
			data_word_p[p][1]=2;
		}
		if((p>18)&&(p<22)&&(j<4)){
			data_word_p[p] = new Array(1);
			data_word_p[p][0]= "BLUE";
			data_word_p[p][1]=2;
		}
		if((p>21)&&(p<25)&&(j<7)){
			data_word_p[p] = new Array(1);
			data_word_p[p][0]= "YELLOW";
			data_word_p[p][1]=2;
		}
		if((p>24)&&(p<28)&&(j<10)){
			data_word_p[p] = new Array(1);
			data_word_p[p][0]= "DEAL";
			data_word_p[p][1]=3;
		}
		if((p>27)&&(p<31)&&(j<4)){
			data_word_p[p] = new Array(1);
			data_word_p[p][0]= "FAITH";
			data_word_p[p][1]=3;
		}
		if((p>30)&&(p<34)&&(j<7)){
			data_word_p[p] = new Array(1);
			data_word_p[p][0]= "SYMBOL";
			data_word_p[p][1]=3;
		}
		if((p>33)&&(p<37)&&(j<10)){
			data_word_p[p] = new Array(1);
			data_word_p[p][0]= "TAX";
			data_word_p[p][1]=3;
		}
	}	
		for(i=1; i<=144;i++){
		var j =(i - Math.floor((i - 1) / 36)*36);
		if((i<37)&&(j<13)){
			data_word[i] = new Array(1);
			data_word[i][0]="YELLOW";
			data_word[i][1]=1;
		}
		if((i>36)&&(i<73)&&(j<13)){
			data_word[i] = new Array(1);
			data_word[i][0]="RED";
			data_word[i][1]=1;
		}
		if((i>72)&&(i<109)&&(j<13)){
			data_word[i] = new Array(1);
			data_word[i][0]="BLUE";
			data_word[i][1]=1;
		}
		if((i>108)&&(j<13)){
			data_word[i] = new Array(1);
			data_word[i][0]= "GREEN";
			data_word[i][1]=1;
		}
		if((i<37)&&(j>12)&&(j<17)){
			data_word[i] = new Array(1);
			data_word[i][0]= "RED";
			data_word[i][1]=2;
		}
		if((i<37)&&(j>16)&&(j<21)){
			data_word[i] = new Array(1);
			data_word[i][0]= "GREEN";
			data_word[i][1]=2;
		}
		if((i<37)&&(j>20)&&(j<25)){
			data_word[i] = new Array(1);
			data_word[i][0]= "BLUE";
			data_word[i][1]=2;
		}
		if((i > 36)&&(i < 73)&&(j > 12)&&(j < 17)){
			data_word[i] = new Array(1);
			data_word[i][0]= "YELLOW";
			data_word[i][1]=2;
		}
		if((i > 36)&&(i < 73)&&(j > 16)&&(j < 21)){
			data_word[i] = new Array(1);
			data_word[i][0]= "GREEN";
			data_word[i][1]=2;
		}
		if((i > 36)&&(i < 73)&&(j > 20)&&(j < 25)){
		
			data_word[i] = new Array(1);
			data_word[i][0]= "BLUE";
			data_word[i][1]=2;
		}
		if((i > 72)&&(i < 109)&&(j > 12)&&(j < 17)){
			data_word[i] = new Array(1);
			data_word[i][0]= "YELLOW";
			data_word[i][1]=2;
		}
		if((i > 72)&&(i < 109)&&(j > 16)&&(j < 21)){
			data_word[i] = new Array(1);
			data_word[i][0]= "RED";
			data_word[i][1]=2;
		}
		if((i > 72)&&(i < 109)&&(j > 20)&&(j < 25)){
			data_word[i] = new Array(1);
			data_word[i][0]= "BLUE";
			data_word[i][1]=2;
		}
		if((i > 108)&&(j > 12)&&(j < 17)){
			data_word[i] = new Array(1);
			data_word[i][0]= "YELLOW";
			data_word[i][1]=2;
		}
		if((i > 108)&&(j > 16)&&(j < 21)){
			data_word[i] = new Array(1);
			data_word[i][0]= "RED";
			data_word[i][1]=2;
		}
		if((i > 108)&&(j > 20)&&(j < 25)){
			data_word[i] = new Array(1);
			data_word[i][0]= "GREEN";
			data_word[i][1]=2;
		}
		if((j == 25)||(j == 26)||(j == 27)){
			data_word[i] = new Array(1);
			data_word[i][0]= "DEAL";
			data_word[i][1]=3;
		}
		if((j == 28)||(j == 29)||(j == 30)){
			data_word[i] = new Array(1);
			data_word[i][0]= "FAITH";
			data_word[i][1]=3;
		}
		if((j == 31)||(j == 32)||(j == 33)){
			data_word[i] = new Array(1);
			data_word[i][0]= "SYMBOL";
			data_word[i][1]=3;
		}
		if((j == 34)||(j == 35)||(j == 36)){
			data_word[i] = new Array(1);
			data_word[i][0]= "TAX";
			data_word[i][1]=3;
		}
	}
	if(click_val==0){
		$('#main_process_bar').css('display', 'none');
		$('#main_texts').css('display', 'none');
		$('#main_card').css('display', 'none');
	}
	data_word.shift();
	data_word_p.shift();
	var i = data_word_p.length, j, temp;
	while (( i-- > 1 ))
	{
		j = Math.floor( Math.random() * ( i + 1 ) );
		temp = data_word_p[i];
		data_word_p[i] = data_word_p[j];
		data_word_p[j] = temp;
	}
	
	for(j=1; j<=data_word_p.length;j++){
		data_words_p[j]=data_word_p[j-1];
	}
	/*for(i=1; i<data_word_p.length;i++){
		if(data_word_p[i][0] == 999)
			data_word_p[i]=data_trial_p[0];
	}*/
	var i = data_word.length, j, temp;
	while (( i-- > 1 ))
	{
		j = Math.floor( Math.random() * ( i + 1 ) );
		temp = data_word[i];
		data_word[i] = data_word[j];
		data_word[j] = temp;
	}
	for(j=1; j<=data_word.length;j++){
		data_words[j]=data_word[j-1];
	}
	/*for(i=1; i<data_word.length;i++){
			if(data_word[i][0] == 999)
					data_word[i]=data_trial[0];
	}*/
	myarr_p.push({word:0,corrResp:0,response:0,correct:0,start_time:new Date().getTime(),time_track:0});
	myarr_p.push({word:0,corrResp:0,response:0,correct:0,start_time:new Date().getTime(),time_track:0});
	myarr.push({word:0,corrResp:0,response:0,correct:0,start_time:new Date().getTime(),time_track:0});
	myarr.push({word:0,corrResp:0,response:0,correct:0,start_time:new Date().getTime(),time_track:0});
	$(document.body).keyup(function (evt) {
	var char_press=evt.keyCode;
	if(practice==0){
		if(click_val==0){
			if(char_press==32){ 
				click_val=click_val+1;
				$('#main_card_practice').css('display', 'block');
				$('#start').css('display', 'none');
				$('#welcometext').css('display', 'none');
				$("#main_card_practice").html(data_words_p[click_val][0]);
				myarr_p[click_val].word=data_words_p[click_val][0];
				if(data_words_p[click_val][1]==1){
					var color_val=data_words_p[click_val][0];
					myarr_p[click_val].corrResp=color_val;
				}
				if(data_words_p[click_val][1]==2){
					if(data_words_p[click_val][0]=="YELLOW"){
						var colors = ["RED","BLUE","GREEN"];
						var color_val = colors[Math.floor(Math.random() * colors.length)];
						myarr_p[click_val].corrResp=color_val;
					}
					if(data_words_p[click_val][0]=="RED"){
						var colors = ["YELLOW","BLUE","GREEN"];
						var color_val = colors[Math.floor(Math.random() * colors.length)];
						myarr_p[click_val].corrResp=color_val;
					}
					if(data_words_p[click_val][0]=="BLUE"){
						var colors = ["RED","YELLOW","GREEN"];
						var color_val = colors[Math.floor(Math.random() * colors.length)];
						myarr_p[click_val].corrResp=color_val;
					}
					if(data_words_p[click_val][0]=="GREEN"){
						var colors = ["RED","YELLOW","BLUE"];
						var color_val = colors[Math.floor(Math.random() * colors.length)];
						myarr_p[click_val].corrResp=color_val;
					}
				}
				if(data_words_p[click_val][1]==3){
					var colors = ["RED","YELLOW","BLUE","GREEN"];
					var color_val = colors[Math.floor(Math.random() * colors.length)];
					myarr_p[click_val].corrResp=color_val;
				}
				$("#main_card_practice").css('color',color_val);
			}
		}
		if(click_val!=0){
			if(char_press==68){ 
				myarr_p[click_val].response=char_press;
				click_val=click_val+1;
				$("#main_card_practice").html(data_words_p[click_val][0]);
				myarr_p[click_val].word=data_words_p[click_val][0];
				if(data_words_p[click_val][1]==1){
					var color_val=data_words_p[click_val][0];
				}
				if(data_words_p[click_val][1]==2){
					if(data_words_p[click_val][0]=="YELLOW"){
						var colors = ["RED","BLUE","GREEN"];
						var color_val = colors[Math.floor(Math.random() * colors.length)];
					}
					if(data_words_p[click_val][0]=="RED"){
						var colors = ["YELLOW","BLUE","GREEN"];
						var color_val = colors[Math.floor(Math.random() * colors.length)];
					}
					if(data_words_p[click_val][0]=="BLUE"){
						var colors = ["RED","YELLOW","GREEN"];
						var color_val = colors[Math.floor(Math.random() * colors.length)];
					}
					if(data_words_p[click_val][0]=="GREEN"){
						var colors = ["RED","YELLOW","BLUE"];
						var color_val = colors[Math.floor(Math.random() * colors.length)];
					}
				}
				if(data_words_p[click_val][1]==3){
					var colors = ["RED","YELLOW","BLUE","GREEN"];
					var color_val = colors[Math.floor(Math.random() * colors.length)];
				}
				$("#main_card_practice").css('color',color_val);
				myarr_p[click_val].corrResp=color_val;
			}
			if(char_press==70){ 
				myarr_p[click_val].response=char_press;
				click_val=click_val+1;
				$("#main_card_practice").html(data_words[click_val][0]);
				myarr_p[click_val].word=data_words_p[click_val][0];
				if(data_words_p[click_val][1]==1){
					var color_val=data_words_p[click_val][0];
				}
				if(data_words_p[click_val][1]==2){
					if(data_words_p[click_val][0]=="YELLOW"){
						var colors = ["RED","BLUE","GREEN"];
						var color_val = colors[Math.floor(Math.random() * colors.length)];
					}
					if(data_words_p[click_val][0]=="RED"){
						var colors = ["YELLOW","BLUE","GREEN"];
						var color_val = colors[Math.floor(Math.random() * colors.length)];
					}
					if(data_words_p[click_val][0]=="BLUE"){
						var colors = ["RED","YELLOW","GREEN"];
						var color_val = colors[Math.floor(Math.random() * colors.length)];
					}
					if(data_words_p[click_val][0]=="GREEN"){
						var colors = ["RED","YELLOW","BLUE"];
						var color_val = colors[Math.floor(Math.random() * colors.length)];
					}
				}
				if(data_words_p[click_val][1]==3){
					var colors = ["RED","YELLOW","BLUE","GREEN"];
					var color_val = colors[Math.floor(Math.random() * colors.length)];
				}
				$("#main_card_practice").css('color',color_val);
				myarr_p[click_val].corrResp=color_val;
			}
			if(char_press==74){
				myarr_p[click_val].response=char_press; 
				click_val=click_val+1;
				$("#main_card_practice").html(data_words_p[click_val][0]);
				myarr_p[click_val].word=data_words_p[click_val][0];
				if(data_words_p[click_val][1]==1){
					var color_val=data_words_p[click_val][0];
				}
				if(data_words_p[click_val][1]==2){
					if(data_words_p[click_val][0]=="YELLOW"){
						var colors = ["RED","BLUE","GREEN"];
						var color_val = colors[Math.floor(Math.random() * colors.length)];
					}
					if(data_words_p[click_val][0]=="RED"){
						var colors = ["YELLOW","BLUE","GREEN"];
						var color_val = colors[Math.floor(Math.random() * colors.length)];
					}
					if(data_words_p[click_val][0]=="BLUE"){
						var colors = ["RED","YELLOW","GREEN"];
						var color_val = colors[Math.floor(Math.random() * colors.length)];
					}
					if(data_words_p[click_val][0]=="GREEN"){
						var colors = ["RED","YELLOW","BLUE"];
						var color_val = colors[Math.floor(Math.random() * colors.length)];
					}
				}
				if(data_words_p[click_val][1]==3){
					var colors = ["RED","YELLOW","BLUE","GREEN"];
					var color_val = colors[Math.floor(Math.random() * colors.length)];
				}
				$("#main_card_practice").css('color',color_val);
				myarr_p[click_val].corrResp=color_val;
			}
			if(char_press==75){ 
				myarr_p[click_val].response=char_press;
				click_val=click_val+1;
				$("#main_card_practice").html(data_words_p[click_val][0]);
				myarr_p[click_val].word=data_words_p[click_val][0];
				if(data_words_p[click_val][1]==1){
					var color_val=data_words_p[click_val][0];
				}
				if(data_words_p[click_val][1]==2){
					if(data_words_p[click_val][0]=="YELLOW"){
						var colors = ["RED","BLUE","GREEN"];
						var color_val = colors[Math.floor(Math.random() * colors.length)];
					}
					if(data_words_p[click_val][0]=="RED"){
						var colors = ["YELLOW","BLUE","GREEN"];
						var color_val = colors[Math.floor(Math.random() * colors.length)];
					}
					if(data_words_p[click_val][0]=="BLUE"){
						var colors = ["RED","YELLOW","GREEN"];
						var color_val = colors[Math.floor(Math.random() * colors.length)];
					}
					if(data_words_p[click_val][0]=="GREEN"){
						var colors = ["RED","YELLOW","BLUE"];
						var color_val = colors[Math.floor(Math.random() * colors.length)];
					}
				}
				if(data_words_p[click_val][1]==3){
					var colors = ["RED","YELLOW","BLUE","GREEN"];
					var color_val = colors[Math.floor(Math.random() * colors.length)];
				}
				$("#main_card_practice").css('color',color_val);
				myarr_p[click_val].corrResp=color_val;
			}
			myarr_p.push({word:0,corrResp:0,response:0,correct:0,start_time:new Date().getTime(),time_track:0});
			var end_time=(parseInt(myarr_p[click_val+1].start_time)-parseInt(myarr_p[click_val].start_time))/1000;
			myarr_p[click_val+1].time_track=end_time;
			if(click_val==36){
				$.ajax({ type: 'POST',
					url:"final.php",
					data: { 
						'click': click_val,
						'result_p':myarr_p
					},
					success:function(result){
						click_val=0;
						practice=1;
						main=1;
						$('#main_test_text').css('display', 'block');
						$('#main_card_practice').css('display', 'none');
					}
				});
			}
		}
	}
	if(main==1){
		if(click_val==0){
			if(char_press==32){ 
				click_val=click_val+1;
				$('#main_test_text').css('display', 'none');
				$('#main_card').css('display', 'block');
				$('#start').css('display', 'none');
				$("#main_card").html(data_words[click_val][0]);
				myarr[click_val].word=data_words[click_val][0];
				if(data_words[click_val][1]==1){
					var color_val=data_words[click_val][0];
					myarr[click_val].corrResp=color_val;
				}
				if(data_words[click_val][1]==2){
					if(data_words[click_val][0]=="YELLOW"){
						var colors = ["RED","BLUE","GREEN"];
						var color_val = colors[Math.floor(Math.random() * colors.length)];
						myarr[click_val].corrResp=color_val;
					}
					if(data_words[click_val][0]=="RED"){
						var colors = ["YELLOW","BLUE","GREEN"];
						var color_val = colors[Math.floor(Math.random() * colors.length)];
						myarr[click_val].corrResp=color_val;
					}
					if(data_words[click_val][0]=="BLUE"){
						var colors = ["RED","YELLOW","GREEN"];
						var color_val = colors[Math.floor(Math.random() * colors.length)];
						myarr[click_val].corrResp=color_val;
					}
					if(data_words[click_val][0]=="GREEN"){
						var colors = ["RED","YELLOW","BLUE"];
						var color_val = colors[Math.floor(Math.random() * colors.length)];
						myarr[click_val].corrResp=color_val;
					}
				}
				if(data_words[click_val][1]==3){
					var colors = ["RED","YELLOW","BLUE","GREEN"];
					var color_val = colors[Math.floor(Math.random() * colors.length)];
					myarr[click_val].corrResp=color_val;
				}
				$("#main_card").css('color',color_val);
			}
		}
		if(((click_val==48)&&(break_count==0))||((click_val==96)&&(break_count==0))){
			$('#main_card').css('display', 'none');
			$('#break_page').css('display', 'block');
			if(char_press==32){ 
				$('#main_card').css('display', 'block');
				$('#break_page').css('display', 'none');
				$("#main_card").html(data_words[click_val][0]);
				break_count=break_count+1;	
			}
		}
		if(break_count==1){
			if(char_press==68){ 
				myarr[click_val].response=char_press;
				click_val=click_val+1;
				$("#main_card").html(data_words[click_val][0]);
				myarr[click_val].word=data_words[click_val][0];
				if(data_words[click_val][1]==1){
					var color_val=data_words[click_val][0];
				}
				if(data_words[click_val][1]==2){
					if(data_words[click_val][0]=="YELLOW"){
						var colors = ["RED","BLUE","GREEN"];
						var color_val = colors[Math.floor(Math.random() * colors.length)];
					}
					if(data_words[click_val][0]=="RED"){
						var colors = ["YELLOW","BLUE","GREEN"];
						var color_val = colors[Math.floor(Math.random() * colors.length)];
					}
					if(data_words[click_val][0]=="BLUE"){
						var colors = ["RED","YELLOW","GREEN"];
						var color_val = colors[Math.floor(Math.random() * colors.length)];
					}
					if(data_words[click_val][0]=="GREEN"){
						var colors = ["RED","YELLOW","BLUE"];
						var color_val = colors[Math.floor(Math.random() * colors.length)];
					}
				}
				if(data_words[click_val][1]==3){
					var colors = ["RED","YELLOW","BLUE","GREEN"];
					var color_val = colors[Math.floor(Math.random() * colors.length)];
				}
				$("#main_card").css('color',color_val);
				myarr[click_val].corrResp=color_val;
			}
			if(char_press==70){ 
				myarr[click_val].response=char_press;
				click_val=click_val+1;
				$("#main_card").html(data_words[click_val][0]);
				myarr[click_val].word=data_words[click_val][0];
				if(data_words[click_val][1]==1){
					var color_val=data_words[click_val][0];
				}
				if(data_words[click_val][1]==2){
					if(data_words[click_val][0]=="YELLOW"){
						var colors = ["RED","BLUE","GREEN"];
						var color_val = colors[Math.floor(Math.random() * colors.length)];
					}
					if(data_words[click_val][0]=="RED"){
						var colors = ["YELLOW","BLUE","GREEN"];
						var color_val = colors[Math.floor(Math.random() * colors.length)];
					}
					if(data_words[click_val][0]=="BLUE"){
						var colors = ["RED","YELLOW","GREEN"];
						var color_val = colors[Math.floor(Math.random() * colors.length)];
					}
					if(data_words[click_val][0]=="GREEN"){
						var colors = ["RED","YELLOW","BLUE"];
						var color_val = colors[Math.floor(Math.random() * colors.length)];
					}
				}
				if(data_words[click_val][1]==3){
					var colors = ["RED","YELLOW","BLUE","GREEN"];
					var color_val = colors[Math.floor(Math.random() * colors.length)];
				}
				$("#main_card").css('color',color_val);
				myarr[click_val].corrResp=color_val;
			}
			if(char_press==74){ 
				myarr[click_val].response=char_press;
				click_val=click_val+1;
				$("#main_card").html(data_words[click_val][0]);
				myarr[click_val].word=data_words[click_val][0];
				if(data_words[click_val][1]==1){
					var color_val=data_words[click_val][0];
				}
				if(data_words[click_val][1]==2){
					if(data_words[click_val][0]=="YELLOW"){
						var colors = ["RED","BLUE","GREEN"];
						var color_val = colors[Math.floor(Math.random() * colors.length)];
					}
					if(data_words[click_val][0]=="RED"){
						var colors = ["YELLOW","BLUE","GREEN"];
						var color_val = colors[Math.floor(Math.random() * colors.length)];
					}
					if(data_words[click_val][0]=="BLUE"){
						var colors = ["RED","YELLOW","GREEN"];
						var color_val = colors[Math.floor(Math.random() * colors.length)];
					}
					if(data_words[click_val][0]=="GREEN"){
						var colors = ["RED","YELLOW","BLUE"];
						var color_val = colors[Math.floor(Math.random() * colors.length)];
					}
				}
				if(data_words[click_val][1]==3){
					var colors = ["RED","YELLOW","BLUE","GREEN"];
					var color_val = colors[Math.floor(Math.random() * colors.length)];
				}
				$("#main_card").css('color',color_val);
				myarr[click_val].corrResp=color_val;
			}
			if(char_press==75){ 
				myarr[click_val].response=char_press;
				click_val=click_val+1;
				$("#main_card").html(data_words[click_val][0]);
				myarr[click_val].word=data_words[click_val][0];
				if(data_words[click_val][1]==1){
					var color_val=data_words[click_val][0];
				}
				if(data_words[click_val][1]==2){
					if(data_words[click_val][0]=="YELLOW"){
						var colors = ["RED","BLUE","GREEN"];
						var color_val = colors[Math.floor(Math.random() * colors.length)];
					}
					if(data_words[click_val][0]=="RED"){
						var colors = ["YELLOW","BLUE","GREEN"];
						var color_val = colors[Math.floor(Math.random() * colors.length)];
					}
					if(data_words[click_val][0]=="BLUE"){
						var colors = ["RED","YELLOW","GREEN"];
						var color_val = colors[Math.floor(Math.random() * colors.length)];
					}
					if(data_words[click_val][0]=="GREEN"){
						var colors = ["RED","YELLOW","BLUE"];
						var color_val = colors[Math.floor(Math.random() * colors.length)];
					}
				}
				if(data_words[click_val][1]==3){
					var colors = ["RED","YELLOW","BLUE","GREEN"];
					var color_val = colors[Math.floor(Math.random() * colors.length)];
				}
				$("#main_card").css('color',color_val);
				myarr[click_val].corrResp=color_val;
			}
			myarr.push({word:0,corrResp:0,response:0,correct:0,start_time:new Date().getTime(),time_track:0});
			var end_time=(parseInt(myarr[click_val+1].start_time)-parseInt(myarr[click_val].start_time))/1000;
			myarr[click_val+1].time_track=end_time;	
			if((click_val==49)||(click_val==97)){
				break_count=0;
			}
		}
		if((click_val!=0)&&(click_val!=48)&&(break_count==0)&&(click_val!=96)){
			if(char_press==68){ 
				myarr[click_val].response=char_press;
				click_val=click_val+1;
				$("#main_card").html(data_words[click_val][0]);
				myarr[click_val].word=data_words[click_val][0];
				if(data_words[click_val][1]==1){
					var color_val=data_words[click_val][0];
				}
				if(data_words[click_val][1]==2){
					if(data_words[click_val][0]=="YELLOW"){
						var colors = ["RED","BLUE","GREEN"];
						var color_val = colors[Math.floor(Math.random() * colors.length)];
					}
					if(data_words[click_val][0]=="RED"){
						var colors = ["YELLOW","BLUE","GREEN"];
						var color_val = colors[Math.floor(Math.random() * colors.length)];
					}
					if(data_words[click_val][0]=="BLUE"){
						var colors = ["RED","YELLOW","GREEN"];
						var color_val = colors[Math.floor(Math.random() * colors.length)];
					}
					if(data_words[click_val][0]=="GREEN"){
						var colors = ["RED","YELLOW","BLUE"];
						var color_val = colors[Math.floor(Math.random() * colors.length)];
					}
				}
				if(data_words[click_val][1]==3){
					var colors = ["RED","YELLOW","BLUE","GREEN"];
					var color_val = colors[Math.floor(Math.random() * colors.length)];
				}
				$("#main_card").css('color',color_val);
				myarr[click_val].corrResp=color_val;
			}
			if(char_press==70){ 
				myarr[click_val].response=char_press;
				click_val=click_val+1;
				$("#main_card").html(data_words[click_val][0]);
				myarr[click_val].word=data_words[click_val][0];
				if(data_words[click_val][1]==1){
					var color_val=data_words[click_val][0];
				}
				if(data_words[click_val][1]==2){
					if(data_words[click_val][0]=="YELLOW"){
						var colors = ["RED","BLUE","GREEN"];
						var color_val = colors[Math.floor(Math.random() * colors.length)];
					}
					if(data_words[click_val][0]=="RED"){
						var colors = ["YELLOW","BLUE","GREEN"];
						var color_val = colors[Math.floor(Math.random() * colors.length)];
					}
					if(data_words[click_val][0]=="BLUE"){
						var colors = ["RED","YELLOW","GREEN"];
						var color_val = colors[Math.floor(Math.random() * colors.length)];
					}
					if(data_words[click_val][0]=="GREEN"){
						var colors = ["RED","YELLOW","BLUE"];
						var color_val = colors[Math.floor(Math.random() * colors.length)];
					}
				}
				if(data_words[click_val][1]==3){
					var colors = ["RED","YELLOW","BLUE","GREEN"];
					var color_val = colors[Math.floor(Math.random() * colors.length)];
				}
				$("#main_card").css('color',color_val);
				myarr[click_val].corrResp=color_val;
			}
			if(char_press==74){
				myarr[click_val].response=char_press; 
				click_val=click_val+1;
				$("#main_card").html(data_words[click_val][0]);
				myarr[click_val].word=data_words[click_val][0];
				if(data_words[click_val][1]==1){
					var color_val=data_words[click_val][0];
				}
				if(data_words[click_val][1]==2){
					if(data_words[click_val][0]=="YELLOW"){
						var colors = ["RED","BLUE","GREEN"];
						var color_val = colors[Math.floor(Math.random() * colors.length)];
					}
					if(data_words[click_val][0]=="RED"){
						var colors = ["YELLOW","BLUE","GREEN"];
						var color_val = colors[Math.floor(Math.random() * colors.length)];
					}
					if(data_words[click_val][0]=="BLUE"){
						var colors = ["RED","YELLOW","GREEN"];
						var color_val = colors[Math.floor(Math.random() * colors.length)];
					}
					if(data_words[click_val][0]=="GREEN"){
						var colors = ["RED","YELLOW","BLUE"];
						var color_val = colors[Math.floor(Math.random() * colors.length)];
					}
				}
				if(data_words[click_val][1]==3){
					var colors = ["RED","YELLOW","BLUE","GREEN"];
					var color_val = colors[Math.floor(Math.random() * colors.length)];
				}
				$("#main_card").css('color',color_val);
				myarr[click_val].corrResp=color_val;
			}
			if(char_press==75){ 
				myarr[click_val].response=char_press;
				click_val=click_val+1;
				$("#main_card").html(data_words[click_val][0]);
				myarr[click_val].word=data_words[click_val][0];
				if(data_words[click_val][1]==1){
					var color_val=data_words[click_val][0];
				}
				if(data_words[click_val][1]==2){
					if(data_words[click_val][0]=="YELLOW"){
						var colors = ["RED","BLUE","GREEN"];
						var color_val = colors[Math.floor(Math.random() * colors.length)];
					}
					if(data_words[click_val][0]=="RED"){
						var colors = ["YELLOW","BLUE","GREEN"];
						var color_val = colors[Math.floor(Math.random() * colors.length)];
					}
					if(data_words[click_val][0]=="BLUE"){
						var colors = ["RED","YELLOW","GREEN"];
						var color_val = colors[Math.floor(Math.random() * colors.length)];
					}
					if(data_words[click_val][0]=="GREEN"){
						var colors = ["RED","YELLOW","BLUE"];
						var color_val = colors[Math.floor(Math.random() * colors.length)];
					}
				}
				if(data_words[click_val][1]==3){
					var colors = ["RED","YELLOW","BLUE","GREEN"];
					var color_val = colors[Math.floor(Math.random() * colors.length)];
				}
				$("#main_card").css('color',color_val);
				myarr[click_val].corrResp=color_val;
			}
			myarr.push({word:0,corrResp:0,response:0,correct:0,start_time:new Date().getTime(),time_track:0});
			var end_time=(parseInt(myarr[click_val+1].start_time)-parseInt(myarr[click_val].start_time))/1000;
			myarr[click_val+1].time_track=end_time;
			if(click_val==<?php echo $total_trials;?> || click_val==144){
				$.ajax({ type: 'POST',
					url:"final_main.php",
					data: { 
						'click': click_val,
						'result':myarr,
					},
					success:function(result){
					  window.location="task.php?&exp=<?php echo $experimentid;?>&MID=<?php echo $participantid;?>";
					}
				});
			}
		}
		}
	});
});
</script>
</head>
<body>
<div style="width:100%;height:100%">
	<div style="width:100%;height:10%;" id="bartappheading">
		<h3>Welcome to Stroop</h3>
		<div id="s_timer" style="display:none;">0<span>3</span>:00</div>
		
	</div>
	<?php
	if($trialno==1){
	?>
		<div align="left" style="width:90%;height:90%; margin-top: 3%; padiing:6%" id="welcometext">
			<p style="font-size: 109%;font-family: Arial;">In this task,you will be asked to name the color of the ink the words are printed in AS FAST AS YOU CAN, ignoring the word that is printed in each item.</p>
			<p style="font-size: 109%;font-family: Arial;">Now please put your left middle finger on 'D' ,left index finger on 'F',right index finger on 'J' and right middle finger on 'K'.</p>
                        <p style="font-size: 109%;font-family: Arial;">Please MEMORIZE which button to press in correspondence to different ink colors before you press <b>spacebar</b> to start a practice session.</p>
			
			<div style="color: #084285;font-size: x-large;">
			Good luck!
			</div>
			<img src="images/color.png" align="center" style="margin-top:5%;margin-left: 14%;" />
		</div>
			<div align="left" style="width:90%;height:90%; margin-top: 3%; padiing:6%;display:none" id="break_page">
			<p style="font-size: 109%;font-family: Arial;">Take a short break and  press <b>spacebar break_page</b> when you are ready.</p>
			
			<div style="color: #084285;font-size: x-large;">
			Good luck!
			</div>
			<img src="images/color.png" align="center" style="margin-top:5%;margin-left: 14%;" />
		</div>

	<?php
	}
	?>
	<input type="hidden" id="currenttrials" name="currenttrials" value=""  >
	<input type="hidden" id="currenttrial" name="currenttrial" value=""  >
			<input type="hidden" id="totaltrial" value="">
				<input type="hidden" id="present_char" value=""  >
			<input type="hidden" id="previous_char" value="0">
			<input type="hidden" id="score" value="">
			
	<div id="main_card" style="display:none;font-size: 743%;margin-top: 12%;" align="center">	
	
	</div>
	<div id="main_test_text" style="width:100%;margin-top:12%;display:none;font-size:200%;">
	This is the End of the Practice.Please press <b>spacebar</b> start main test.
	<img src="images/color.png" align="center" style="margin-top:5%;margin-left: 14%;" />
	</div>
	<div id="main_card_practice" style="display:none;font-size: 743%;margin-top: 12%;" align="center">
	</div>
</div>

<?php 
 }
 else
 {
 ?>

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


