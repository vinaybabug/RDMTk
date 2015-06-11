<?php
session_start();
ob_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Behaviour Analysis Applications</title>
<link rel="stylesheet" type="text/css" href="src/css/treestyle.css">
<link rel="stylesheet" type="text/css" href="src/css/style.css">
<script type="text/javascript" src="src/js/TreeMenu.js"></script>
<script type="text/javascript" src="src/js/jquery.min.js"></script>

</head>

<body>
 <div class="ourcontainer">
 <div class="topcontainer">
 <h1>Behaviour Analysis Applications</h1>
 </div>
	 <div class="bottomcontainer">
	
		<div class="containerleftmenu">
			
			<?php
			if(isset($_SESSION['oe_user_username']))
				{
				include 'menu.php';
				}
				?>	
			</div>
			
			<div class="containerrightmenu">
				<?php
					include 'login/controller/LoginController.php';
					include 'include/class/oe_databasemanager.php';
					
					
					if(isset($_SESSION['oe_user_username']))
					{
						include 'users/controller/user_dbo.php';
						if(isset($_GET))
						{
							
							if(isset($_GET['logoutuser'])) 
							{							
								$loginform = new LoginController();
								$loginform->logout();
							}
							if(isset($_GET['createuser'])) 
							{
								include 'users/view/create.php';
							}
							if(isset($_GET['edituser'])) 
							{
								include 'users/view/edit.php';
							}
							if(isset($_GET['viewusers'])) 
							{
								include 'users/view/view.php';
							}
							if(isset($_GET['deleteuser'])) 
							{
								include 'users/view/delete.php';
							}
														
							if(isset($_GET['createexperiment'])) 
							{
								include 'users/view/createexperiment.php';
							}
							if(isset($_GET['viewexperiments'])) 
							{
								include 'users/view/viewexperiments.php';
							}
							
							if(isset($_GET['viewassignexperiments'])) 
							{
								include 'users/view/viewassignexperiments.php';
							}
						
						}

					  if(isset($_POST['SubmitUser']))
					 {
						
						 $userdbo = new UserDBO();
						$userdbo->createUser($_POST);
					 }	
					  if(isset($_POST['EditUser']))
					 {
						
						 $userdbo = new UserDBO();
						$userdbo->editUser($_POST);
					 }	
					  if(isset($_POST['DeleteUser']))
					 {
						
						 $userdbo = new UserDBO();
						$userdbo->deleteUser($_POST);
					 }
					 
					 if(isset($_POST['SubmitExperiment']))
					 {
						
						$experimentdbo = new UserDBO();
						$experimentdbo->AssignExperiment($_POST);
					 }	  
					  
				}
				else
				{
				
					include 'login/view/login.php';
					if(isset($_POST['SubmitLogin']))
					 {
						$login = new LoginController();
						$login->loginSuccess($_POST);
					 }	
						
				}
					
				?>
			</div>
        </div> 
		</div> 
</body>
</html>
 