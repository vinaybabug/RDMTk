<?php

class RDMTaskController extends BaseController{

	
	public function show_first(){

	    return View::make('dashboard.Tasks.taskcreate_1');

	}

	public function new_first(){
		$rules = array('task_name'=>'required|min:2|unique:tasks,taskname','task_id'=>'required|max:10|alpha_dash');
		$validator = Validator::make(Input::all(),$rules);

		if ($validator->fails()) {
			return Redirect::to('/Task/new/1')->withErrors($validator);
		}else{

			Session::put('task_name',Input::get('task_name'));
			Session::put('task_id',Input::get('task_id'));

			return Redirect::to('/Task/new/2');
		}
  

	}

	public function show_second(){

     return View::make('dashboard.Tasks.taskcreate_2');

	}

	public function new_second(){
									
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

					return Redirect::to('/Task/new/2')->withErrors($validator);

				}else {
					
					Session::put('target_path', $_SERVER['DOCUMENT_ROOT']."/RDMToolkit/public/tasks/".$filename);
					//Session::put('source',$source);
					if(move_uploaded_file($source, Session::get('target_path'))) {
					return Redirect::to('/Task/new/3');
				}else {
						
					return Redirect::to('/Task/new/2')->with('message' , 
						'There was a problem with the upload. Please try again.'.Session::get('source'));
				}
			}			
		
		}else{

				return Redirect::to('/Task/new/2')->with('message','No file was selected for upload!');
			}    

	}

	public function show_third(){
		
     return View::make('dashboard.Tasks.taskcreate_3');

	}

	public function new_third(){
		
		
			
		//Completing Third Step i.e creating the tables required by the task

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
					
					return Redirect::to('/Task/new/3')->withErrors($validator);
					
				}else {	
					
					if( ! $xml = simplexml_load_file($source) ) 
						{ 		
						       return Redirect::to('/Task/new/3')->with("message","Couldn't open the xml file");

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
								        		
								         		return Redirect::to('/Task/new/3')->withErrors($validator);	
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
									    	
								        	return Redirect::to('/Task/new/3')->with('message', 'The table could not be created, try again');
								    }  
								}else{	
								        return Redirect::to('/Task/new/3')->with('message', 'A table with the same name already exists in the database, Choose another name.');

								}		
							}
						     
						}	
				}		
			}else{

				return Redirect::to('/Task/new/3')->with('message','No file was selected for upload!');
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
					return Redirect::to('/Task/new/2')->with('message' , 'There was a problem with the upload. Please try again.');
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