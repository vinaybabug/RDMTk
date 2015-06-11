<?php

class UserDBO
{
 
	 protected $db;

	  public function viewFieldsExperimentCond($input,$cond)
     {
	 
		$db = new OE_DataBaseManager();
		$db->connect();
		$db->sql('SELECT '.$input.' FROM experiments  where '.$cond);
		$res = $db->getResult();
                $db->disconnect();
		return json_encode($res);

     }

	public function viewFieldsParticipantCond($fields,$cond)
     {
	 
		$db = new OE_DataBaseManager();
		$db->connect();
		$db->sql('SELECT '.$fields.' FROM bart_expr_data where '.$cond);
		$res = $db->getResult();
                $db->disconnect();
		return json_encode($res); 
     }	
     
} 
?>

