<?php

namespace app\controllers;

use core\App;
use core\Message;
use core\Validator;
use core\RoleUtils;
use core\SessionUtils;
use app\transfer\User;
use app\forms\LoginForm;

class LoginCtrl {

    private $form;

    public function __construct() {
        $this->form = new LoginForm();
    }

    public function validateLogin() {
        $validator = new Validator();
        
        $this->form->login = $validator->validateFromRequest("login", [
            'required' => true,
            'required_message' => 'Login jest wymagany.',
        ]);
        
        if (!$validator->isLastOK()) {
            App::getMessages()->addMessage(new Message('Nie podano loginu.', Message::ERROR));
            return false;
        }

        $this->form->password = $validator->validateFromRequest("password", [
            'required' => true,
            'required_message' => 'Hasło jest wymagane.',
        ]);
        
        if (!$validator->isLastOK()) {
            App::getMessages()->addMessage(new Message('Nie podano hasła.', Message::ERROR));
            return false;
        }
        
        try {
            $user = App::getDB()->get("users", "*", [
                "email" => $this->form->login
            ]);

            if ($user && password_verify($this->form->password, $user["password"])) {
                $userRoles = App::getDB()->select("users", [
                    "[><]roles" => ["role_id" => "role_id"]
                ], [
                    "roles.role_name"
                ], [
                    "users.user_id" => $user["user_id"]
                ]);

                if ($userRoles) {
                    $roles = array_column($userRoles, "role_name");

                    $userObj = new User(
                        $user["user_id"],
                        $user["name"],
                        $user["surname"],
                        $user["email"],
                        $roles,
                        $this->form->login
                    );

                    SessionUtils::store("user", $userObj);
                    SessionUtils::store("user_id", $user[0]["user_id"]);

                    foreach ($roles as $role) {
                        RoleUtils::addRole($role); // Pass each role as a string
                    }

                    return true;
                } else {
                    App::getMessages()->addMessage(new Message('Nie znaleziono roli użytkownika.', Message::ERROR));
                }
            } else {
                App::getMessages()->addMessage(new Message('Nieprawidłowy login lub hasło.', Message::ERROR));
            }
        } catch (\PDOException $e) {
            App::getMessages()->addMessage(new Message('Wystąpił błąd podczas logowania.', Message::ERROR));
            if (App::getConf()->debug) {
                App::getMessages()->addMessage(new Message($e->getMessage(), Message::ERROR));
            }
        }

        return false;
    }

    public function action_loginShow() {
        $this->generateView();
    }

    public function action_login() {
        if ($this->validateLogin()) {
            App::getRouter()->redirectTo("aboutUs");
        } else {
            $this->generateView();
        }
    }

    public function action_logout() {
        $user = SessionUtils::load("user", true);
        if ($user && isset($user->roles)) {
            foreach ($user->roles as $role) {
                RoleUtils::removeRole($role);
            }
        }

        SessionUtils::remove("user");
        session_destroy();

        App::getRouter()->redirectTo('aboutUs');
    }

    public function generateView() {
        App::getSmarty()->assign('form', $this->form); // dane formularza do widoku
        App::getSmarty()->display('LoginView.tpl');
    }
}
