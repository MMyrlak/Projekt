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
    private $form;
    private $allocation;
    private $workout;
    private $offset;
    public function __construct() {
        $this->form = new WorkoutForm();
        $this->forms_view = false;
    }
    public function action_workoutListShow() {
        $this->offset = intval(ParamUtils::getFromCleanURL(1, false));
        if($this->offset<0|| $this->offset==null) $this->offset=0;
        if(ParamUtils::getFromGet('body_parts')!=null){
            $this->form->body_parts = aramUtils::getFromGet('body_parts');
        } else {
            $this->form->body_parts = 0;
        } 
        if($this->form->body_parts > 0){
            $this->workout=App::getDB()->select("allocation", "id_workout", ["id_body_parts" => $this->form->body_parts, 'LIMIT' => [($this->offset*10), (($this->offset*10)+25)]]);
            $this->workout=App::getDB()->select("workout", "*", ["id_workout" => $this->workout, 'LIMIT' => [($this->offset*10), (($this->offset*10)+25)]]);

        } else {
        $this->workout=App::getDB()->select("workout", "*", ['LIMIT' => [(intval($this->offset)*10), ((intval($this->offset)*10)+25)]]);
       }
         $this->generate_view();
    }
    function generate_view(){
        if(isset($_SESSION['user'])){App::getSmarty()->assign('user',unserialize($_SESSION['user']));}
        App::getSmarty()->assign('offset', $this->offset);
        App::getSmarty()->assign('msgs_count', App::getMessages()->getSize());
        App::getSmarty()->assign('msgs', App::getMessages()->getMessages());
        App::getSmarty()->assign('form', $this->form);
        App::getSmarty()->assign('forms_view',$this->forms_view);
        App::getSmarty()->assign('workout_count', count($this->workout));
        App::getSmarty()->assign('workout', $this->workout);
        App::getSmarty()->display("workoutList.tpl");
    }
}
