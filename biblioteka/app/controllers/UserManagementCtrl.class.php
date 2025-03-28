<?php

namespace app\controllers;

use core\App;
use core\Utils;
use core\ParamUtils;

class UserManagementCtrl
{
    public function action_employeeUsers()
    {
        App::getSmarty()->display('EmployeeUsersView.tpl');
    }

    public function action_addUser()
    {
        $name = ParamUtils::getFromRequest('name');
        $surname = ParamUtils::getFromRequest('surname');
        $email = ParamUtils::getFromRequest('email');
        $password = ParamUtils::getFromRequest('password');
        $role_id = ParamUtils::getFromRequest('role_id');

        // Validate required fields
        if (empty($name) || empty($surname) || empty($email) || empty($password) || empty($role_id)) {
            Utils::addErrorMessage('Wszystkie pola są wymagane.');
            App::getRouter()->redirectTo('employeeUsers');
            return;
        }

         // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        if (!$hashed_password) {
            Utils::addErrorMessage('Błąd podczas szyfrowania hasła.');
            App::getRouter()->redirectTo('employeeUsers');
            return;
        }   

        try {
            $userId = App::getDB()->id();

            App::getDB()->insert("users", [
                "user_id" => $userId,
                "name" => $name,
                "surname" => $surname,
                "email" => $email,
                "password" => $hashed_password,
                "role_id" => $role_id
            ]);

            if ($rentId === 0) {
                throw new \Exception("Failed to add user to the database.");
            }

            Utils::addInfoMessage('Użytkownik został dodany.');
            
        } catch (\PDOException $e) {
            Utils::addErrorMessage('Wystąpił błąd podczas dodawania użytkownika.');
            if (App::getConf()->debug) {
                Utils::addErrorMessage($e->getMessage());
            }
        }

        App::getRouter()->redirectTo('employeeUsers');
    }
}
