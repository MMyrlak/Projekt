<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace app\controllers;

use core\App;
use app\forms\WorkoutForm;
use core\ParamUtils;

class workoutWebCtrl{
    private $id;
    private $forms_view;
    private $workout;
    private $favorite;
    private $user_id;
    public function __construct() {
        $this->forms_view = true;
        $this->favorite = 2;
    }
    public function action_workoutWebShow() {
        $this->forms_view = true;
        $this->id = ParamUtils::getFromCleanURL(1, true);
        if($this->id==null){
            App::getRouter()->redirectTo("workoutListShow");
        }
        $this->workout= App::getDB()->select("workout", "*", ["id_workout" => $this->id]);
        if (isset($_SESSION['user'])){
            $this->user_id = unserialize($_SESSION['user']);
            $this->user_id = get_object_vars($this->user_id);
            $this->user_id = $this->user_id['id_user'];
            $this->favorite = App::getDB()->select("favorite", "*", ["id_workout" => $this->id, "id_users"=>$this->user_id]);
            $this->favorite = count($this->favorite);
        }
        $this->generate_view();
    }
    public function action_favorite() {
        $this->favorite = ParamUtils::getFromCleanURL(1, true);
        $this->id = ParamUtils::getFromCleanURL(2, true);
        $this->user_id = unserialize($_SESSION['user']);
        $this->user_id = get_object_vars($this->user_id);
        $this->user_id = $this->user_id['id_user'];
        if($this->favorite==1){
           App::getDB()->delete("favorite", [
                            "id_users" => $this->user_id,
                            "id_workout" => $this->id
                         ]);
        } else {
            App::getDB()->insert("favorite",[
                        "id_users" => $this->user_id,
                        "id_workout" => $this->id,
                        "date" => date("Y-m-d")
                       ]);
        }
        header("Location: ".App::getConf()->action_url."workoutWebShow/".$this->id);
    }
    public function generate_view(){
        if (isset($_SESSION['user'])) App::getSmarty()->assign('user',unserialize($_SESSION['user']));
        App::getSmarty()->assign('forms_view',$this->forms_view);
        App::getSmarty()->assign('msgs', App::getMessages()->getMessages());
        App::getSmarty()->assign('msgs_count', App::getMessages()->getSize());
        App::getSmarty()->assign('favorite',$this->favorite);
        App::getSmarty()->assign('page_header', $this->workout[0]['name_workout']);
        App::getSmarty()->assign('workout', $this->workout);
        App::getSmarty()->display('workoutWeb.tpl');
    }
}
