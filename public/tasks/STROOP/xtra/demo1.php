<?php
error_reporting(1);
session_start();
ob_start(); 
$click=$_POST['click'];
$result=$_POST['result'];
$experimentid =$_SESSION['exp'];
$participantid =$_SESSION['MID'];
 ?>
<div id="s_timer" style="display:none;">0<span>3</span>:00</div>
	Take a short break and press Spacebar to start when you are ready.
<script> 
$(document).ready(function(){
var char_present="<?php echo $initial_char; ?>";
var trails=<?php echo $click;?>;							
	
</script>



