<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace app\controllers;

use app\forms\RegisterForm;

use core\Message;
use core\Utils;
use core\App;

class RegisterCtrl {
    private $form;
    private $forms_view;

    public function __construct(){
		$this->form = new RegisterForm();
                $this->hide_intro = false;
	}
    public function validate() {
            $this->form->login = getFromRequest('login');
            $this->form->pass = getFromRequest('password');
            $this->form->email = getFromRequest('email');
            
            if(!isset($this->form->login)){
                App::getMessages()->addMessage("Brak loginu");
                return false;
            }
            if(!isset($this->form->pass)){
                App::getMessages()->addMessage("Brak hasla");
                return false;
            }
            if(!isset($this->form->login)){
                App::getMessages()->addMessage("Brak emailu");
                return false;
            }
            return true;
	}

	public function action_registerView(){
            $this->hide_intro = true;
            $this->generateView(); 
	}
	
	public function action_register(){
            if($this->validate()){
                echo "123";
            }
	}
	public function generateView(){
                App::getSmarty()->assign('forms_view',$this->forms_view);
		App::getSmarty()->assign('form',$this->form); // dane formularza do widoku
		App::getSmarty()->display('RegisterView.tpl');		
	}
    
}
