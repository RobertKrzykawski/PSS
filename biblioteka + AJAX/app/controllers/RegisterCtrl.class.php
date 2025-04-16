<?php

namespace app\controllers;

use core\App;
use core\Utils;
use core\ParamUtils;
use core\Validator;
use app\forms\RegisterForm;

class RegisterCtrl {
    private $form;

    public function __construct() {
        $this->form = new RegisterForm();
    }

    public function action_register() {
        // Check if the form was submitted
        if ($this->isFormSubmitted()) {
            // Validate the form data
            if ($this->validate()) {
                try {
                    // Hash the password securely
                    $hashedPassword = password_hash($this->form->password, PASSWORD_DEFAULT);

                    // Insert the new user into the database
                    App::getDB()->insert("users", [
                        "name" => $this->form->name,
                        "surname" => $this->form->surname,
                        "email" => $this->form->email,
                        "password" => $hashedPassword,
                        "active" => 1, // Default active state
                        "role_id" => 3 // Default role for a new user
                    ]);           

                    // Redirect to the login page upon successful registration
                    Utils::addInfoMessage('Registration completed successfully.');
                    App::getRouter()->redirectTo('loginShow');
                } catch (\PDOException $e) {
                    Utils::addErrorMessage('An error occurred during registration.');
                    if (App::getConf()->debug) {
                        Utils::addErrorMessage($e->getMessage());
                    }
                }
            }
        }
        // Show the registration form (in case of a GET request or failed validation)
        $this->generateView();
    }

    public function action_registerShow() {
        // Display the registration form
        $this->generateView();
    }

    private function isFormSubmitted() {
        // Check if the form was submitted by verifying if the 'name' parameter exists in the request
        return ParamUtils::getFromRequest('name') !== null;
    }

    private function validate() {
        $validator = new Validator();
        $isValid = true;

         // Validate the 'name' field
         $this->form->name = $validator->validateFromRequest('name', [
            'required' => true,
            'required_message' => 'Name is required.',
            'min_length' => 2,
            'max_length' => 50,
            'validator_message' => 'Name must be between 2 and 50 characters long.'
        ]);
        if (!$validator->isLastOK()) {
            $isValid = false;
        }

        // Validate the 'surname' field
        $this->form->surname = $validator->validateFromRequest('surname', [
            'required' => true,
            'required_message' => 'Surname is required.',
            'min_length' => 2,
            'max_length' => 50,
            'validator_message' => 'Surname must be between 2 and 50 characters long.'
        ]);
        if (!$validator->isLastOK()) {
            $isValid = false;
        }

        // Validate the 'email' field
        $this->form->email = $validator->validateFromRequest('email', [
            'required' => true,
            'required_message' => 'Email is required.',
            'email' => true,
            'validator_message' => 'Invalid email format.'
        ]);
        if (!$validator->isLastOK()) {
            $isValid = false;
        }

        // Validate the 'password' field
        $this->form->password = $validator->validateFromRequest('password', [
            'required' => true,
            'required_message' => 'Password is required.',
            'min_length' => 8,
            'validator_message' => 'Password must be at least 8 characters long.'
        ]);
        if (!$validator->isLastOK()) {
            $isValid = false;
        }

        // Validate the 'confirm_password' field
        $this->form->confirm_password = $validator->validateFromRequest('confirm_password', [
            'required' => true,
            'required_message' => 'Password confirmation is required.'
        ]);
        if (!$validator->isLastOK()) {
            $isValid = false;
        }

        // Check if the 'password' and 'confirm_password' fields match
        if ($this->form->password !== $this->form->confirm_password) {
            Utils::addErrorMessage('Passwords do not match.');
            $isValid = false;
        }

        return $isValid;
    }

    private function generateView() {
        App::getSmarty()->assign('form', $this->form);
        App::getSmarty()->display('RegisterView.tpl');
    }
}
