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
    private $maxLoginAttempts = 3; // Maximum allowed failed login attempts

    public function __construct() {
        $this->form = new LoginForm();
    }

    public function validateLogin() {
        // Check if the account is locked due to too many failed attempts
        $loginAttempts = SessionUtils::load("login_attempts", false);
        if ($loginAttempts && $loginAttempts >= $this->maxLoginAttempts) {
            App::getMessages()->addMessage(new Message('Your account has been locked due to too many failed login attempts. Please try again later.', Message::ERROR));
            return false;
        }
        $validator = new Validator();
        
        // Validate login (email)
        $this->form->login = $validator->validateFromRequest("login", [
            'required' => true,
            'required_message' => 'Login is required.',
        ]);
        
        if (!$validator->isLastOK()) {
            App::getMessages()->addMessage(new Message('Login is missing.', Message::ERROR));
            return false;
        }

        $this->form->password = $validator->validateFromRequest("password", [
            'required' => true,
            'required_message' => 'Password is required.',
        ]);
        
        if (!$validator->isLastOK()) {
            App::getMessages()->addMessage(new Message('Password is missing.', Message::ERROR));
            return false;
        }
        
        // Check database for user credentials
        try {
            $user = App::getDB()->get("users", "*", [
                "email" => $this->form->login
            ]);

            // Verify if user exists and password matches
            if ($user && password_verify($this->form->password, $user["password"])) {
                // Clear failed login attempts
                SessionUtils::remove("login_attempts");

                // Start a new session (secure session handling)
                session_regenerate_id(true); // Regenerate session ID to prevent session fixation

                // Retrieve user roles
                $roles = App::getDB()->select("users", [
                    "[><]roles" => ["role_id" => "role_id"]
                ], [
                    "roles.role_name"
                ], [
                    "users.user_id" => $user["user_id"]
                ]);

                if ($roles) {
                    $roleNames = array_column($roles, "role_name");

                    $userObj = new User(
                        $user["user_id"],
                        $user["name"],
                        $user["surname"],
                        $user["email"],
                        $roleNames,
                        $this->form->login
                    );

                    SessionUtils::store("user", $userObj);

                    // Assign roles
                    foreach ($roleNames as $role) {
                        RoleUtils::addRole($role);
                    }

                    return true;
                } else {
                    App::getMessages()->addMessage(new Message('User roles not found.', Message::ERROR));
                }
            } else {
                // Increment login attempts
                $this->incrementLoginAttempts();
                App::getMessages()->addMessage(new Message('Invalid login or password.', Message::ERROR));
            }
        } catch (\PDOException $e) {
            App::getMessages()->addMessage(new Message('An error occurred during login.', Message::ERROR));
            if (App::getConf()->debug) {
                App::getMessages()->addMessage(new Message($e->getMessage(), Message::ERROR));
            }
        }

        return false;
    }

    private function incrementLoginAttempts() {
        $loginAttempts = SessionUtils::load("login_attempts", false);
        if (!$loginAttempts) {
            $loginAttempts = 0;
        }
        $loginAttempts++;
        SessionUtils::store("login_attempts", $loginAttempts);
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

        // Remove roles
        if ($user && isset($user->roles)) {
            foreach ($user->roles as $role) {
                RoleUtils::removeRole($role);
            }
        }

        // Clear session and destroy it
        SessionUtils::remove("user");
        session_destroy();

        App::getRouter()->redirectTo('aboutUs');
    }

    public function generateView() {
        App::getSmarty()->assign('form', $this->form); // Pass form data to view
        App::getSmarty()->display('LoginView.tpl');
    }
}
