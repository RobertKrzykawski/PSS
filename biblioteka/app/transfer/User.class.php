<?php

namespace app\transfer;

class User {
    public $user_id;
    public $name;
    public $surname;
    public $email;
    public $roleNames;

    public function __construct($user_id, $name, $surname, $email, $roleNames) {
        $this->user_id = $user_id;
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->roleNames = $roleNames;
    }
}