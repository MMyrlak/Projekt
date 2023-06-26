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
    private $ajax;
    public function __construct() {
        $this->form = new WorkoutForm();
        $this->forms_view = false;
        $this->ajax = false;
    }
    public function action_workoutListShow() {
        $this->offset = intval(ParamUtils::getFromCleanURL(1, false));
        if($this->offset<0|| $this->offset==null) $this->offset=0;
        $this->allocation = App::getDB()->select('body_parts', "*");
        $this->workout=App::getDB()->select("workout", "*", ['LIMIT' => [(intval($this->offset)*10), ((intval($this->offset)*10)+25)]]);
        $this->generate_view();
    }
    public function action_workoutPartListShow() {
        $this->offset=0;
        $this->form->body_parts = ParamUtils::getFromRequest('body_parts_select');
        if($this->form->body_parts<0 || $this->form->body_parts==null) $this->form->body_parts = 0;
        $this->allocation = App::getDB()->select('body_parts', "*");
        $this->workout=App::getDB()->select("allocation", "id_workout", ["id_body_parts" => $this->form->body_parts, 'LIMIT' => [($this->offset*10), (($this->offset*10)+25)]]);
        $this->workout=App::getDB()->select("workout", "*", ["id_workout" => $this->workout]);
        $this->ajax = true;
        $this->generate_view();
    }
            function generate_view(){
        if(isset($_SESSION['user'])){App::getSmarty()->assign('user',unserialize($_SESSION['user']));}
        App::getSmarty()->assign('body_parts',$this->allocation);
        App::getSmarty()->assign('offset', $this->offset);
        App::getSmarty()->assign('msgs_count', App::getMessages()->getSize());
        App::getSmarty()->assign('msgs', App::getMessages()->getMessages());
        App::getSmarty()->assign('form', $this->form);
        App::getSmarty()->assign('forms_view',$this->forms_view);
        App::getSmarty()->assign('workout_count', count($this->workout));
        App::getSmarty()->assign('workout', $this->workout);
        if($this->ajax) App::getSmarty()->display("workoutTable.tpl");
        else App::getSmarty()->display("workoutList.tpl");
    }
}
