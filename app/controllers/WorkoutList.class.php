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
    
    public function action_workoutListShow() {
        App::getSmarty()->display("workoutList.tpl");
    }
    
}
