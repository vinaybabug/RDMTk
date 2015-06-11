<?php

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
		//
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
            User::create($input);

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
	public function update($id)
	{
		//
              $input = Input::all();
              $validation = Validator::make($input, User::$rulesUpdate);
              if ($validation->passes())
              {
                $user = User::find($id);
                $user->update($input);
                return Redirect::route('users.index', $id);
               }
               return Redirect::route('users.edit', $id)
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
        
        if(Input::get('role') == 'ADMIN'){
            $role = 'ADMIN';
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
