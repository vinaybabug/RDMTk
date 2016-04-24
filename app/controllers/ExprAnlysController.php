<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ExprAnlysController
 *
 * @author vinaya
 */
class ExprAnlysController extends BaseController {
    //put your code here
    
     
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
	public function showBaseMdlList($exprType)
	{
            $expers;
            settype($expers, "array"); 
            if(strcasecmp(Auth::user()->username, "admin") == false){
                $expers = Experiments::where('expertype','=' ,$exprType)->orderBy('expertype', 'asc')->paginate(5);
            }
            else{
                $expers = Experiments::where('expertype','=' ,$exprType)->where('created_by','=' ,Auth::user()->username)->orderBy('expertype', 'asc')->paginate(5);
            }
            
            
            if($expers->isEmpty()){
                        
                // Commented because trying log when no users in database creates problem.
                //Log::error("RDMUserController::index()", $users);
            }

           
             return View::make('dashboard.tools.anlys_mdl.igt.anlysBaseMdlLstExpr', compact('expers'));  
                      
	}
        
        public function showRNDMdlList($exprType)
	{
            $expers;
            settype($expers, "array"); 
            if(strcasecmp(Auth::user()->username, "admin") == false){
                $expers = Experiments::where('expertype','=' ,$exprType)->orderBy('expertype', 'asc')->paginate(5);
            }
            else{
                $expers = Experiments::where('expertype','=' ,$exprType)->where('created_by','=' ,Auth::user()->username)->orderBy('expertype', 'asc')->paginate(5);
            }
            
            
            if($expers->isEmpty()){
                        
                // Commented because trying log when no users in database creates problem.
                //Log::error("RDMUserController::index()", $users);
            }

           
             
           
             return View::make('dashboard.tools.anlys_mdl.igt.anlysRNDMdlLstExpr', compact('expers')); 
	}
        
        
              public function showEVLMdlList($exprType)
	{
            $expers;
            settype($expers, "array"); 
            if(strcasecmp(Auth::user()->username, "admin") == false){
                $expers = Experiments::where('expertype','=' ,$exprType)->orderBy('expertype', 'asc')->paginate(5);
            }
            else{
                $expers = Experiments::where('expertype','=' ,$exprType)->where('created_by','=' ,Auth::user()->username)->orderBy('expertype', 'asc')->paginate(5);
            }
            
            
            if($expers->isEmpty()){
                        
                // Commented because trying log when no users in database creates problem.
                //Log::error("RDMUserController::index()", $users);
            }

           
             
           
             return View::make('dashboard.tools.anlys_mdl.igt.anlysEVLMdlLstExpr', compact('expers')); 
	}
        
        public function getExprEnabled($expertype) {

            $expers;
            settype($expers, "array"); 
            $exprs = DB::select(DB::raw("SELECT 
                                                experid, anlys_mdl
                                        FROM 
                                                expr_anlys_data                                        
                                        WHERE expertype = :expertype"), array('expertype' => $expertype));   
        
        
//   

        return Response::json($exprs);
    }
    
    public function baseMdlView($expertype, $exprId, $mdlType) {
        
        return View::make('dashboard.tools.anlys_mdl.igt.anlysBaseMdlRsltsView')
                ->with('expertype', $expertype)
                ->with('exprId', $exprId)
                ->with('mdlType', $mdlType);  
    }
        
 public function rndMdlView($expertype, $exprId, $mdlType) {
        
        return View::make('dashboard.tools.anlys_mdl.igt.anlysRNDMdlRsltsView')
                ->with('expertype', $expertype)
                ->with('exprId', $exprId)
                ->with('mdlType', $mdlType);  
    }        
    
    public function evlMdlView($expertype, $exprId, $mdlType) {
        
        return View::make('dashboard.tools.anlys_mdl.igt.anlysEVLMdlRsltsView')
                ->with('expertype', $expertype)
                ->with('exprId', $exprId)
                ->with('mdlType', $mdlType);  
    }    
        
}
