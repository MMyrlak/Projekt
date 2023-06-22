<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace app\controllers;

use app\forms\WorkoutForm;
use core\Message;
use core\Validator;
use core\App;

class WorkoutCtrl {
    private $form;
    private $forms_view;
    private $folder;
    private $body_parts_selection;
    public function __construct(){
		$this->form = new WorkoutForm();
                $this->forms_view = true;
                $this->val = false;
        }
	public function validate() {
                $v = new Validator();
		$this->form->name = $v->validateFromRequest("name", [
                                'required' => true,
                                'required_message' => 'Nazwa jest wymagana',
                                'validator_message' => 'Brak nazwy'
                              ]);
                $this->form->video = $v->validateFromRequest("video", [
                                'required' => true,
                                'required_message' => 'Film insturukat¿owy jest wymagany',
                                'validator_message' => 'Brak filmu instrukata¿owego'
                              ]);
                $this->form->position = $v->validateFromRequest("position", [
                                'required' => true,
                                'required_message' => 'Opis pozycji jest wymagany',
                                'validator_message' => 'Brak opisu pozycji startowej'
                              ]);
                $this->form->move = $v->validateFromRequest("move", [
                                'required' => true,
                                'required_message' => 'Opis ruchu jest wymagany',
                                'validator_message' => 'Brak opisu ruchu'
                              ]);
                $this->form->body_parts = $v->validateFromRequest("body_parts", [
                                'required' => true,
                                'required_message' => 'Wybór g³ównej partii miesni',
                                'validator_message' => 'Brak wyboru partii miesni'
                              ]);
                $this->form->photo = $_FILES["photo"]["name"];
                $this->form->tempphoto = $_FILES["photo"]["tmp_name"];
                $this->folder = App::getConf()->root_path. '/public/images/'.$this->form->photo;
            $this->val = App::getMessages()->isEmpty();
            return $this->val;
	}

	public function action_workoutView(){
                $this->body_parts_selection = App::getDB()->select("body_parts", "*");
                App::getSmarty()->assign('body_parts', $this->body_parts_selection);
                $this->val=false;
                $this->forms_view = true;
                $this->generateView();
            
	}
	
	public function action_addWorkout(){
            if($this->validate()){
                $this->forms_view = false;
                try{ 
                   $this->form->body_parts=App::getDB()->select("body_parts", ["id_body_parts"], ["name" => $this->form->body_parts]);
                   App::getDB()->insert("workout",[
                        "name_workout" => $this->form->name,
                        "video" => $this->form->video,
                        "position" => $this->form->position,
                        "move" => $this->form->move,
                        "photo" => $this->form->photo
                       ]);
                   App::getDB()->insert("allocation",[
                        "id_body_parts" => $this->form->body_parts[0]["id_body_parts"],
                        "id_workout" => App::getDB()->id(),
                       ]);
               } catch (\PDOException $ex) {
                echo $ex;
                App::getMessages()->addMessage(new \core\Message($ex, \core\Message::WARNING));
                }
                if (!move_uploaded_file($this->form->tempphoto, $this->folder)) {
                    App::getMessages()->addMessage(new \core\Message("Nie przes³ano zdjêcia", \core\Message::WARNING));
                    $this->forms_view = true;
                    $this->val = false;
                }
            }
            
	}	
	
	public function generateView(){
                App::getSmarty()->assign('user',unserialize($_SESSION['user']));
                App::getSmarty()->assign('forms_view',$this->forms_view);
                App::getSmarty()->assign('form',$this->form);
                App::getSmarty()->assign('msgs', App::getMessages()->getMessages());
                App::getSmarty()->assign('msgs_count', App::getMessages()->getSize());
                App::getSmarty()->assign('forms_view',$this->forms_view);
		App::getSmarty()->assign('form',$this->form); // dane formularza do widoku
                if($this->val){
                    App::getSmarty()->display('workoutList.tpl');
                } else {
                    App::getSmarty()->display('AddWorkoutView.tpl');
                }    
            }
    
}
