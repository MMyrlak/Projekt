<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace app\controllers;

use app\forms\RegisterForm;
use core\Message;
use core\ParamUtils;
use core\App;

class RegisterCtrl {
    private $form;
    private $forms_view;
    private $val;
    public function __construct(){
		$this->form = new RegisterForm();
                $this->forms_view = true;
                $this->form->login = "";
                $this->form->email = "";
                $this->val = false;
	}
    public function validate() {
            $this->form->login = ParamUtils::getFromRequest('login');
            $this->form->pass = ParamUtils::getFromRequest('password');
            $this->form->email = ParamUtils::getFromRequest('email');
            
             if($this->form->email==""){
                App::getMessages()->addMessage(new \core\Message("Brak e-mail", \core\Message::ERROR));
            }
            if($this->form->login==""){
                App::getMessages()->addMessage(new \core\Message("Brak loginu", \core\Message::ERROR));
            }
            if($this->form->pass==""){
                App::getMessages()->addMessage(new \core\Message("Brak hasla", \core\Message::ERROR));
            }   
            $this->val = App::getMessages()->isEmpty();
            return $this->val;
	}

	public function action_registerView(){
            $this->generateView(); 
	}
	
	public function action_register(){
            if($this->validate()){
               try{ 
                   App::getDB()->insert("users",[
                        "login" => $this->form->login,
                        "password" => hash('sha256', $this->form->pass),
                        "mail" => $this->form->email,
                        "role" => "user"
                       ]);
               
               } catch (\PDOException $ex) {
                App::getMessages()->addMessage(new \core\Message($ex, \core\Message::WARNING));
            }
                App::getMessages()->addMessage(new \core\Message("Zarejestrowany", \core\Message::INFO));
                $this->forms_view = false;
                $this->generateView();
            } else {
                $this->generateView();
            }
	}
	public function generateView(){
                App::getSmarty()->assign('msgs', App::getMessages()->getMessages());
                App::getSmarty()->assign('forms_view',$this->forms_view);
		App::getSmarty()->assign('form',$this->form); // dane formularza do widoku
                if($this->val) App::getSmarty()->display('workoutList.tpl');
                else App::getSmarty()->display('RegisterView.tpl');		
	}
    
}
