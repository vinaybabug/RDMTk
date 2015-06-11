<?php
	if(isset($_POST['submit'])){

	$experimentname="`exp_id`='".$_POST['experimentname']."'";
  header("location:experiment_report_excel.php?experimentname=".$experimentname);    
  }
if (isset($_GET["pages"])) { $pages  = $_GET["pages"]; } else { $pages=1; };
//$start_from = ($pages-1) * 5;
$userdbo = new UserDBO();
/*$viewusers= $userdbo->viewJoinFieldsParticipantCond($experimentname.' LIMIT '.$start_from.', 5');
$viewusers = json_decode($viewusers);
$countuser=count($viewusers);
*/
	
	//$experimentdbo = new UserDBO();
	$viewexperiments= $userdbo->viewFieldsExperiment('experimentname,id');
	$viewexperiments = json_decode($viewexperiments);
	//print_r($viewexperiments);
	$countexperiments=count($viewexperiments);
	

?>

<script>

 $(function() {
     $("#search_button").click(function(){
	// alert("zvjhfbKJZn");
		var experimentname=document.getElementById("experimentname").value;
				
		$(location).attr("href", "index.php?viewassignexperiments=true&experimentname="+experimentname);
		
		
 
 });
   
	

  });

   </script>
<h3>View Experiment Results</h3>
<div class="slidingDiv">
<form action="" method="post">
<table>
<tr>
<td>
<b>Choose Experiment:</b>
</td>
<td>

  <select id="experimentname"  name="experimentname" value="" required>
  <option></option>
		<?php
			for($i=0;$i<$countexperiments;$i++){	
			?>
			<option value="<?php echo $viewexperiments[$i]->id; ?>"><?php echo $viewexperiments[$i]->experimentname; ?></option>
			<?php
			} 
			?>
      
     </select>
</td>
<td>

  <input type="submit" id="download" name="submit" value="Download Report"> 

</td>
</tr>
</table>
</form>
<!--<button id="search_button">search</button>
</div>
<table cellspacing="2" cellpadding="2">
	<tr><th>MID</th>	<th>Experiment Name</th>	<th>Confirmation Code</th>	<th>Trial No</th>
	<th>Initial Cash</th> <th>Initial Borrow</th>	<th>A Win</th> <th>A Lose</th> <th>B Win</th>	<th>B Lose</th>
	<th>C Win</th> <th>C Lose</th>	<th>D Win</th> <th>D Lose</th>	<th>Selected Card</th> <th>Final Cash</th> <th>Final Borrow</th>
	</tr>

$viewusersall= $userdbo->viewFieldsParticipant('count(*) as exprecords');
$viewusersall = json_decode($viewusersall);
/* $sql="SELECT COUNT(distinct `quote_id`) FROM `wp_view_cart_quote` WHERE $transaction AND $status AND $dates";
$rs_result = mysql_query($sql); 
$row = mysql_fetch_row($rs_result);  
$total_records =  $viewusersall[0]->exprecords;
//echo "recs".$total_records;
$total_pages = ceil($total_records / 5); 
  //echo "recpages".$total_pages;
$is_first = $pages == 1;
$is_last  = $pages == $total_pages;
// Prev cannot be less than one
$prev = max(1, $pages - 1);

// Next cannot be larger than $pages_count
$next = min($total_pages , $pages + 1);

if($total_pages > 0) {
  
  // If we are on page 2 or higher 
  if(!$is_first) {
      echo '<a href="index.php?viewassignexperiments=true&pages=1">FIRST</a> &nbsp;&nbsp;&nbsp;&nbsp;';
      echo '<a href="index.php?viewassignexperiments=true&pages='.$prev.'">PREVIOUS</a>';
  }

  echo '&nbsp;&nbsp;<span>Page <b>'.$pages.'</b> / <b>'.$total_pages.'</b></span>&nbsp;&nbsp;';

  // If we are not at the last page
  if(!$is_last) {
      echo '<a href="index.php?viewassignexperiments=true&pages='.$next.'">NEXT</a>&nbsp;&nbsp;&nbsp;&nbsp;';
      echo '<a href="index.php?viewassignexperiments=true&pages='.$total_pages.'">LAST</a>';
  }
}-->