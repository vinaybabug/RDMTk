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


class UserDBO
 {
 
	 protected $db;
	
public function createUser($data)
     {
		$db = new OE_DataBaseManager();
		$db->connect();
		$dbo = new OE_DataBaseManager();
		$res_guid = $dbo->createId();
		$datauser = $db->escapeString($data["username"]);
		$datapwd = $db->escapeString($data["password"]);
		$datarole = $db->escapeString($data["userrole"]);

		
	$db->insert('oe_users',array('id'=>$res_guid,
				'user_name'=>$datauser,
				'password'=>$datapwd,
				'user_role'=>$datarole,
				'created_by'  => 'admin',
				 'modified_by'  => 'admin',
				 'date_modified'  => date("Y-m-d H:i:s"),
				 'date_created'  => date("Y-m-d H:i:s")));  // Table name, column names and respective values
	$res = $db->getResult();
	header('Location:index.php?viewusers=true');

     }
	public function AssignExperiment($data)
     {
		$db = new OE_DataBaseManager();
		$db->connect();
		$dbo = new OE_DataBaseManager();
		$res_guid = $dbo->createId();
		$datauser = $db->escapeString($data["experimentname"]);
		$datapwd = $db->escapeString($data["nooftrials"]);
		$datarole = $db->escapeString($data["experimentselect"]);
		$confirmationcode = $db->escapeString($data["confirmationcode"]);
		$weburl = $db->escapeString($data["weburl"]);
		
	$db->insert('oe_experiments',array('id'=>$res_guid,
				'experimentname'=>$datauser,
				'nooftrials'=>$datapwd,
				'experimentselect'=>$datarole,
				'confirmationcode'=>$confirmationcode,
				'urllink'=>$weburl.'?exp='.$res_guid.'&MID=MID',
				
				'created_by'  => 'admin',
				 'modified_by'  => 'admin',
				 'date_modified'  => date("Y-m-d H:i:s"),
				 'date_created'  => date("Y-m-d H:i:s")));  // Table name, column names and respective values
	$res = $db->getResult();
	header('Location:index.php?viewexperiments=true');

     }
	
	  public function viewFieldsExperiment($input)
     {
	 
		$db = new OE_DataBaseManager();
		$db->connect();
		$db->sql('SELECT '.$input.' FROM oe_experiments');
		$res = $db->getResult();
		return json_encode($res);

     }
	  public function viewFieldsExperimentCond($input,$cond)
     {
	 
		$db = new OE_DataBaseManager();
		$db->connect();
		$db->sql('SELECT '.$input.' FROM experiments  where '.$cond);
		$res = $db->getResult();
                $db->disconnect();
		return json_encode($res);

     }
	  public function getfinal_values($input,$cond)
     {
	 
		$db = new OE_DataBaseManager();
		$db->connect();
		$db->sql('SELECT '.$input.' FROM oe_data  where '.$cond);
		$res = $db->getResult();
		return json_encode($res);

     }
	 
	 public function AssignParticipantExperiment($data)
     {
		$db = new OE_DataBaseManager();
		$db->connect();
		$dbo = new OE_DataBaseManager();
		$res_guid = $dbo->createId();
		$experimentid = $db->escapeString($data["experimentid"]);
		$mid = $db->escapeString($data["mid"]);
		$stopindex = $db->escapeString($data["stopindex"]);
		$noofpumps = $db->escapeString($data["noofpumps"]);
		$paytrial = $db->escapeString($data["paytrial"]);
		$uniquecode = $db->escapeString($data["uniquecode"]);	
		$paytotal = $db->escapeString($data["paytotal"]);
		$trialno = $db->escapeString($data["trialno"]);
		$urllink = $db->escapeString($data["urllink"]);
			
	$db->insert('oe_participants',array('id'=>$res_guid,
				'experimentid'=>$experimentid,
				'mid'=>$mid,
				'stopindex'=>$stopindex,
				'noofpumps'=>$noofpumps,
				'paytrial'=>$paytrial,
				'uniquecode'=>$uniquecode,
				'paytotal'=>$paytotal,
				'trialno'=>$trialno,
				'urllink'=>$urllink ,
				'created_by'  => 'admin',
				 'modified_by'  => 'admin',
				 'date_modified'  => date("Y-m-d H:i:s"),
				 'date_created'  => date("Y-m-d H:i:s")));  // Table name, column names and respective values
	$res = $db->getResult();
	
     }
	  public function save_details($data)
     {
		$db = new OE_DataBaseManager();
		$db->connect();
		$dbo = new OE_DataBaseManager();
		$res_guid = $dbo->createId();
		//$id = $db->escapeString($data["id"]);
		$mid = $db->escapeString($data["mid"]);
		$exp_id = $db->escapeString($data["exp_id"]);
		$uniq_code = $db->escapeString($data["uniq_code"]);
		$trail_no = $db->escapeString($data["trail_no"]);
		$initial_cashpile = $db->escapeString($data["initial_cashpile"]);	
		$initial_borrow = $db->escapeString($data["initial_borrow"]);
		$initial_total = $db->escapeString($data["initial_total"]);
		$cash_A_win = $db->escapeString($data["cash_A_win"]);
		$cash_A_lose = $db->escapeString($data["cash_A_lose"]);
		$cash_B_win = $db->escapeString($data["cash_B_win"]);
		$cash_B_lose = $db->escapeString($data["cash_B_lose"]);
		$cash_C_win = $db->escapeString($data["cash_C_win"]);
		$cash_C_lose = $db->escapeString($data["cash_C_lose"]);
		$cash_D_win = $db->escapeString($data["cash_D_win"]);
		$cash_D_lose = $db->escapeString($data["cash_D_lose"]);	
		$selected_card = $db->escapeString($data["selected_card"]);
		$final_cashpile = $db->escapeString($data["final_cashpile"]);
		$final_borrow = $db->escapeString($data["final_borrow"]);
		$final_total = $db->escapeString($data["final_total"]);
			
	$db->insert('oe_data',array('id'=>$res_guid,
				'mid'=>$mid,
				'exp_id'=>$exp_id,
				'uniq_code'=>$uniq_code,
				'trail_no'=>$trail_no,
				'initial_cashpile'=>$initial_cashpile,
				'initial_borrow'=>$initial_borrow,
				'initial_total'=>$initial_total,
				'cash_A_win'=>$cash_A_win,
				'cash_A_lose'=>$cash_A_lose,
				'cash_B_win'=>$cash_B_win ,
				'cash_B_lose'=>$cash_B_lose,
				 'cash_C_win'  => $cash_C_win,
				 'cash_C_lose'  =>$cash_C_lose,
				 'cash_D_win'  => $cash_D_win,
				 'cash_D_lose'=>$cash_D_lose,
				 'selected_card'  => $selected_card,
				 'final_cashpile'  =>$final_cashpile,
				 'final_borrow'  => $final_borrow,
				 'final_total'  => $final_total));  // Table name, column names and respective values
	$res = $db->getResult();
	
     }
	
	
	 public function viewFieldsParticipant($input)
     {
	 
		$db = new OE_DataBaseManager();
		$db->connect();
		$db->sql('SELECT '.$input.' FROM oe_data');
		$res = $db->getResult();
		return json_encode($res);

     }
	
	public function viewFieldsParticipantCond($fields,$cond)
     {
	 
		$db = new OE_DataBaseManager();
		$db->connect();
		$db->sql('SELECT '.$fields.' FROM igt_expr_data where '.$cond);
		$res = $db->getResult();
                $db->disconnect();
		return json_encode($res); 
                
     }	
	 public function listdata($fields,$cond)
     {
	 
		$db = new OE_DataBaseManager();
		$db->connect();
		$db->sql('SELECT '.$fields.' FROM igt_score_cards '.$cond);
		$res = $db->getResult();
                $db->disconnect();
		return json_encode($res); 
     }	
	 public function viewJoinFieldsParticipantCond($cond)
     {
	 
		$db = new OE_DataBaseManager();
		$db->connect();
		$db->sql('SELECT oe_experiments.experimentname as experimentid,oe_data.mid as mid,oe_data.uniq_code as uniquecode,oe_data.trail_no as trialno,
		 oe_data.initial_cashpile as initial_cashpile,oe_data.initial_borrow as initial_borrow,oe_data.cash_A_win as cash_A_win,oe_data.cash_A_lose as cash_A_lose,oe_data.cash_B_win as cash_B_win,oe_data.cash_B_lose as cash_B_lose, oe_data.cash_C_win as cash_C_win,oe_data.cash_C_lose as cash_C_lose,oe_data.cash_D_win, oe_data.cash_D_lose as cash_D_lose,oe_data.selected_card as selected_card,oe_data.final_cashpile as final_cashpile,oe_data.final_borrow as final_borrow
		 FROM oe_data
		join oe_experiments
		ON oe_data.exp_id = oe_experiments.id
		 WHERE '.$cond);
		$res = $db->getResult();
		return json_encode($res); 
     }
	 
	 
	 
	 public function viewUser()
     {
	 
		$db = new OE_DataBaseManager();
		$db->connect();
		$db->sql('SELECT * FROM oe_users');
		$res = $db->getResult();
		return $res;

     }
	  public function selectUser($id)
     {
	 
		$db = new OE_DataBaseManager();
		$db->connect();
		$dataid = $db->escapeString($id);
		$db->select('oe_users','*',NULL,'id="'.$dataid.'"'); 
		$res = $db->getResult();
		return json_encode($res); 
		

     }
	  public function editUser($data)
     {
		$db = new OE_DataBaseManager();
		$db->connect();
		$dataid = $db->escapeString($data["id"]);
		 $datauser = $db->escapeString($data["username"]);
		 $datapwd = $db->escapeString($data["password"]);
		$datarole = $db->escapeString($data["userrole"]);	
		
		$db->update('oe_users',array('user_name'=>$datauser,  'password'=>$datapwd,'user_role'=>$datarole,
				 'modified_by'  => 'admin',
				 'date_modified'  => date("Y-m-d H:i:s")
				),'id="'.$dataid.'"'); 
		echo $res = $db->getResult();
		header('Location:index.php?viewusers=true');

     }
	  public function deleteUser($id)
     {
	
	 	$db = new OE_DataBaseManager();
		$db->connect();
		$db->delete('oe_users','id="'.$id['id'].'"');  // Table name, WHERE conditions
		$res = $db->getResult();
		header('Location:index.php?viewusers=true');

     }
	   public function viewFieldsUser($input)
     {
	 
		$db = new OE_DataBaseManager();
		$db->connect();
		$db->sql('SELECT '.$input.' FROM oe_users');
		$res = $db->getResult();
		return json_encode($res);

     }

	  public function viewConditionUser($fields,$cond)
     {
	 
		$db = new OE_DataBaseManager();
		$db->connect();
		$db->sql('SELECT '.$fields.' FROM oe_users where '.$cond);
		$res = $db->getResult();
		return json_encode($res); 
     }
} 
?>

