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


class OE_DataBaseManager{
	/* 
	 * Create variables for credentials to MySQL database
	 * The variables have been declared as private. This
	 * means that they will only be available with the 
	 * Database class
	 */
		/*public $db_host = "localhost";  // Change as required
	public $db_user = "advaanz2_gambler";  // Change as required
	public $db_pass = "gambler";  // Change as required
	public $db_name = "advaanz2_gambling";	// Change as required*/

	public $db_host = "DBHOST"; // Change as required
    public $db_user = "DBUSER"; // Change as required
    public $db_pass = "DBPASS"; // Change as required
    public $db_name = "DBNAME"; // Change as required
	
	 /* Extra variables that are required by other function such as boolean con variable
	 */
	private $con = false; // Check to see if the connection is active
	private $result = array(); // Any results from a query will be stored here
        private $myQuery = "";// used for debugging process with SQL return
        private $numResults = "";// used for returning the number of rows
	
	// Function to make connection to database
	public function connect(){
	
			$myconn = @mysql_connect($this->db_host,$this->db_user,$this->db_pass);  // mysql_connect() with variables defined at the start of Database class
            if($myconn){
            	$seldb = @mysql_select_db($this->db_name,$myconn); // Credentials have been pass through mysql_connect() now select the database
                if($seldb){
                	$this->con = true;
                    return true;  // Connection has been made return TRUE
                }else{
                	
                    return false;  // Problem selecting database return FALSE
                }  
            }else{
            	
                return false; // Problem connecting return FALSE
            }  
        	
	}
	
	// Function to disconnect from the database
    public function disconnect(){
    	// If there is a connection to the database
    	if($this->con){
    		// We have found a connection, try to close it
    		if(@mysql_close()){
    			// We have successfully closed the connection, set the connection variable to false
    			$this->con = false;
				// Return true tjat we have closed the connection
				return true;
			}else{
				// We could not close the connection, return false
				return false;
			}
		}
    }
	
	public function sql($sql){
	//echo $sql;
		$query = @mysql_query($sql);
        $this->myQuery = $sql; // Pass back the SQL
		if($query){
			// If the query returns >= 1 assign the number of rows to numResults
			$this->numResults = mysql_num_rows($query);
			// Loop through the query results by the number of rows returned
			for($i = 0; $i < $this->numResults; $i++){
				$r = mysql_fetch_array($query);
               	$key = array_keys($r);
               	for($x = 0; $x < count($key); $x++){
               		// Sanitizes keys so only alphavalues are allowed
                   	if(!is_int($key[$x])){
                   		if(mysql_num_rows($query) >= 1){
                   			$this->result[$i][$key[$x]] = $r[$key[$x]];
						}else{
							$this->result = null;
						}
					}
				}
			}
			return true; // Query was successful
		}else{
			array_push($this->result,mysql_error());
			return false; // No rows where returned
		}
	}
	
	// Function to SELECT from the database
	public function select($table, $rows = '*', $join = null, $where = null, $order = null, $limit = null){
		// Create query from the variables passed to the function
		$q = 'SELECT '.$rows.' FROM '.$table;
		if($join != null){
			$q .= ' JOIN '.$join;
		}
        if($where != null){
        	$q .= ' WHERE '.$where;
		}
        if($order != null){
            $q .= ' ORDER BY '.$order;
		}
        if($limit != null){
            $q .= ' LIMIT '.$limit;
        }
        $this->myQuery = $q; // Pass back the SQL
		// Check to see if the table exists
        if($this->tableExists($table)){
        	// The table exists, run the query
        	$query = @mysql_query($q);
			if($query){
				// If the query returns >= 1 assign the number of rows to numResults
				$this->numResults = mysql_num_rows($query);
				// Loop through the query results by the number of rows returned
				for($i = 0; $i < $this->numResults; $i++){
					$r = mysql_fetch_array($query);
                	$key = array_keys($r);
                	for($x = 0; $x < count($key); $x++){
                		// Sanitizes keys so only alphavalues are allowed
                    	if(!is_int($key[$x])){
                    		if(mysql_num_rows($query) >= 1){
                    			$this->result[$i][$key[$x]] = $r[$key[$x]];
							}else{
								$this->result = null;
							}
						}
					}
				}
				return true; // Query was successful
			}else{
				array_push($this->result,mysql_error());
				return false; // No rows where returned
			}
      	}else{
      		return false; // Table does not exist
    	}
    }
	
