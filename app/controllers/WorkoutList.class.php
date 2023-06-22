<?php

namespace app\controllers;

use core\App;
use core\Message;
use core\Utils;
use core\ParamUtils;
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
        $this->offset=1;
    }
    public function action_workoutListShow($offset = 0) {
        if(ParamUtils::getFromGet('body_parts')!=null){
            $this->form->body_parts = aramUtils::getFromGet('body_parts');
        } else {
            $this->form->body_parts = 0;
        } 
        if($this->form->body_parts > 0){
            $this->workout=App::getDB()->select("allocation", "*", ["id_body_parts" => $this->form->body_parts, 'LIMIT' => [($offset*10), (($offset*10)+11)]]);
        } else {
            $this->workout=App::getDB()->select("workout", "*", ['LIMIT' => [$offset, $offset+10]]);
       }
//       echo print_r($this->workout);
       $this->generate_view();
    }
    public function action_pagination(){
        $this->offset = ParamUtils::getFromCleanURL(1);
        $this->action_workoutListShow($this->offset);
    } 
    function generate_view(){
        if(isset($_SESSION['user'])) App::getSmarty()->assign('user',unserialize($_SESSION['user']));
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
