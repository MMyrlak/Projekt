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
                $this->form->login = "";
                $this->form->email = "";
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
           
            return App::getMessages()->isEmpty();
	}

	public function action_registerView(){
            $this->forms_view = true;
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
                App::getRouter()->forwardTo("workoutListShow");
            } else {
                $this->generateView();
            }
	}
	public function generateView(){
                App::getSmarty()->assign('msgs', App::getMessages()->getMessages());
                App::getSmarty()->assign('msgs_count', App::getMessages()->getSize());
                App::getSmarty()->assign('forms_view',$this->forms_view);
		App::getSmarty()->assign('form',$this->form); // dane formularza do widoku
                App::getSmarty()->display('RegisterView.tpl');		
	}
    
}
