<?php

namespace app\transfer;

class User {
    public $user_id;
    public $name;
    public $surname;
    public $email;
    public $roles;

    public function __construct($user_id, $name, $surname, $email, $roles) {
        $this->user_id = $user_id;
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->roles = $roles;
    }
}