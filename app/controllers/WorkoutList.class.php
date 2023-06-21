<?php

namespace app\controllers;

use core\App;
use core\Message;
use core\Utils;

/**
 * HelloWorld built in Amelia - sample controller
 *
 * @author Przemysław Kudłacik
 */
class WorkoutList {
    private $forms_view;
    public function __construct() {
        $forms_view = false;
    }
    public function action_workoutListShow() {
        App::getSmarty()->assign('msgs_size', App::getMessages()->getSize());
        App::getSmarty()->assign('msgs', App::getMessages()->getMessages());
        App::getSmarty()->assign('forms_view',$this->forms_view);
        App::getSmarty()->display("workoutList.tpl");
    }
    
}
