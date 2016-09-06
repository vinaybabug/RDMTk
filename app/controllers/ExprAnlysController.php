<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


use Illuminate\Http\Request;

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
    
    public function submitAnlysJob($exprId, $expertype, $model){       
     
        $awsconfig = AWSConfiguration::where('username','=',Auth::user()->username)->first();       
        
        $awsconfig_validator = Validator::make(
            array('awsconfig' => is_null($awsconfig)),
            array('awsconfig' => 'in:0'), 
            array('awsconfig.in' => 'You have not configured Amazon EC2 instance with RDMTk. Please configure AWS EC2 instance before submitting analysis jobs.')
        );
       // $awsconfig_validator = Validator::make($awsconfig, $rules,$messsages);
            
        //Insert job in the database       
                
        $awsjob = ExprAnalysisJob::where('experid','=',$exprId)->where('expertype','=',$expertype)->where('anlys_mdl','=',$model)->first();
                
        if (is_null($awsjob)) {
            
            $input = array('experid'=> $exprId, 'owner'=>Auth::user()->username, 'expertype'=>$expertype, 'anlys_mdl'=> $model, 'doExec' => 1, 'created_by'=>Auth::user()->username);
            ExprAnalysisJob::create($input);            
        }
        else{
            
            $awsjob->update(array('doExec' => 1, 'modified_by' => Auth::user()->username));
        }   
                
        // For redirecting
        if(strcmp("BASE_MDL", $model) == 0){         
            
            $expers;
            settype($expers, "array"); 
            if(strcasecmp(Auth::user()->username, "admin") == false){
                $expers = Experiments::where('expertype','=' ,$expertype)->orderBy('expertype', 'asc')->paginate(5);
            }
            else{
                $expers = Experiments::where('expertype','=' ,$expertype)->where('created_by','=' ,Auth::user()->username)->orderBy('expertype', 'asc')->paginate(5);
            }            
            
            if($expers->isEmpty()){
                        
                // Commented because trying log when no users in database creates problem.
                //Log::error("RDMUserController::index()", $users);
            }

         // If AWS is not configured return error asking to configure aws account first
         if (is_null($awsconfig) and $awsconfig_validator->fails()) {
               
             
            return View::make('dashboard.tools.anlys_mdl.igt.anlysBaseMdlLstExpr', compact('expers'))->withErrors($awsconfig_validator);
         }
         else{
             
         $this->startAnlysJobOnAWS($awsconfig);
         return View::make('dashboard.tools.anlys_mdl.igt.anlysBaseMdlLstExpr', compact('expers'));  
         }
         
        }
        else if(strcmp("RND_MDL", $model) == 0){
        
              $expers;
            settype($expers, "array"); 
            if(strcasecmp(Auth::user()->username, "admin") == false){
                $expers = Experiments::where('expertype','=' ,$expertype)->orderBy('expertype', 'asc')->paginate(5);
            }
            else{
                $expers = Experiments::where('expertype','=' ,$expertype)->where('created_by','=' ,Auth::user()->username)->orderBy('expertype', 'asc')->paginate(5);
            }
            
            
            if($expers->isEmpty()){
                        
                // Commented because trying log when no users in database creates problem.
                //Log::error("RDMUserController::index()", $users);
            } 
             
             // If AWS is not configured return error asking to configure aws account first
        if (is_null($awsconfig) and $awsconfig_validator->fails()) {
                return View::make('dashboard.tools.anlys_mdl.igt.anlysRNDMdlLstExpr', compact('expers'))->withErrors($awsconfig_validator);
         }else{
            
            $this->startAnlysJobOnAWS($awsconfig);
            return View::make('dashboard.tools.anlys_mdl.igt.anlysRNDMdlLstExpr', compact('expers')); 
         }
             
        }
        else if(strcmp("EVL_MDL", $model) == 0){
            
            
            $expers;
            settype($expers, "array"); 
            if(strcasecmp(Auth::user()->username, "admin") == false){
                $expers = Experiments::where('expertype','=' ,$expertype)->orderBy('expertype', 'asc')->paginate(5);
            }
            else{
                $expers = Experiments::where('expertype','=' ,$expertype)->where('created_by','=' ,Auth::user()->username)->orderBy('expertype', 'asc')->paginate(5);
            }
            
            
            if($expers->isEmpty()){
                        
                // Commented because trying log when no users in database creates problem.
                //Log::error("RDMUserController::index()", $users);
            } 
             
           // If AWS is not configured return error asking to configure aws account first
         if (is_null($awsconfig) and $awsconfig_validator->fails()){
                return View::make('dashboard.tools.anlys_mdl.igt.anlysEVLMdlLstExpr', compact('expers'))->withErrors($awsconfig_validator);
         }
         else{
             
             $this->startAnlysJobOnAWS($awsconfig);
             return View::make('dashboard.tools.anlys_mdl.igt.anlysEVLMdlLstExpr', compact('expers')); 
         }
            
            
        }
        
    }
    
    private  function startAnlysJobOnAWS($awsconfig){
        // Use the default credential provider
//$credentials = new Credentials('YOUR_ACCESS_KEY', 'YOUR_SECRET_KEY');
//
//$ec2Client = new Ec2Client([
//    'version'     => 'latest',
//    'region'      => 'us-west-2',
//    'credentials' => $credentials,
//]);
// Instantiate the S3 client with your AWS credentials
        //$creds = array('key' => 'AKIAJMIVCBXUZMTPWP6A', 'secret' => 'NoB7cimX9PlcgHE+MWJdr7/23U30VOzb4Y1nV5rc', 'region' => 'us-east-1');
        $creds = array('key' => $awsconfig->aws_key, 'secret' => $awsconfig->aws_secret, 'region' => $awsconfig->aws_region);
        $ec2client = Ec2Client::factory($creds);
        $result = $ec2client->describeInstances(array());
// TO START AN INSTANCE

        $result = $ec2client->startInstances(array(
            'InstanceIds' => array($awsconfig->aws_instanceid,),
            'DryRun' => false,
        ));
    }

}
