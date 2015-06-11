  
 <?php echo "<h3>Welcome ".$_SESSION['oe_user_username']."</h3>"; ?>
  <ul>
							<li><a href="index.php?viewusers=true">View Users</a></li>
							<li><a href="index.php?createuser=true">Create Users</a></li>
							<li><a href="index.php?createexperiment=true">Create Experiment</a></li>
							<li><a href="index.php?viewexperiments=true">View Experiments</a></li>
							<li><a href="index.php?viewassignexperiments=true">View Experiment Results</a></li>
							<li><a href="index.php?logoutuser=true">LogOut</a></li>
						  </ul>