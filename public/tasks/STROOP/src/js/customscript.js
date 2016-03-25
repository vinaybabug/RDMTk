<script>
$(document).ready(function(){
 var new1 =0;
 var dynscore= 0.00;
$("#startappbutton").click(function() {
$('#startappbutton').css("display","none");
$('#welcometext').css("display","none");
$('#stopappbutton').css("display","block");
$('#wholediv').css("display","block");

//$('#stopappbutton').prop('disabled', false);
});
$("#stopappbutton").click(function() {
$('#wholediv').css("display","none");
$('#stopappbutton').css("display","none");
$('#s_timer').css("display","block");
$('#trialnextattempt').css("display","block");
var earnings= $('#dyntotalscore').val();
var totalearnings= $('#dyntotalsessionscore').val();
totalearnings=parseInt(totalearnings)+parseInt(earnings);
totalearnings=totalearnings.toFixed(2);
var clicks= new1;
//alert(earnings);
$('#dyntotalsessionscoretext').text(totalearnings);
$('#trialnextattempttext').text(" Your Total Earings for this trial is "+earnings );
  $.ajax({url:"assignend.php?clicks="+clicks+"&earnings="+earnings,success:function(result){
		  $("#dynamicbal").html(result);
		}});
	
	var sec = 3;
var timer = setInterval(function() { 
   $('#s_timer span').text(sec--);
   if (sec == -1) {
window.location.href = "<?php echo $_SESSION['currenturlink']; ?>";
   } 
}, 1000);

});

$("#IncreaseImageSize").click(function() {

    var balloon = $("#balloon");
	var stem = $("#stem");
	var holder = $("#holder");
//var imgWidth=    $(img).css("width");
var upwidth=    $('#imgWidth').val(); 
var upheight=   $('#imgHeight').val(); 
 new1 =new1 +1;
  var upstemheight =  $('#stemheight').val(); 
  var upstemwidth=   $('#stemwidth').val(); 

var updivwidth =  $('#divwidth').val(); 
  var updivheight=   $('#divheight').val(); 
    var chkarr= $('#chkarr').val(); 
	
	   if (chkarr != 'yes')
    {	
	dynscore = dynscore + 10.00;
	dynscore1=(dynscore).toFixed(2);
	$('#dyntotalscore').val(dynscore1);
	var totearnings1= $('#dyntotalsessionscore').val();
	var totearnscore=parseInt(dynscore)+parseInt(totearnings1);
	totearnscore1=(totearnscore).toFixed(2);
	var dynscoretext='Current score : '+dynscore1+' Total score : '+totearnscore1;
		$('#dynscore').text(dynscoretext);
		
        balloon.animate({width: upwidth+"px", height: upheight+"px"}, "fast");
		holder.animate({width: updivwidth+"px", height: updivheight+"px"}, "fast");
		stem.animate({width: upstemwidth+"px", height: upstemheight+"px"},"fast");
		  $.ajax({url:"assigndyn.php?imgWidth="+upwidth+"&imgHeight="+upheight+"&stemwidth="+upstemwidth
		  +"&stemheight="+upstemheight+"&divwidth="+updivwidth+"&divheight="+updivheight+"&chkarr="+chkarr,success:function(result){
		  $("#dynamicbal").html(result);
		}});
    }
     else
    {	
    $('#IncreaseImageSize').prop('disabled', true);
    holder.css("display","none");
		var subholder = $("#subholder");
		var burstb = $("#burstb");
        burstb.animate({width: upwidth+"px", height: upheight+"px"}, "fast");
		subholder.css("display","block");
		subholder.animate({width: upwidth+"px", height: upheight+"px"}, "fast");
			$.ajax({url:"assignclose.php?imgWidth="+upwidth+"&imgHeight="+upheight+"&stemwidth="+upstemwidth
		  +"&stemheight="+upstemheight+"&divwidth="+updivwidth+"&divheight="+updivheight+"&chkarr="+chkarr,success:function(result){
		  $("#dynamicbal").html(result);
		  $('#stopappbutton').css("display","none");
		  
		  $('#dynscore').css("display","none");
		   $('#IncreaseImageSize').css("display","none");
		$('#trialnextattempt').css("display","block");
		var totalearnings= $('#dyntotalsessionscore').val();
		var earnings= 0;
		totalearnings=parseInt(totalearnings)+parseInt(earnings);
		totalearnings=totalearnings.toFixed(2);
		$('#dyntotalsessionscoretext').text(totalearnings);
		$('#trialnextattempttext').text(" Your Total Earings for this trial is "+earnings );
		}});
		
		
    }
});
});
</script>
