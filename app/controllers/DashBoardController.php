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
     * Show the profile for a Researcher.
     */
    public function showResearcherPage() {
        $this->layout->content = View::make('dashboard.dashboard_researcher');
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
             $role = Auth::user()->role;
            return View::make('dashboard.participants.userprofile', compact('user'))
                    ->with('tasks', $tasks)->with('role',$role);
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
            $role = Auth::user()->role;
            return View::make('dashboard.userprofile', compact('user'))->with('role',$role);
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
