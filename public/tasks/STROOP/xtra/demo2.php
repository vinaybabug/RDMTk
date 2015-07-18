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
$click_main=$_SESSION['sessionvalue_main'];
$list_data_main=$_SESSION['list_data_main'];
$experimentid =$_SESSION['exp'];
$participantid =$_SESSION['MID'];
$trials_atttempted=$_SESSION['trials_atttempted'];
$currenttrial=$_GET['currenttrial'];
$_SESSION['dataparticipant_main'][$click_main]['trail']=$click;
$_SESSION['prev_char']=0;
$initial_char_main= $list_data_main[$click_main]->char_value;
$_SESSION['dataparticipant_main'][$_SESSION['sessionvalue_main']]['stimuli']=$initial_char_main;
$_SESSION['initial_char_main']=$initial_char_main;
$previous_char_count=0;

if($click_main>=3){
$previous_char_count=$click_main-2;
$prev_char= $list_data_main[$previous_char_count]->char_value;
$_SESSION['prev_char_main']=$prev_char;
if($prev_char==$initial_char_main){
$_SESSION['space']=1;
$_SESSION['dataparticipant_main'][$click_main]['score']=2;
$_SESSION['dataparticipant_main'][$click_main]['cor_res']=1;

}else{
$_SESSION['dataparticipant_main'][$click_main]['score']=4;
$_SESSION['dataparticipant_main'][$click_main]['cor_res']=0;
$_SESSION['dataparticipant_main'][$click_main]['response']=0;	
}
}else{
$_SESSION['dataparticipant_main'][$click_main]['score']=4;
$_SESSION['dataparticipant_main'][$click_main]['cor_res']=0;
$_SESSION['dataparticipant_main'][$click_main]['response']=0;	
}

$_SESSION['sessionvalue_main']=$_SESSION['sessionvalue_main']+1;

 ?>
<div id="s_timer" style="display:none;">0<span>3</span>:00</div>
	<?php echo $initial_char_main; ?>
<script> 
$(document).ready(function(){
var char_present="<?php echo $initial_char_main; ?>";
var trails_attempted=<?php echo $trials_atttempted;?>;
var trails_no=<?php echo $_SESSION['sessionvalue_main'];?>;
if(trails_no>3){
var prev_no="<?php echo $prev_char;?>";

}
var sec = 3;
												
												var timer = setInterval(function() { 
												
													$('#s_timer span').text(sec--);
													if (sec =="-1") {
													if(trails_attempted>trails_no){
														$.ajax({url:"demo2.php",success:function(result){
														  $("#main_card_main_test").html(result);
														  $("#main_card_main_test").css("border-color", "black");
														  $("#main_card_main_test").css("font-size", "1100%");
														   	$("#main_card_main_test").css("color", "black");
														  clearTimeout(timer);
														}}); 
													}
													if(trails_attempted==trails_no){
														$.ajax({url:"final_main.php",success:function(result){
														 $("#main_card").css('display','none');
														 $("#main_card_main_test").css('display','block');
													window.location="demo.php?&exp=<?php echo $experimentid;?>&MID=<?php echo $participantid;?>";
														}}); 
													}
													} 
												}, 300);
});
</script>



