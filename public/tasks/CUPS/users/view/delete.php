<h3>Delete User</h3>
<h4> Are you sure , you want to delete User with Name: <?php echo $_GET['name'];?></h4>


			  <form name="AddNewForm" id="add-new-form" method="post" action="">
  
	  <input  type="hidden" name="id" id="id" value="<?php echo $_GET['deleteuser']; ?>" />
      
	 <input type="submit" name="DeleteUser" id="DeleteUser" value="Delete">
	 <input action="action" type="button" value="Back" onclick="history.go(-1);" />
	 
  </form> 
 

