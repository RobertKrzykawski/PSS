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
            Utils::addErrorMessage('Wystąpił błąd podczas pobierania listy użytkowników.');
            if (App::getConf()->debug) {
                Utils::addErrorMessage($e->getMessage());
            }
        }
        App::getSmarty()->display('EmployeeUsersTable.tpl');
    }

    public function action_userEdit() {
        $this->form->user_id = ParamUtils::getFromCleanURL(1, true, 'Błąd ID użytkownika');
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
                Utils::addErrorMessage("Nie znaleziono użytkownika o podanym ID.");
                App::getRouter()->redirectTo('displayUsers');
                return;
            }

            App::getSmarty()->assign('users', $users);
        } catch (\PDOException $e) {
            Utils::addErrorMessage('Wystąpił błąd podczas pobierania rekordu.');
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
            Utils::addErrorMessage("Nie znaleziono użytkownika.");
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
            Utils::addErrorMessage('Nie podano żadnych danych do aktualizacji.');
            App::getRouter()->redirectTo('displayUsers');
            return;
        }
        
        try {
            // Update user record
            App::getDB()->update("users", $updatedData, ["user_id" => $this->form->user_id]);
            Utils::addInfoMessage('Dane użytkownika zostały zaktualizowane.');
        } catch (\PDOException $e) {
            Utils::addErrorMessage('Błąd podczas aktualizacji danych.');
        }

        App::getRouter()->redirectTo('displayUsers');
    }
}

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
        // Validate and retrieve current page
        $current_page = max((int)ParamUtils::getFromRequest('page', false, 1), 1); // Ensure page is at least 1
        $users_per_page = 10; // Number of users per page

        try {
            // Total users count and total pages
            $total_users = App::getDB()->count("users");
            $total_pages = max(ceil($total_users / $users_per_page), 1);

            // Offset for pagination
            $offset = ($current_page - 1) * $users_per_page;

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

            // Assign data to the view
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
        $this->form->user_id = ParamUtils::getFromCleanURL(1, true, 'Błąd ID użytkownika');
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
                Utils::addErrorMessage("Nie znaleziono użytkownika o podanym ID.");
                App::getRouter()->redirectTo('displayUsers');
                return;
            }

            App::getSmarty()->assign('users', $users);
        } catch (\PDOException $e) {
            Utils::addErrorMessage('Wystąpił błąd podczas pobierania rekordu.');
            if (App::getConf()->debug) {
                Utils::addErrorMessage($e->getMessage());
            }
        }

        App::getSmarty()->assign('form', $this->form);
        App::getSmarty()->display('UserEditView.tpl');
    }

    public function action_userSave() {
         // Retrieve input data
        $this->form->user_id = ParamUtils::getFromRequest('user_id');
        $this->form->name = ParamUtils::getFromRequest('name');
        $this->form->surname = ParamUtils::getFromRequest('surname');
        $this->form->email = ParamUtils::getFromRequest('email');
        $this->form->role_id = ParamUtils::getFromRequest('role_id');
        $this->form->active = ParamUtils::getFromRequest('active');

        // Validate user existence
        $user = App::getDB()->get("users", "*", ["user_id" => $this->form->user_id]);

        if (!$user) {
            Utils::addErrorMessage("No user with the specified ID found.");
            App::getRouter()->redirectTo('displayUsers');
            return;
        }

        // Validate input fields
        if (!$this->validateUserInput()) {
            App::getRouter()->redirectTo('userEdit/' . $this->form->user_id);
            return;
        }

        // Prepare updated data
       $updatedData = [
            "name" => $this->form->name ?: $currentUser['name'],
            "surname" => $this->form->surname ?: $currentUser['surname'],
            "email" => $this->form->email ?: $currentUser['email'],
            "role_id" => $this->form->role_id ?: $currentUser['role_id'],
            "active" => isset($this->form->active) ? $this->form->active : $currentUser['active']
        ];

        // Check if at least one field is updated
        if (empty($updatedData)) {
            Utils::addErrorMessage('Nie podano żadnych danych do aktualizacji.');
            App::getRouter()->redirectTo('displayUsers');
            return;
        }
        
        try {
            // Update user record
            App::getDB()->update("users", $updatedData, ["user_id" => $this->form->user_id]);
            Utils::addInfoMessage('User data has been updated.');
        } catch (\PDOException $e) {
            Utils::addErrorMessage('Error while updating data.');
            if (App::getConf()->debug) {
                Utils::addErrorMessage($e->getMessage());
            }
        }

        App::getRouter()->redirectTo('displayUsers');
    }

    private function validateUserInput() {
        // Check if required fields are filled
        if (empty($this->form->name) || empty($this->form->surname) || empty($this->form->email)) {
            Utils::addErrorMessage('Name, surname and email are required.');
            return false;
        }

        // Validate email format
        if (!filter_var($this->form->email, FILTER_VALIDATE_EMAIL)) {
            Utils::addErrorMessage('Incorrect email address format.');
            return false;
        }

        // Validate role_id
        if (!is_numeric($this->form->role_id) || $this->form->role_id <= 0) {
            Utils::addErrorMessage('Invalid user role.');
            return false;
        }

        return true;
    }
}
