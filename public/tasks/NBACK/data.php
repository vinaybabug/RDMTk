<?php
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