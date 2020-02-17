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

class RDMUserController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
                    $users = User::paginate(5);
                    if($users->isEmpty()){
                        
                        // Commented because trying log when no users in database creates problem.
                         //Log::error("RDMUserController::index()", $users);
                    }
                    
                    return View::make('dashboard.users.usermanagement', compact('users'));
                    
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
            return View::make('dashboard.users.usercreate');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
        //
        $input = Input::all();
        $validation = Validator::make($input, User::$rules);
        
        if ($validation->passes()) {
            
            $inputall = array('created_by'=>Auth::user()->username) + $input;
            User::create($inputall);

            return Redirect::route('users.index');
        }

        return Redirect::route('users.create')
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
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
        //
            $user = User::find($id);
            
            if (is_null($user)) {
                return Redirect::route('users.index');
            }
            return View::make('dashboard.users.useredit', compact('user'));
        }

        /**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
        //
        $input = Input::all();
        $validation = Validator::make($input, User::$rulesUpdate);
        $validation2 = Validator::make($input, User::$rulesUpdatePwd);
        
        if (empty(Input::get('password'))) {
           
            if ($validation->passes()) {
                $user = User::find($id);
                $user->update(array('first_name' => Input::get('first_name'), 'last_name' => Input::get('last_name'), 'role' => Input::get('role'), 'email' => Input::get('email'), 'username' => Input::get('username')));
                return Redirect::route('users.index', $id);
            } else {
                return Redirect::route('users.edit', $id)
                                ->withInput()
                                ->withErrors($validation)
                                ->with('message', 'There were validation errors.');
            }
        } else if (!empty(Input::get('password'))) {
         
            if ($validation2->passes()) {
                $user = User::find($id);
                $user->update(array('first_name' => Input::get('first_name'), 'last_name' => Input::get('last_name'), 'role' => Input::get('role'), 'email' => Input::get('email'), 'username' => Input::get('username'), 'password' => Input::get('password')));
                return Redirect::route('users.index', $id);
            } else {
                return Redirect::route('users.edit', $id)
                                ->withInput()
                                ->withErrors($validation2)
                                ->with('message', 'There were validation errors.');
            }
        }
        
        $this->index();
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
            User::find($id)->delete();
            
            return Redirect::route('users.index');
	}
        
        /**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function resetPassword() {        
            
            // do validation first
            $input = Input::all();
            
            $rules = array(
                'email' => 'required|email',
                'password' =>'required|same:password_confirmation'
            );
            $validation = Validator::make($input, $rules);
            if ($validation->passes()) {
                $email = Input::get('email');
                $password = Input::get('password');
            
            $user = User::where('email','=',$email)->first();
            if (is_null($user)) {
                // show error saying that email is not associated with RDM
                return  Redirect::route('resetPassword')
                        ->withInput()                        
                        ->with('message', 'No user associated with given email address.');
            }
            
            $user->password = $password;
            
            $user->save();
            // return to login
            return Redirect::route('login');
            }
            return Redirect::route('resetPassword')
                        ->withInput()
                        ->withErrors($validation)
                        ->with('message', 'There were validation errors.');            
        }
        
        
        /**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function storeRegistration() {
        //
        $input = Input::all();   
        
        $role = 'END_USER';
        
        if(Input::get('role') == 'RDM_RESEARCHER'){
            $role = 'RDM_RESEARCHER';
        }
        
        $user = array(
            'first_name' => Input::get('first_name'),
            'last_name' => Input::get('last_name'),
            'role' => $role,
            'username' => Input::get('email'),
            'email' => Input::get('email'),
            'password' => Input::get('password'), 
            'password_confirmation'  => Input::get('password_confirmation') 
        );
                
        $validation = Validator::make($user, User::$rules);

        if ($validation->passes()) {
            User::create($user);
            return Redirect::route('login');
        }
        return Redirect::route('registration')
                        ->withInput()
                        ->withErrors($validation)
                        ->with('message', 'There were validation errors.');
        }
        
    

}
