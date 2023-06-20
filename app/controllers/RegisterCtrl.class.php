<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace app\controllers;

use app\forms\RegisterForm;

class RegisterCtrl {
    private $form;
    	
	public function validate() {
            $this->form->login = getFromRequest('login');
            $this->form->pass = getFromRequest('password');
            $this->form->email = getFromRequest('email');
	}

	public function action_registerView(){
		$this->generateView(); 
	}
	
	public function action_register(){
            Echo "póŸniej";
	}
	public function generateView(){
		getSmarty()->assign('form',$this->form); // dane formularza do widoku
		getSmarty()->display('RegisterView.tpl');		
	}
    
}
