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

class RDMExprRelnController extends BaseController {
    
    
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
            
            if(strcasecmp(Auth::user()->username, "admin") == false){
                
                $exprRelnsArr = DB::select(DB::raw("select t1.id, t1.expr_design_id, t1.expr_dsg_nm, t1.exprid1, t1.exprname1, t1.exprid2, t2.expername as exprname2, t1.created_by
                from(
                SELECT t1.id, t1.expr_design_id, t1.expr_dsg_nm, t1.exprid1, t2.expername as exprname1 ,t1.exprid2, t1.created_by 
                FROM (select t1.id, t1.expr_design_id, t2.name as expr_dsg_nm, t1.exprid1, t1.exprid2, t1.created_by  from expr_reln as t1 inner join expr_design_type as t2 on t1.expr_design_id = t2.id) AS t1 INNER JOIN experiments AS t2 ON t1.exprid1 = t2.id) as t1
                inner join 
                experiments AS t2 ON t1.exprid2 = t2.id order by t1.expr_dsg_nm, t1.exprid1 asc
               "));
                
                $total = count($exprRelnsArr);
                $limit = 5;
//
                $exprRelns = Paginator::make($exprRelnsArr, $total, $limit);                

                
                return View::make('dashboard.expr_reln.exprRelnDesgMgmt', compact('exprRelns'));  
                
            }
            else{
                
                $exprRelnsArr = DB::select(DB::raw("select t1.id, t1.expr_design_id, t1.expr_dsg_nm, t1.exprid1, t1.exprname1, t1.exprid2, t2.expername as exprname2, t1.created_by
                from(
                SELECT t1.id, t1.expr_design_id, t1.expr_dsg_nm, t1.exprid1, t2.expername as exprname1 ,t1.exprid2, t1.created_by 
                FROM (select t1.id, t1.expr_design_id, t2.name as expr_dsg_nm, t1.exprid1, t1.exprid2, t1.created_by  from expr_reln as t1 inner join expr_design_type as t2 on t1.expr_design_id = t2.id) AS t1 INNER JOIN experiments AS t2 ON t1.exprid1 = t2.id) as t1
                inner join 
                experiments AS t2 ON t1.exprid2 = t2.id
                where t1.created_by = :user order by t1.expr_dsg_nm, t1.exprid1 asc"), array(
                'user' => Auth::user()->username,
                ));
                
                $total = count($exprRelnsArr);
                $limit = 5;
//
                $exprRelns = Paginator::make($exprRelnsArr, $total, $limit);               

                
                return View::make('dashboard.expr_reln.exprRelnDesgMgmt', compact('exprRelns'));             

            }        
                    
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
            
            $exprDesgType = ExprDesignType::lists('name', 'id');
                        
            return View::make('dashboard.expr_reln.exprRelnCrt')
                    ->with('tasks', $tasks)
                    ->with('exprDesgType', $exprDesgType);
            
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
                'exprDesgType' => 'required|exists:expr_design_type,id',
                'tasktype' =>'required|exists:tasks,id',                
                'expridA' =>'required|exists:experiments,id',
                'expridB' =>'required|exists:experiments,id',               
            );
        
        $exprDesgTypeId = Input::get('exprDesgType');
        $exprAId = Input::get('expridA');
        $exprBId = Input::get('expridB');        
       
//        
        $validation = Validator::make($input, $rules);       
        
        if ($validation->passes()) {
            
             if ($exprAId === $exprBId and $exprDesgTypeId === 'BTW_SUBJ_DSG') {
            
             return Redirect::route('exprRelns.create')
                        ->withInput()                        
                        ->with('message', 'Experiment design type cannot be "Between Subjects Design" when group A and B experiments are same.');                
            }    
            
            $reln1 = ExprReln::where('exprid1','=' ,$exprAId)-> where('exprid2','=' ,$exprBId)->count();
            $reln2 = ExprReln::where('exprid1','=' ,$exprBId)-> where('exprid2','=' ,$exprAId)->count();           
            
            
            if($reln1 > 0 or $reln2 > 0){
                return Redirect::route('exprRelns.create')
                        ->withInput()                        
                        ->with('message', 'Relationship between experiments in group A and B already exists.');          
                
            }
            $inputall = array('expr_design_id'=> $exprDesgTypeId,'exprid1'=>$exprAId, 'exprid2'=>$exprBId,'created_by'=>Auth::user()->username);
            ExprReln::create($inputall);
//            
            return Redirect::route('exprRelns.index');
        }

        return Redirect::route('exprRelns.create')
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
		
            
            ExprReln::find($id)->delete();
            return Redirect::route('exprRelns.index');
	}       

}
