<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace app\controllers;

use core\Message;
use core\Utils;
use core\App;
use app\forms\LoginForm;

class LoginCtrl {
    private $form;
    private $forms_view;
    	
	public function validate() {
		$this->form->login = getFromRequest('login');
                $this->form->pass = getFromRequest('password');
	}

	public function action_loginView(){
            $this->hide_intro = true;
            $this->generateView(); 
	}
	
	public function action_login(){	
            $this->generateView(); 
	}
	
//	public function action_logout(){
//		session_destroy();
//		redirectTo('hello');
//	}	
	
	public function generateView(){
                App::getSmarty()->assign('forms_view',$this->forms_view);
                App::getSmarty()->assign('form',$this->form);
		App::getSmarty()->display('LoginView.tpl');		
	}
    
}