	// Function to insert into the database
    public function insert($table,$params=array()){
    	// Check to see if the table exists
    	 if($this->tableExists($table)){
    	 	$sql='INSERT INTO `'.$table.'` (`'.implode('`, `',array_keys($params)).'`) VALUES ("' . implode('", "', $params) . '")';
			//echo $sql;
            $this->myQuery = $sql; // Pass back the SQL
            // Make the query to insert to the database
            if($ins = @mysql_query($sql)){
            	array_push($this->result,mysql_insert_id());
                return true; // The data has been inserted
            }else{
            	array_push($this->result,mysql_error());
                return false; // The data has not been inserted
            }
        }else{
        	return false; // Table does not exist
        }
    }
	
	//Function to delete table or row(s) from database
    public function delete($table,$where = null){
    	// Check to see if table exists
    	 if($this->tableExists($table)){
    	 	// The table exists check to see if we are deleting rows or table
    	 	if($where == null){
                $delete = 'DELETE '.$table; // Create query to delete table
            }else{
                $delete = 'DELETE FROM '.$table.' WHERE '.$where; // Create query to delete rows
            }
            // Submit query to database
            if($del = @mysql_query($delete)){
            	array_push($this->result,mysql_affected_rows());
                $this->myQuery = $delete; // Pass back the SQL
                return true; // The query exectued correctly
            }else{
            	array_push($this->result,mysql_error());
               	return false; // The query did not execute correctly
            }
        }else{
            return false; // The table does not exist
        }
    }
	
	// Function to update row in database
    public function update($table,$params=array(),$where){
    	// Check to see if table exists
    	if($this->tableExists($table)){
    		// Create Array to hold all the columns to update
            $args=array();
			foreach($params as $field=>$value){
				// Seperate each column out with it's corresponding value
				$args[]=$field.'="'.$value.'"';
			}
			// Create the query
			$sql='UPDATE '.$table.' SET '.implode(',',$args).' WHERE '.$where;
			// Make query to database
            $this->myQuery = $sql; // Pass back the SQL
            if($query = @mysql_query($sql)){
            	array_push($this->result,mysql_affected_rows());
            	return true; // Update has been successful
            }else{
            	array_push($this->result,mysql_error());
                return false; // Update has not been successful
            }
        }else{
            return false; // The table does not exist
        }
    }
	
	// Private function to check if table exists for use with queries
	private function tableExists($table){
		$tablesInDb = @mysql_query('SHOW TABLES FROM '.$this->db_name.' LIKE "'.$table.'"');
        if($tablesInDb){
        	if(mysql_num_rows($tablesInDb)==1){
                return true; // The table exists
            }else{
            	array_push($this->result,$table." does not exist in this database");
                return false; // The table does not exist
            }
        }
    }
	
	// Public function to return the data to the user
    public function getResult(){
        $val = $this->result;
        $this->result = array();
        return $val;
    }

    //Pass the SQL back for debugging
    public function getSql(){
        $val = $this->myQuery;
        $this->myQuery = array();
        return $val;
    }

    //Pass the number of rows back
    public function numRows(){
        $val = $this->numResults;
        $this->numResults = array();
        return $val;
    }

    // Escape your string
    public function escapeString($data){
        return mysql_real_escape_string($data);
    }
	//create id
    public function createId(){
        $t = time();
    $time = md5($t);

    $a = substr($time, 0, 8);

    $b = substr($time, 8, 4);

    $c = substr($time, 12, 4);

    $d = substr($time, 16, 4);

    $e = substr($time, 20, 16);
	$res_guid = $a . "-" . $b . "-" . $c . "-" . $d . "-" . $e;	
        return $res_guid;
    }
} 