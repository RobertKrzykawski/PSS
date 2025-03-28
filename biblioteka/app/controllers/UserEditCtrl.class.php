<?php

namespace app\controllers;

use core\App;
use core\Utils;
use core\ParamUtils;
use app\forms\UserEditForm;

class UserEditCtrl {
    private $form;

    public function __construct() {
        $this->form = new UserEditForm();
    }

    public function action_displayUsers() {
        // Handle pagination and fetch user list
        $current_page = ParamUtils::getFromRequest('page', false, 1);
        if ($current_page <= 0) {
            $current_page = 1;  // Ensure the current page is always greater than 0
        }
        $users_per_page = 10; // Number of users per page

        try {
            // Total users count
            $total_users = App::getDB()->count("users");

            // Total pages calculation
            $total_pages = ceil($total_users / $users_per_page);

            // Offset for pagination
            $offset = ($current_page - 1) * $users_per_page;
            if ($offset < 0) {
                $offset = 0;  // Ensure the offset is non-negative
            }

            // Fetch paginated user data
            $users = App::getDB()->select("users", [
                "[><]roles" => ["role_id" => "role_id"]
            ], [
                "users.user_id",
                "users.name",
                "users.surname",
                "users.email",
                "users.role_id",
                "users.active",
                "roles.role_name(role_name)"
            ], [
                "ORDER" => ["users.user_id" => "ASC"],
                "LIMIT" => [$offset, $users_per_page]
            ]);

            App::getSmarty()->assign('users', $users);
            App::getSmarty()->assign('current_page', $current_page);
            App::getSmarty()->assign('total_pages', $total_pages);
        } catch (\PDOException $e) {
            Utils::addErrorMessage('An error occurred while retrieving the user list..');
            if (App::getConf()->debug) {
                Utils::addErrorMessage($e->getMessage());
            }
        }
        App::getSmarty()->display('EmployeeUsersTable.tpl');
    }

    public function action_userEdit() {
        $this->form->user_id = ParamUtils::getFromCleanURL(1, true, 'User ID error.');
        try {
            // Fetch user details for editing
            $users = App::getDB()->select("users", [
                "[><]roles" => ["role_id" => "role_id"]
            ], [
                "users.user_id",
                "users.name",
                "users.surname",
                "users.email",
                "users.active",
                "roles.role_name"
            ], [
                "users.user_id" => $this->form->user_id // Filter by user_id
            ]);

            if (!$users) {
                Utils::addErrorMessage("No user with the specified ID found.");
                App::getRouter()->redirectTo('displayUsers');
                return;
            }

            App::getSmarty()->assign('users', $users);
        } catch (\PDOException $e) {
            Utils::addErrorMessage('An error occurred while retrieving the record.');
            if (App::getConf()->debug) {
                Utils::addErrorMessage($e->getMessage());
            }
        }

        App::getSmarty()->assign('form', $this->form);
        App::getSmarty()->display('UserEditView.tpl');
    }

    public function action_userSave() {
        $this->form->user_id = ParamUtils::getFromRequest('user_id');
        $this->form->name = ParamUtils::getFromRequest('name');
        $this->form->surname = ParamUtils::getFromRequest('surname');
        $this->form->email = ParamUtils::getFromRequest('email');
        $this->form->role_id = ParamUtils::getFromRequest('role_id');
        $this->form->active = ParamUtils::getFromRequest('active');

        $currentUser = App::getDB()->get("users", "*", ["user_id" => $this->form->user_id]);

        if (!$currentUser) {
            Utils::addErrorMessage("No user with the specified ID found.");
            return;
        }

        $updatedData = [
            "name" => $this->form->name ?: $currentUser['name'],
            "surname" => $this->form->surname ?: $currentUser['surname'],
            "email" => $this->form->email ?: $currentUser['email'],
            "role_id" => $this->form->role_id ?: $currentUser['role_id'],
            "active" => isset($this->form->active) ? $this->form->active : $currentUser['active']
        ];

        // Check if at least one field is updated
        if (empty($updatedData)) {
            Utils::addErrorMessage('No data was provided for updating.');
            App::getRouter()->redirectTo('displayUsers');
            return;
        }
        
        try {
            // Update user record
            App::getDB()->update("users", $updatedData, ["user_id" => $this->form->user_id]);
            Utils::addInfoMessage('User data has been updated.');
        } catch (\PDOException $e) {
            Utils::addErrorMessage('Error while updating data.');
        }

        App::getRouter()->redirectTo('displayUsers');
    }
}