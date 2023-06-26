<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace app\controllers;

use core\App;
use app\forms\LoginForm;
use core\ParamUtils;

class accountWebCtrl {
        private $user_id;
        private $favorite;
        private $workout;
        private $offset;
    public function __construct(){
                $this->forms_view = true;
                $this->workout = array();
        }
	
	public function action_myAccount(){
            $this->offset = intval(ParamUtils::getFromCleanURL(1, false));
            if($this->offset<0||$this->offset==null) $this->offset=0;
            $this->user_id = unserialize($_SESSION['user']);
            $this->user_id = get_object_vars($this->user_id);
            $this->favorite = App::getDB()->select('favorite', 'id_workout', ['id_users' => $this->user_id]);
            if ($this->favorite!=null) {
            $this->workout=App::getDB()->select("workout", "*", ["id_workout" => $this->favorite, 'LIMIT' => [($this->offset*10), (($this->offset*10)+25)]]);
            }

            
            $this->generateView();
        }               
	
	public function generateView(){
                App::getSmarty()->assign('user',unserialize($_SESSION['user']));
                App::getSmarty()->assign('forms_view',$this->forms_view);
                App::getSmarty()->assign('page_header', $this->user_id['login']);
                App::getSmarty()->assign('workout_count', count($this->workout));
                App::getSmarty()->assign('workout', $this->workout);
                App::getSmarty()->assign('msgs', App::getMessages()->getMessages());
                App::getSmarty()->assign('msgs_count', App::getMessages()->getSize());
                App::getSmarty()->assign('offset', $this->offset);
                App::getSmarty()->display('myAccount.tpl');
            }
    
}
