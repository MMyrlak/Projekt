<?php

use core\App;
use core\Utils;

App::getRouter()->setDefaultRoute('workoutListShow'); #default action
App::getRouter()->setLoginRoute('login'); #action to forward if no permissions

Utils::addRoute('workoutListShow', 'WorkoutList');
Utils::addRoute('login', 'LoginCtrl');
Utils::addRoute('logout', 'LoginCtrl');
Utils::addRoute('loginView', 'LoginCtrl');
Utils::addRoute('register', 'RegisterCtrl');
Utils::addRoute('registerView', 'RegisterCtrl');
Utils::addRoute('workoutWebShow', 'workoutWebCtrl');
//======USER=====
Utils::addRoute('favorite', 'workoutWebCtrl', ["user", "admin"]);
//======ADMIN=====
Utils::addRoute('workoutView', 'WorkoutCtrl',["admin"]);
Utils::addRoute('addWorkout', 'WorkoutCtrl',["admin"]);


//Utils::addRoute('action_name', 'controller_class_name');