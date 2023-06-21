<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace app\controllers;

use app\forms\LoginForm;
use app\transfer\User;
use core\Message;
use core\Validator;
use core\App;

class LoginCtrl {
    private $form;
    private $forms_view;
    private $records;
    private $user;
    public function __construct(){
		$this->form = new LoginForm();
                $this->forms_view = true;
                $this->val = false;
        }
	public function validate() {
                $v = new Validator();
		$this->form->login = $v->validateFromRequest("login", [
                                'required' => true,
                                'required_message' => 'Login jest wymagany',
                                'validator_message' => 'Brak loginu'
                              ]);
                $this->form->pass = $v->validateFromRequest("password", [
                                'required' => true,
                                'required_message' => 'Haslo jest wymagane',
                                'validator_message' => 'Brak loginu'
                              ]);
                
            $this->val = App::getMessages()->isEmpty();
            return $this->val;
	}

	public function action_loginView(){
            $this->generateView(); 
	}
	
	public function action_login(){
            if(session_status()==2){
                $this->val=true;
                $this->generateView();
            }
            if($this->validate()){
                $records = App::getDB()->select("users", "*", [
                        "login" => $this->form->login
                ]);
                if(count($records) == 1 && $records[0]["password"]==hash('sha256', $this->form->pass)){
                    $this->user = new User($records[0]["login"],$records[0]["role"],$records[0]["mail"]);
                    $_SESSION['user'] = serialize($this->user);
                    $this->forms_view = false;
                    App::getSmarty()->assign('user',unserialize($_SESSION['user']));
                } else {
                    App::getMessages()->addMessage(new \core\Message("Niepoprawne haslo lub login", \core\Message::ERROR));
                    $this->val = false;
                }
            }
            $this->generateView();
	}
	
	public function action_logout(){
		session_destroy();
                $this->forms_view = false;
                $this->val = true;
                $this->generateView();
	}	
	
	public function generateView(){
                App::getSmarty()->assign('forms_view',$this->forms_view);
                App::getSmarty()->assign('form',$this->form);
                App::getSmarty()->assign('msgs', App::getMessages()->getMessages());
                App::getSmarty()->assign('forms_view',$this->forms_view);
		App::getSmarty()->assign('form',$this->form); // dane formularza do widoku
                if($this->val) App::getSmarty()->display('workoutList.tpl');
                else App::getSmarty()->display('LoginView.tpl');
	}
    
}
