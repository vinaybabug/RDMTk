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

class RDMExprController extends BaseController {
    
    
        function __construct() {
              if(is_null(Auth::user())){
                return Redirect::route('login')
                ->with('flash_error', 'Session expire, please login.');           
            }
        }
    
    
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
            $expers;
            settype($expers, "array"); 
            if(strcasecmp(Auth::user()->username, "admin") == false){
                $expers = Experiments::orderBy('expertype', 'asc')->paginate(5);
            }
            else{
                $expers = Experiments::where('created_by','=' ,Auth::user()->username)->orderBy('expertype', 'asc')->paginate(5);
            }
            
            
            if($expers->isEmpty()){
                        
                // Commented because trying log when no users in database creates problem.
                //Log::error("RDMUserController::index()", $users);
            }
// Alternate method to handle session timeout            
//            if(is_null(Auth::user())){
//                return View::make('users.login');            
//            }
//            else{
//                $role = Auth::user()->role;
//                return View::make('dashboard.admin.experiments.exprmanagement', compact('expers'))->with("role",$role);        
//            }
            
             return View::make('dashboard.admin.experiments.exprmanagement', compact('expers'));  
                    
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
            $tasks = Tasks::lists('taskname', 'id');
            $exprconfirmpg = ExperConfirmation::lists('confirmation_type','confirmation_type');
                        
            return View::make('dashboard.admin.experiments.experimentcreate')
                    ->with('tasks', $tasks)
                    ->with('exprconfirmpg', $exprconfirmpg);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
        //
        $input = Input::all();        
        
        
        $rules = array(
                'expername' => 'required|unique:experiments',
                'expertype' =>'required|exists:tasks,id',
                'nooftrials' =>'required|digits_between:1,1000',
                'expertrial_outcome_type' =>'required|in:FIXED,RANDOM|not_in:default',
                'confirmationcode' =>'required_without:isCustomText|alpha_num',
                'experend_conf_page_type' =>'required||not_in:default',
                'experend_conf_customtext' =>'required_if:isCustomText,selected',
                'urllink' =>'required|url',
            );
        $utilities = new Utilities();
        //$absolute_url = $utilities->full_url($_SERVER);
        $id = $utilities->random_id_gen(10);
        $absolute_url = url('/tasks');//+'/'+Input::get('expertype');//+'/task.php';
        $absolute_url = str_replace("/index.php/","/",$absolute_url). '/' .Input::get('expertype').'/task.php?exp='.$id.'&MID=MID';
        $absolute_url = str_replace("https:", "http:", $absolute_url);
        $inputall = array('id'=> $id,'urllink'=>$absolute_url,'created_by'=>Auth::user()->username) + $input;
        
        $validation = Validator::make($inputall, $rules);
        
        if ($validation->passes()) {
            Experiments::create($inputall);
            return Redirect::route('experiments.index');
        }

        return Redirect::route('experiments.create')
                        ->withInput()
                        ->withErrors($validation)
                        ->with('message', 'There were validation errors.');
        }

        /**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{  
            $exprconfirmpg = ExperConfirmation::lists('confirmation_type','confirmation_type');
            $experiment = Experiments::find($id);
            if (is_null($experiment)) {
                return Redirect::route('experiments.index');
            }
           
            return View::make('dashboard.admin.experiments.experimentshow')
                 ->with('experiment', $experiment)
//                 ->with('tasks', $tasks)
                 ->with('exprconfirmpg', $exprconfirmpg);
	}

        /**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function showParticipants($id)
	{
	    
            $experiment = Experiments::where('expertype','=' ,$id)                              
                                        ->paginate(10);
             $tasks = Tasks::all();
             $currentTask = Tasks::find($id);
             
//            if (is_null($experiment)) {
//                return View::make('dashboard.participants.dashboard_participants');
//            }
             
            return View::make('dashboard.participants.experiments.experimentshow')
                 ->with('tasks', $tasks)
                 ->with('currentTask', $currentTask)
                 ->with('expers', $experiment);
            
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
        //
            
            $tasks = Tasks::lists('taskname', 'id');
            $exprconfirmpg = ExperConfirmation::lists('confirmation_type','confirmation_type');
            $experiment = Experiments::find($id);
            if (is_null($experiment)) {
                return Redirect::route('experiments.index');
            }
            $email = Auth::user()->email;
            $datasets= array();
            $sets = DB::table('delayed_discount_que')->select('dataset_name')->whereRaw('created_by ="ADMIN" or created_by="'.$email.'"')->groupBy('dataset_name')->get();
            foreach($sets as $set){
                $datasets = $datasets + array($set->dataset_name=>$set->dataset_name);
            }
            
            return View::make('dashboard.admin.experiments.experimentedit', compact('experiment'))
                 ->with('tasks', $tasks)
                 ->with('exprconfirmpg', $exprconfirmpg)
                 ->with('datasets',$datasets);
        }

        /**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
        $input = Input::all();
        
        
        if(strcasecmp(Input::get('expertype'), 'DelayD')==0){
        $rules = array(
                'expername' => 'required',
                'expertype' =>'required|exists:tasks,id',
                'nooftrials' =>'required|digits_between:1,1000',
                'expertrial_outcome_type' =>'required|in:FIXED,RANDOM|not_in:default',
                'confirmationcode' =>'required_without:isCustomText|alpha_num',
                'experend_conf_page_type' =>'required||not_in:default',
                'experend_conf_customtext' =>'required_if:isCustomText,selected',
                'urllink' =>'required|url',
                'select_dataset'=>'required',
            );
                       
            $absolute_url = url('/tasks');
            $absolute_url = str_replace("/index.php/","/",$absolute_url). '/' .Input::get('expertype').'/task.php?exp='.$id.'&MID=MID';
            //$absolute_url = $utilities->full_url($_SERVER);
            //+'/'+Input::get('expertype');//+'/task.php';
           // $absolute_url = str_replace("/index.php/","/",$absolute_url). '/' .Input::get('expertype').'/task.php';
        
            $inputall = array('id'=>$id,'urllink'=>$absolute_url, 'modified_by'=>Auth::user()->username) + $input;
            $validation = Validator::make($inputall, $rules);
        if ($validation->passes())
        {
            $expr = Experiments::find($id);
            $expr->update($inputall);
            return Redirect::route('experiments.index', $id);
        }
        }
        else{
             $rules = array(
                'expername' => 'required',
                'expertype' =>'required|exists:tasks,id',
                'nooftrials' =>'required|digits_between:1,1000',
                'expertrial_outcome_type' =>'required|in:FIXED,RANDOM|not_in:default',
                'confirmationcode' =>'required_without:isCustomText|alpha_num',
                'experend_conf_page_type' =>'required||not_in:default',
                'experend_conf_customtext' =>'required_if:isCustomText,selected'                
            );
             $validation = Validator::make( $input, $rules);
             
            if ($validation->passes())
            {
                $inputall = array('modified_by'=>Auth::user()->username) + $input;
                $expr = Experiments::find($id);
                $expr->update($inputall);
                return Redirect::route('experiments.index', $id);
            }
        }
                   
     
        return Redirect::route('experiments.edit', $id)
                ->withInput()
                ->withErrors($validation)
                ->with('message', 'There were validation errors.');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
            try {
            Experiments::find($id)->delete();
                return Redirect::route('experiments.index');
            }
            catch ( Illuminate\Database\QueryException $e) {
                return Redirect::route('experiments.index');
            }
	}       

}
