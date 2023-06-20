<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace app\controllers;

use app\forms\LoginForm;

class LoginCtrl {
    private $form;
    	
	public function validate() {
		Echo "pozniej";
	}

	public function action_loginView(){
		$this->generateView(); 
	}
	
	public function action_login(){	
            Echo "pozniej";
	}
	
//	public function action_logout(){
//		session_destroy();
//		redirectTo('hello');
//	}	
	
	public function generateView(){
		App::getSmarty()->display('LoginView.tpl');		
	}
    
}
