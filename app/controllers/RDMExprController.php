<?php

class RDMExprController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
            $expers = Experiments::orderBy('expertype', 'asc')->paginate(5);
            
            if($expers->isEmpty()){
                        
                // Commented because trying log when no users in database creates problem.
                //Log::error("RDMUserController::index()", $users);
            }
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
        
        $inputall = array('id'=> $id,'urllink'=>$absolute_url) + $input;
        
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
            return View::make('dashboard.admin.experiments.experimentedit', compact('experiment'))
                 ->with('tasks', $tasks)
                 ->with('exprconfirmpg', $exprconfirmpg);
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
              
               $rules = array(
                'expername' => 'required',
                'expertype' =>'required|exists:tasks,id',
                'nooftrials' =>'required|digits_between:1,1000',
                'expertrial_outcome_type' =>'required|in:FIXED,RANDOM|not_in:default',
                'confirmationcode' =>'required_without:isCustomText|alpha_num',
                'experend_conf_page_type' =>'required||not_in:default',
                'experend_conf_customtext' =>'required_if:isCustomText,selected',
                'urllink' =>'required|url',
            );
                       
            
        
            //$absolute_url = $utilities->full_url($_SERVER);
            $absolute_url = url('/tasks');//+'/'+Input::get('expertype');//+'/task.php';
            $absolute_url = str_replace("/index.php/","/",$absolute_url). '/' .Input::get('expertype').'/task.php';
        
            $inputall = array('id'=>Input::get('expername'),'urllink'=>$absolute_url) + $input;
        
            $validation = Validator::make($inputall, $rules);
              
              if ($validation->passes())
              {
                $expr = Experiments::find($id);
                $expr->update($input);
                return Redirect::route('experiments.index', $id);
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
		//
            Experiments::find($id)->delete();
            return Redirect::route('experiments.index');
	}       

}
