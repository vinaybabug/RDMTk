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
 * Description of RegistrationController
 *
 * @author VinayB
 */
class RegistrationController extends BaseController {

    /**
     * The layout that should be used for responses.
     */
    protected $layout = 'layouts.login_registration_master';

    /**
     * Show the user profile.
     */
    public function showMainPage() {
        
        $this->layout->content = View::make('users.registration');
    }
    
       public function onSubmit() {
           
        $this->layout->content = View::make('users.registration');
    }

    public function showLoginPage() {
        
        $this->layout->content = View::make('users.login');
    }
    
     public function showForgotPasswordPage() {
        
        $this->layout->content = View::make('users.forgotpassword');
    }

}

