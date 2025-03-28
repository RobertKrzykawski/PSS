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
        if ($this->isFormSubmitted()) {
            if ($this->validate()) {
                try {
                    $hashedPassword = password_hash($this->form->password, PASSWORD_DEFAULT);
                    $userId = App::getDB()->id();

                    App::getDB()->insert("users", [
                        "name" => $this->form->name,
                        "surname" => $this->form->surname,
                        "email" => $this->form->email,
                        "password" => $hashedPassword,
                        "active" => 1,
                        "user_id" => $userId,
                        "role_id" => 3
                    ]);           

                    Utils::addInfoMessage('Rejestracja przebiegła pomyślnie.');
                    App::getRouter()->redirectTo('loginShow');
                } catch (\PDOException $e) {
                    Utils::addErrorMessage('Wystąpił błąd podczas rejestracji.');
                    if (App::getConf()->debug) {
                        Utils::addErrorMessage($e->getMessage());
                    }
                }
            }
        }
        $this->generateView();
    }

    public function action_registerShow() {
        $this->generateView();
    }

    private function isFormSubmitted() {
        return ParamUtils::getFromRequest('name') !== null;
    }

    private function validate() {
        $validator = new Validator();
        $isValid = true;

        $this->form->name = $validator->validateFromRequest('name', [
            'required' => true,
            'required_message' => 'Imię jest wymagane.',
            'min_length' => 2,
            'max_length' => 50,
            'validator_message' => 'Imię powinno mieć od 2 do 50 znaków.'
        ]);
        if (!$validator->isLastOK()) {
            $isValid = false;
        }

        $this->form->surname = $validator->validateFromRequest('surname', [
            'required' => true,
            'required_message' => 'Nazwisko jest wymagane.',
            'min_length' => 2,
            'max_length' => 50,
            'validator_message' => 'Nazwisko powinno mieć od 2 do 50 znaków.'
        ]);
        if (!$validator->isLastOK()) {
            $isValid = false;
        }

        $this->form->email = $validator->validateFromRequest('email', [
            'required' => true,
            'required_message' => 'Email jest wymagany.',
            'email' => true,
            'validator_message' => 'Nieprawidłowy format email.'
        ]);
        if (!$validator->isLastOK()) {
            $isValid = false;
        }

        $this->form->password = $validator->validateFromRequest('password', [
            'required' => true,
            'required_message' => 'Hasło jest wymagane.',
            'min_length' => 8,
            'validator_message' => 'Hasło musi mieć co najmniej 8 znaków.'
        ]);
        if (!$validator->isLastOK()) {
            $isValid = false;
        }

        $this->form->confirm_password = $validator->validateFromRequest('confirm_password', [
            'required' => true,
            'required_message' => 'Potwierdzenie hasła jest wymagane.'
        ]);
        if (!$validator->isLastOK()) {
            $isValid = false;
        }

        if ($this->form->password !== $this->form->confirm_password) {
            Utils::addErrorMessage('Hasła nie są identyczne.');
            $isValid = false;
        }

        return $isValid;
    }

    private function generateView() {
        App::getSmarty()->assign('form', $this->form);
        App::getSmarty()->display('RegisterView.tpl');
    }
}
