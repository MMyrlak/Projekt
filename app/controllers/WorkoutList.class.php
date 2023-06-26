<?php

namespace app\controllers;

use core\App;
use core\Message;
use core\Utils;
use core\ParamUtils;
use core\Validator;
use app\forms\WorkoutForm;
/**
 * HelloWorld built in Amelia - sample controller
 *
 * @author Przemysław Kudłacik
 */
class WorkoutList {
    private $forms_view;
    private $allocation;
    private $workout;
    private $offset;
    private $temp;
    private $body_parts;
    
    public function __construct() {
        $this->forms_view = false;
    }
    public function action_workoutListShow() {
        $this->allocation = App::getDB()->select("body_parts","*");
        $this->offset = intval(ParamUtils::getFromCleanURL(1, false));
        $this->body_parts = intval(ParamUtils::getFromCleanURL(2, false));
        if($this->offset<0 || $this->offset==null) $this->offset=0;
        if($this->body_parts<0 || $this->body_parts==null) $this->body_parts=0;
        if($this->body_parts > 0){
            $this->temp = App::getDB()->select("allocation", "id_workout", ["id_body_parts" => $this->body_parts, 'LIMIT' => [(intval($this->offset)*12), ((intval($this->offset)*12)+13)]]);
            $this->workout = App::getDB()->select("workout", "*", ["id_workout" => $this->temp]);
        } else {
            $this->workout=App::getDB()->select("workout", "*", ['LIMIT' => [(intval($this->offset)*12), ((intval($this->offset)*12)+13)]]);
        }
        
        $this->generate_view();
    }
    function generate_view(){
        if(isset($_SESSION['user'])){App::getSmarty()->assign('user',unserialize($_SESSION['user']));}
        App::getSmarty()->assign('offset', $this->offset);
        App::getSmarty()->assign('msgs_count', App::getMessages()->getSize());
        App::getSmarty()->assign('msgs', App::getMessages()->getMessages());
        App::getSmarty()->assign('forms_view',$this->forms_view);
        App::getSmarty()->assign('workout_count', count($this->workout));
        App::getSmarty()->assign('workout', $this->workout);
        App::getSmarty()->assign('body_parts', $this->allocation);
        App::getSmarty()->assign('body_parts_offset', $this->body_parts);
        App::getSmarty()->display("workoutList.tpl");
    }
}
