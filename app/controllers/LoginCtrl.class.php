<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace app\controllers;

use app\forms\LoginForm;
use app\transfer\User;
use core\RoleUtils;
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
        }
	public function validate() {
                if(isset($_SESSION['user'])) {
                     App::getSmarty()->assign('user',unserialize($_SESSION['user']));
                     $this->forms_view = false;
                     $this->generateView();
                } else {
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
                
            return $this->val = App::getMessages()->isEmpty();
            }
	}

	public function action_loginView(){
                $this->forms_view = true;
                $this->generateView();
            
	}
	
	public function action_login(){
            if($this->validate()){
                $records = App::getDB()->select("users", "*", [
                        "login" => $this->form->login
                ]);
                if(count($records) == 1 && $records[0]["password"]==hash('sha256', $this->form->pass)){
                    $this->user = new User($records[0]["login"],$records[0]["role"],$records[0]["mail"],$records[0]["id_users"]);
                    $_SESSION['user'] = serialize($this->user);
                    $this->forms_view = false;
                    App::getSmarty()->assign('user',unserialize($_SESSION['user']));
                    RoleUtils::addRole($records[0]["role"]);
                    App::getRouter()->forwardTo("workoutListShow");
                } else {
                    App::getMessages()->addMessage(new \core\Message("Niepoprawne haslo lub login", \core\Message::ERROR));
                    $this->generateView();
                }
            }
	}
	
	public function action_logout(){
                unset($_SESSION['user']);
		session_destroy();
                $this->forms_view = false;
                App::getRouter()->forwardTo("workoutListShow");
	}	
	
	public function generateView(){
                App::getSmarty()->assign('forms_view',$this->forms_view);
                App::getSmarty()->assign('form',$this->form);
                App::getSmarty()->assign('msgs', App::getMessages()->getMessages());
                App::getSmarty()->assign('msgs_count', App::getMessages()->getSize());
                App::getSmarty()->display('LoginView.tpl');
            }
    
}
