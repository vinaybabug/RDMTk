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

