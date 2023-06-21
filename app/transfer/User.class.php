<?php

namespace app\transfer;

class User {
    public $login;
    public $email;
    public $role;
	
	public function __construct($login, $role, $email){
		$this->login = $login;
		$this->role = $role;
                $this->email = $email;
	}
}
