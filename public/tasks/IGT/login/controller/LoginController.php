<?php

class LoginController
 {
     public $id;
     public $user_name;
     public $password;


	 public function loginSuccess($data)
     {
			$db = new OE_DataBaseManager();
			$db->connect();
			$db->select('oe_users','user_name,password,id',NULL,'user_name="'.$data['user_name'].'" and password="'.$data['password'].'" and user_role != "Participant"'); 
			$res = $db->getResult();
			if($res)
			{			
			session_start(); 
			$_SESSION['oe_user_username']=$data['user_name'];
			$_SESSION['oe_user_id']=$data['id'];
			header('Location:index.php');
			}
			else
			{
			header('Location:index.php');
			}
     }
	  public function logout()
     {
			session_unset();
			header('Location:index.php');
     }
	
	 
}

?>

