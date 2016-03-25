<?php

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
	 
	 public function AssignParticipantExperiment($data)
     {
		$db = new OE_DataBaseManager();
		$db->connect();
		$dbo = new OE_DataBaseManager();
		$res_guid = $dbo->createId();
		$experimentid = $db->escapeString($data["experimentid"]);
		$mid = $db->escapeString($data["mid"]);
		$cupsnumber = $db->escapeString($data["cupsnumber"]);
		$amountshown = $db->escapeString($data["amountshown"]);
		$paychoice = $db->escapeString($data["paychoice"]);
		$participantchoice = $db->escapeString($data["participantchoice"]);
		$participantposition = $db->escapeString($data["participantposition"]);
		$position = $db->escapeString($data["position"]);
		$paytrial = $db->escapeString($data["paytrial"]);
		$uniquecode = $db->escapeString($data["uniquecode"]);	
		$paytotal = $db->escapeString($data["paytotal"]);
		$trialno = $db->escapeString($data["trialno"]);
		$urllink = $db->escapeString($data["urllink"]);
			
	$db->insert('oe_participants',array('id'=>$res_guid,
				'experimentid'=>$experimentid,
				'mid'=>$mid,
				'cupsnumber'=>$cupsnumber,
				'amountshown'=>$amountshown,
				'paychoice'=>$paychoice,
				'participantchoice'=>$participantchoice,
				'participantposition'=>$participantposition,
				'position'=>$position,
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
	
	 public function viewFieldsParticipant($input)
     {
	 
		$db = new OE_DataBaseManager();
		$db->connect();
		$db->sql('SELECT '.$input.' FROM oe_participants');
		$res = $db->getResult();
		return json_encode($res);

     }
	
	public function viewFieldsParticipantCond($fields,$cond)
     {
	 
		$db = new OE_DataBaseManager();
		$db->connect();
		$db->sql('SELECT '.$fields.' FROM cups_expr_data where '.$cond);
		$res = $db->getResult();
                $db->disconnect();
		return json_encode($res); 
     }	
	 public function viewJoinFieldsParticipantCond($cond)
     {
	 
		$db = new OE_DataBaseManager();
		$db->connect();
		$db->sql('SELECT oe_experiments.experimentname as experimentid,oe_participants.mid as mid,oe_participants.uniquecode as uniquecode,oe_participants.cupsnumber as cupsnumber ,oe_participants.trialno as trialno,oe_participants.amountshown as amountshown,oe_participants.paytrial as paytrial,oe_participants.paytotal as paytotal,oe_participants.paychoice as paychoice,oe_participants.participantposition as participantposition,oe_participants.participantchoice as participantchoice,oe_participants.position as position
		FROM oe_participants 
		join oe_experiments
		ON oe_participants.experimentid = oe_experiments.id
		where '.$cond);
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

