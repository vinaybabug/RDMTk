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
class ConfigAWSController extends BaseController {
    
  /**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show()
	{
            
            $awsconfig = AWSConfiguration::where('username','=',Auth::user()->username)->first();
            
            if (is_null($awsconfig)) {
                return View::make('dashboard.tools.configaws');
            }
            
            return View::make('dashboard.tools.configaws_show', compact('awsconfig'));
		
	}
        
        
        /**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
        //
        $input = Input::all();
        
        $input = array('username'=>Auth::user()->username, 'created_by'=>Auth::user()->username) + $input;
//        $inputall = array('username'=>Auth::user()->username) + $input;
//        $inputall2 = array('created_by'=>Auth::user()->username) + $inputall;
//        print_r($input);
        $validation = Validator::make($input, AWSConfiguration::$rules);
//        echo $validation->passes();
        
        if ($validation->passes()) {            
            
            AWSConfiguration::create($input);

            return Redirect::route('dashboard');
        }

        return Redirect::route('awsconfig.show')
                        ->withInput()
                        ->withErrors($validation)
                        ->with('message', 'There were validation errors.');
        }

    	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit() {
        //
           $awsconfig = AWSConfiguration::where('username','=',Auth::user()->username)->first();
            
           if (is_null($awsconfig)) {
                return View::make('dashboard.tools.configaws');
            }
            return View::make('dashboard.tools.configaws_edit', compact('awsconfig'));
        }
        
        
        public function update() {
        //
        $input = Input::all();
        $input = array('modified_by'=>Auth::user()->username) + $input;
        $validation = Validator::make($input, AWSConfiguration::$rulesUpdate);        
        if ($validation->passes()) {
                $awsconfig = AWSConfiguration::where('username','=',Auth::user()->username)->first();
                
                $awsconfig->update(array('aws_instanceid' => Input::get('aws_instanceid'), 'aws_key' => Input::get('aws_key'), 'aws_secret' => Input::get('aws_secret'), 'aws_region' => Input::get('aws_region'), 'modified_by' => Input::get('modified_by')));
                return Redirect::route('awsconfig.show');
         }
         else
         return Redirect::route('awsconfig.edit')
                        ->withInput()
                        ->withErrors($validation)
                        ->with('message', 'There were validation errors.');
            //$awsconfig = AWSConfiguration::where('username','=',Auth::user()->username)->first();
            //return View::make('dashboard.tools.configaws_show', compact('awsconfig'));
        }
            
}