<?php

namespace app\transfer;

class User {
    public $login;
    public $email;
    public $role;
    public $id_user;
	
	public function __construct($login, $role, $email,$id_user){
		$this->login = $login;
		$this->role = $role;
                $this->email = $email;
                $this->id_user=$id_user;
	}
}
