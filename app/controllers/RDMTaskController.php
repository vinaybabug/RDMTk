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

/**
 * @description This controller allows a user to easily integrate a new Task into the Toolkit through a series of 3 steps.
 *    			Note that controller is designed in a way that unless the user completes all the 3 steps ,no change will be made to
 *				existing codebase. This is done to ensure that the existing Toolkit doesn't brake in case some user abandons the process 
 *				intermittently.
 * @author 	Praneet Soni praneetsoni.soni@gmail.com
 */

class RDMTaskController extends BaseController{

	/**
	* @description Renders a form asking for the Task name and Task ID
	*/	
	public function showFirst(){

	    return View::make('dashboard.Tasks.taskcreate_firststep');

	}

	/**
	* @description Validates the data entered and redirects to step 2 if no issues found.
	*/
	public function validateFirst(){
		$rules = array('task_name'=>'required|min:2|unique:tasks,taskname','task_id'=>'required|max:10|alpha_dash');
		$validator = Validator::make(Input::all(),$rules);

		if ($validator->fails()) {
			return Redirect::to('/Task/new/first')->withErrors($validator);
		}else{

			Session::put('task_name',Input::get('task_name'));
			Session::put('task_id',Input::get('task_id'));

			return Redirect::to('/Task/new/second');
		}
  

	}
	/**
	* @description Renders a form to collect the Task files, which need to uploaded by the user as .zip file
	*/
	public function showSecond(){

     return View::make('dashboard.Tasks.taskcreate_secondstep');

	}
	/**
	* @description Ensures that the uploaded file is indeed a .zip file and within size constraints. Then moves the file from a temp location
	*				to a default location where it's unzipped in Step 3. 
	*/
	public function validateSecond(){
									
			if($_FILES["task_files"]["name"]) {
				$filename = $_FILES["task_files"]["name"];
				$source = $_FILES["task_files"]["tmp_name"];
				$type = $_FILES["task_files"]["type"];
				$size= $_FILES["task_files"]["size"];
				$name = explode(".", $filename);
				$len = count($name);
				
			// validating the various file parameters				

				$data=array('type'=>$type,'ext'=>$name[$len-1], 'size'=>$size,'ext_accepted'=>'zip');
				$rules= array('type'=>'required_if:ext,zip|in:application/zip,application/x-zip-compressed,multipart/x-zip,application/x-compressed' , 
					'ext'=>'same:ext_accepted', 'size'=>'numeric|max:2097150','ext_accepted'=>'');
				$messages= array('in'=>'The uploaded file does not have an acceptable .zip type','same'=>'The uploaded file is not a .zip file', 
					'max'=>'The size of file uploaded exceeds 2M');
				$validator  = Validator::make($data,$rules,$messages);
				if($validator->fails()){

					return Redirect::to('/Task/new/second')->withErrors($validator);

				}else {
					
					Session::put('target_path', $_SERVER['DOCUMENT_ROOT']."/RDMToolkit/public/tasks/".$filename);
					//Session::put('source',$source);
					if(move_uploaded_file($source, Session::get('target_path'))) {
					return Redirect::to('/Task/new/third');
				}else {
						
					return Redirect::to('/Task/new/second')->with('message' , 
						'There was a problem with the upload. Please try again.'.Session::get('source'));
				}
			}			
		
		}else{

				return Redirect::to('/Task/new/second')->with('message','No file was selected for upload!');
			}    

	}
	/**
	* @description Renders a form and allows the user to upload a config.xml file, which tells the database about the new tables to be
	*				created ,for the functioning of the new Task being added.
	*/
	public function showThird(){
		
     return View::make('dashboard.Tasks.taskcreate_thirdstep');

	}
	/**
	* @description Validates that the file uploaded is .xml and if so creates the tables as given in the config.xml.
	*				This function completes the process of integration of new Task. 
	*/
	public function validateThird(){

		if($_FILES["task_xml"]){
				$filename = $_FILES["task_xml"]["name"];
				$source = $_FILES["task_xml"]["tmp_name"];
				$size= $_FILES["task_xml"]["size"];
				$name = explode(".", $filename);
				$len = count($name);
				$tables= array();

				$data=array('ext'=>$name[$len-1], 'size'=>$size,'ext_accepted'=>'xml');
				$rules= array('ext'=>'same:ext_accepted', 'size'=>'numeric|max:2097150','ext_accepted'=>'');
				$messages= array('same'=>'The uploaded file is not a xml file','max'=>'The size of file uploaded exceeds 2M');
				$validator  = Validator::make($data,$rules,$messages);
				if($validator->fails()){
					
					return Redirect::to('/Task/new/third')->withErrors($validator);
					
				}else {	
					
					if( ! $xml = simplexml_load_file($source) ) 
						{ 		
						       return Redirect::to('/Task/new/third')->with("message","Couldn't open the xml file");

						}else 
						{ 
							foreach ($xml as $tab) {

								        $table_name = (string)$tab['name'];
								        $tables= $tables + array($table_name);
								        $fields = array();

								        foreach($tab as $col){
								        	$validator = Validator::make(array('name'=>$table_name,'field_type'=>(string)$col['type']),
								        		array('name'=>'alpha_dash','field_type'=>'alpha_dash|in:integer,float,string,dateTime,increments'),
								        		array('alpha_dash'=>'The name may only contain letters, numbers, and dashes. No spaces allowed'));
								        	if($validator->fails()){	
								        		
								         		return Redirect::to('/Task/new/third')->withErrors($validator);	
									        }else{
									         	$fields= $fields + array((string)$col=> (string)$col['type']);
									        }
								        }	
								        unset($col);
								    if(!Schema::hasTable($table_name)){
								        Schema::create($table_name,function($table){
								        $table->increments('S_no') ;});

								        if(Schema::hasTable($table_name)){
									        foreach($fields as $col_name=>$col_type){

									        	Schema::table($table_name, function($table) use ($col_name,$col_type){
									        		$table->$col_type($col_name);
									        	});

									        }
									        unset($col_name);
									        unset($col_type);
									    }else{
									    	
								        	return Redirect::to('/Task/new/third')->with('message', 'The table could not be created, try again');
								    }  
								}else{	
								        return Redirect::to('/Task/new/third')->with('message', 'A table with the same name already exists in the database, Choose another name.');

								}		
							}
						     
						}	
				}		
			}else{

				return Redirect::to('/Task/new/third')->with('message','No file was selected for upload!');
		} 

		//Completing the First step i.e adding task to table
		Tasks::create(array('id'=>Session::get('task_id'),'taskname'=>Session::get('task_name'),'created_by'=>'ADMIN','modified_by'=>'ADMIN',
			'created_at'=>date("Y-m-d H:i:s"),'updated_at'=>date("Y-m-d H:i:s")));
		//Completing the Second step i.e extracting task files to the correct location
		$target_path = Session::get('target_path');
		$final_path=$_SERVER['DOCUMENT_ROOT']."/RDMToolkit/public/tasks/".Session::get('task_id');
			$zip = new ZipArchive();
			$x = $zip->open($target_path);
			if ($x === true) {
				$zip->extractTo($final_path); 
				$zip->close();
				unlink($target_path);
			}else{
					unlink($target_path);
					Tasks::where('id',Session::get('task_id'))->delete();
					foreach($tables as $table){

						Schema::dropIfExists($table);
					}
					unset($table);
					return Redirect::to('/Task/new/second')->with('message' , 'There was a problem with the upload. Please try again.');
				}


		Session::forget('task_name');
		Session::forget('task_id');
		Session::forget('target_path');
		Session::forget('source');
		
		//Session::flush();

    return Redirect::route('dashboard_admin')->with('message','The new Task successfully integrated into the toolkit!');

	}



}


?>