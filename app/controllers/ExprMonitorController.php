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
 * Description of DashBoardController
 *
 * @author Vinay Gavirangaswamy
 */
class ExprMonitorController extends BaseController {

      /**
     * Show the admin profile.
     */
    public function showMasterSelection() {
         
        $tasks = Tasks::lists('taskname', 'id');        
            
        $exprDesgType = ExprDesignType::lists('name', 'id');
                       
        return View::make('dashboard.tools.monitoring.monitorExpr')
                ->with('tasks', $tasks)
                ->with('exprDesgType', $exprDesgType);
    }
    
    public function getExprRelns($expertype, $expr_design_id) {

            $exprRelns;
            settype($exprRelns, "array"); 
            
             if(strcasecmp(Auth::user()->username, "admin") == false){
                
                $exprRelns = DB::select(DB::raw("select t1.id, t1.expr_design_id, t1.expr_dsg_nm, t1.exprid1, t1.exprname1, t1.exprid2, t2.expername as exprname2, t2.expertype as expertype, 
                                CONCAT(t2.expertype,'-',t1.expr_dsg_nm,'-', t1.id) as relnDesc,t1.created_by
                                from(
                                SELECT t1.id, t1.expr_design_id, t1.expr_dsg_nm, t1.exprid1, t2.expername as exprname1 , t2.expertype as expertype1, t1.exprid2, t1.created_by 
                                FROM (select t1.id, t1.expr_design_id, t2.name as expr_dsg_nm, t1.exprid1, t1.exprid2, t1.created_by  from expr_reln as t1 inner join expr_design_type as t2 on t1.expr_design_id = t2.id) AS t1 INNER JOIN experiments AS t2 ON t1.exprid1 = t2.id) as t1
                                inner join 
                                experiments AS t2 ON t1.exprid2 = t2.id 
                                where t1.expertype1 = t2.expertype and 
                                t2.expertype = :expertype and
                                t1.expr_design_id = :expr_design_id
                                "), array('expertype' => $expertype, 'expr_design_id' => $expr_design_id, ));                  
                
            }
            else{
                
                $exprRelns = DB::select(DB::raw("select t1.id, t1.expr_design_id, t1.expr_dsg_nm, t1.exprid1, t1.exprname1, t1.exprid2, t2.expername as exprname2, t2.expertype as expertype, 
                                CONCAT(t2.expertype,'-',t1.expr_dsg_nm,'-', t1.id) as relnDesc,t1.created_by
                                from(
                                SELECT t1.id, t1.expr_design_id, t1.expr_dsg_nm, t1.exprid1, t2.expername as exprname1 , t2.expertype as expertype1, t1.exprid2, t1.created_by 
                                FROM (select t1.id, t1.expr_design_id, t2.name as expr_dsg_nm, t1.exprid1, t1.exprid2, t1.created_by  from expr_reln as t1 inner join expr_design_type as t2 on t1.expr_design_id = t2.id) AS t1 INNER JOIN experiments AS t2 ON t1.exprid1 = t2.id) as t1
                                inner join 
                                experiments AS t2 ON t1.exprid2 = t2.id 
                                where t1.expertype1 = t2.expertype and 
                                t2.expertype = :expertype and
                                t1.expr_design_id = :expr_design_id and
                                t1.created_by = :user
                                "), array('expertype' => $expertype, 'expr_design_id' => $expr_design_id, 'user' => Auth::user()->username, ));                    

            }        
        
        $options = array();

        foreach ($exprRelns as $exprReln) {
            $options += array($exprReln->id => $exprReln->relnDesc);
        }

        return Response::json($options);
        
    }
    
        public function getExprReln($expertype, $expr_design_id, $expr_reln_id) {

            $exprRelns;
            settype($exprRelns, "array"); 
            
             if(strcasecmp(Auth::user()->username, "admin") == false){
                
                $exprRelns = DB::select(DB::raw("select t1.id, t1.expr_design_id, t1.expr_dsg_nm, t1.exprid1, t1.exprname1, t1.exprid2, t2.expername as exprname2, t2.expertype as expertype, 
                                CONCAT(t2.expertype,'-',t1.expr_dsg_nm,'-', t1.id) as relnDesc,t1.created_by
                                from(
                                SELECT t1.id, t1.expr_design_id, t1.expr_dsg_nm, t1.exprid1, t2.expername as exprname1 , t2.expertype as expertype1, t1.exprid2, t1.created_by 
                                FROM (select t1.id, t1.expr_design_id, t2.name as expr_dsg_nm, t1.exprid1, t1.exprid2, t1.created_by  from expr_reln as t1 inner join expr_design_type as t2 on t1.expr_design_id = t2.id) AS t1 INNER JOIN experiments AS t2 ON t1.exprid1 = t2.id) as t1
                                inner join 
                                experiments AS t2 ON t1.exprid2 = t2.id 
                                where t1.expertype1 = t2.expertype and 
                                t2.expertype = :expertype and
                                t1.expr_design_id = :expr_design_id and
                                t1.id = :expr_reln_id
                                "), array('expertype' => $expertype, 'expr_design_id' => $expr_design_id, 'expr_reln_id'=>$expr_reln_id));                  
                
            }
            else{
                
                $exprRelns = DB::select(DB::raw("select t1.id, t1.expr_design_id, t1.expr_dsg_nm, t1.exprid1, t1.exprname1, t1.exprid2, t2.expername as exprname2, t2.expertype as expertype, 
                                CONCAT(t2.expertype,'-',t1.expr_dsg_nm,'-', t1.id) as relnDesc,t1.created_by
                                from(
                                SELECT t1.id, t1.expr_design_id, t1.expr_dsg_nm, t1.exprid1, t2.expername as exprname1 , t2.expertype as expertype1, t1.exprid2, t1.created_by 
                                FROM (select t1.id, t1.expr_design_id, t2.name as expr_dsg_nm, t1.exprid1, t1.exprid2, t1.created_by  from expr_reln as t1 inner join expr_design_type as t2 on t1.expr_design_id = t2.id) AS t1 INNER JOIN experiments AS t2 ON t1.exprid1 = t2.id) as t1
                                inner join 
                                experiments AS t2 ON t1.exprid2 = t2.id 
                                where t1.expertype1 = t2.expertype and 
                                t2.expertype = :expertype and
                                t1.expr_design_id = :expr_design_id and
                                t1.id = :expr_reln_id and
                                t1.created_by = :user
                                "), array('expertype' => $expertype, 'expr_design_id' => $expr_design_id, 'expr_reln_id'=>$expr_reln_id, 'user' => Auth::user()->username, ));                    

            }            


        return Response::json($exprRelns[0]);
        
    }
    
//    public function monitorExprLiveSumm(){
//        
//    }
    

}