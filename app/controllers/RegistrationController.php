<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
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

