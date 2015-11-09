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
 * @description  This Controller receives the mouse coordinates captured by the jQuery script and stores them in a database.
 * @author 	Praneet Soni praneetsoni.soni@gmail.com
 */

class MouseTracker extends BaseController{

	public function store(){
			$expid=Input::get('expid');
			$userid = Input::get('userid');
			$data = Input::get('coordinates');
			
			$coords= explode("#",$data);
			$expertype = Experiments::where('id',$expid)->first()->expertype;
			$prev=0;

			foreach($coords as $coord){

				$point = explode(":",$coord);
				$time= $point[0]-$prev;
				$prev = $point[0];
				MouseTrack::create(array('expid'=>$expid,'expertype'=>$expertype,'mid'=>$userid,'x_coord'=>$point[1],'y_coord'=>$point[2],'time_spent'=>$time)); 
			}
	
			//return View::make('dashboard.dashboard_admin')->with('message',$exprtype);
	}


	public function show(){
		$tasks = Tasks::lists('taskname','id');
		$role = Auth::user()->role;
		return View::make('dashboard.admin.experiments.Track.selectUser')->with('tasks',$tasks)->with('role',$role);

	}

	public function getExpId($exptype){

		$exprs = Experiments::where('expertype',$exptype)->get();
		$selected = array();

		foreach($exprs as $exp){

			$selected += array($exp->id=>$exp->expername);
		}

		//return json_encode($selected);
		return Response::json($selected);
	}

	public function getUserId($expid){

		$exprs = MouseTrack::where('expid',$expid)->get();
		$selected =array();

		foreach($exprs as $exp){

			$selected += array($exp->userid);
				return Response::json($selected);}

	}

	public function generate(){
		$userid = Input::get('userid');
		$expid= Input::get('expid');

		$result = MouseTrack::where('expid',$expid)->where('userid',$userid)->first();    //'where' clause returns a list of results..so to access
																					      //the attributes select one item in list first
		$role = Auth::user()->role;
		return View::make('dashboard.admin.experiments.Track.mousePathRetrace')->with('result',$result->coordinates)->with('role',$role);

	}

}

?>