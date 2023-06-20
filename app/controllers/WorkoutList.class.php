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
    private $hide_intro;
    public function __construct() {
        $hide_intro = false;
    }
    public function action_workoutListShow() {
        App::getSmarty()->assign('hide_intro',$this->hide_intro);
        App::getSmarty()->display("workoutList.tpl");
    }
    
}
