<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DashBoardController
 *
 * @author vinaya
 */
class DashBoardController extends BaseController {

    /**
     * The layout that should be used for responses.
     */
    protected $layout = 'layouts.dashboard_master';

    /**
     * Show the admin profile.
     */
    public function showAdminPage() {
        $this->layout->content = View::make('dashboard.dashboard_admin');
    }
    
    /**
     * Show the participants profile.
     */
    public function showParticipantsPage() {
        $tasks = Tasks::all();
        
        $this->layout->content = View::make('dashboard.participants.dashboard_participants')
                                 ->with('tasks', $tasks);
    }
        /**
	 * Show the form for showing current logged in user.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function profileParticipants() {
            if(Auth::check() || Auth::viaRemember()){
            $user = Auth::user();
             $tasks = Tasks::all();
            return View::make('dashboard.participants.userprofile', compact('user'))
                    ->with('tasks', $tasks);
            }
            return Redirect::route('login');
        }
        /**
	 * Show the form for showing current logged in user.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function profile() {
            if(Auth::check() || Auth::viaRemember()){
            $user = Auth::user();
            return View::make('dashboard.userprofile', compact('user'));
            }
            return Redirect::route('login');
        }
        
         /**
	 * Show the form for logging out current logged in user.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function logout() {
            Auth::logout();

            return Redirect::route('login');
        }
        

}
