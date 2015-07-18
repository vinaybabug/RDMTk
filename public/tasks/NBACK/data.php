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
include 'include/class/oe_databasemanager.php';
include 'users/controller/user_dbo.php';
$clicks =$_POST['click'];

$c=$_SESSION['clicks'];
$_SESSION['clicks']=$c+1;
$list_data_json=$_SESSION['list_data_json'];
$list_data=$_SESSION['list_data'];
$score_values = $list_data[$clicks-1]->score_values;
			
	//echo $score_values;

?>
<script> 
$(document).ready(function(){
	var click_val=<?php echo $clicks-1;?>;
	var char_val='<?php echo $initial_char;?>';
	var starttimesec = new Date().getTime();
		//myarr.push({initial_char:char_val,final_score:0,selected_card:0,date_created:starttimesec,time_track:0});
		//var t=myarr[click_val].initial_total_score;
		$('#main_card').css('display', 'block');
		$('#start').css('display', 'none');
		$('#welcometext').css('display', 'none');
		//var value_char=myarr[click_val].initial_char;
		$('#main_card').html(char_val);
		var sec = 3;
		click_val=click_val+1;
				var timer = setInterval(function() { 
					$('#s_timer span').text(sec--);
					if (sec == -1) {
						$.ajax({ type: 'POST',
						url:"data.php",
						data: { 
							'click': click_val,
						},
						success:function(result){
						 $("#main_card_val").html(result);
							//window.location="demo1.php?&click="+click_val+"&result="+result+"&exp=<?php //echo $experimentid;?>&MID=<?php //echo $participantid;?>";
						}
						});
					}
				}, 200);
		
		

});
</script>