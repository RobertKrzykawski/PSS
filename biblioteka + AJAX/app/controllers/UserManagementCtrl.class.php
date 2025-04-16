<?php

namespace app\controllers;

use core\App;
use core\Utils;
use core\ParamUtils;

class UserManagementCtrl
{
    public function action_employeeUsers()
    {
        // Render the view for employee users
        App::getSmarty()->display('EmployeeUsersView.tpl');
    }

    public function action_addUser()
    {
        // Retrieve form data
        $name = ParamUtils::getFromRequest('name');
        $surname = ParamUtils::getFromRequest('surname');
        $email = ParamUtils::getFromRequest('email');
        $password = ParamUtils::getFromRequest('password');
        $role_id = ParamUtils::getFromRequest('role_id');

        // Validate required fields
        if (!$this->validateUserInput($name, $surname, $email, $password, $role_id)) {
            // Redirect back to the form while preserving entered values
            App::getSmarty()->assign(compact('name', 'surname', 'email', 'role_id'));
            App::getRouter()->redirectTo('employeeUsers');
            return;
        }

        try {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Check if email already exists
            if ($this->emailExists($email)) {
                Utils::addErrorMessage('This email address is taken already.');
                App::getSmarty()->assign(compact('name', 'surname', 'email', 'role_id'));
                App::getRouter()->redirectTo('employeeUsers');
                return;
            }

            // Use a transaction for safety in case of future expansions
            App::getDB()->pdo->beginTransaction();

            // Insert user data into the database
            App::getDB()->insert("users", [
                "name" => $name,
                "surname" => $surname,
                "email" => $email,
                "password" => $hashed_password,
                "role_id" => $role_id
            ]);

            // Check if the user was successfully added
            if (App::getDB()->id() === 0) {
                throw new \Exception("Failed to add user to the database.");
            }

            App::getDB()->pdo->commit();
            Utils::addInfoMessage('User has been added.');

        } catch (\PDOException $e) {
            App::getDB()->pdo->rollBack(); // Rollback transaction if something fails
            Utils::addErrorMessage('An error occurred while adding the user.');
            if (App::getConf()->debug) {
                Utils::addErrorMessage($e->getMessage());
            }
        }

        App::getRouter()->redirectTo('employeeUsers');
    }

    private function validateUserInput($name, $surname, $email, $password, $role_id)
    {
        // Validate required fields
        if (empty($name) || empty($surname) || empty($email) || empty($password) || empty($role_id)) {
            Utils::addErrorMessage('All fields are required.');
            return false;
        }

        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            Utils::addErrorMessage('Incorrect email address format.');
            return false;
        }

        // Validate role_id is a number
        if (!is_numeric($role_id) || $role_id <= 0) {
            Utils::addErrorMessage('Invalid user role.');
            return false;
        }

        return true;
    }

    private function emailExists($email)
    {
        try {
            $count = App::getDB()->count("users", [
                "email" => $email
            ]);
            return $count > 0;
        } catch (\PDOException $e) {
            Utils::addErrorMessage('An error occurred while validating the email address..');
            if (App::getConf()->debug) {
                Utils::addErrorMessage($e->getMessage());
            }
            return true; // Treat as exists if we cannot confirm
        }
    }
}
