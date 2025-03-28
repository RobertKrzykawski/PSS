<?php

namespace app\controllers;

use core\App;
use core\Utils;
use core\ParamUtils;
use core\SessionUtils;
use app\forms\RentForm;

class RentCtrl {
    private $form;

    public function __construct() {
        $this->form = new RentForm();
    }

    public function action_rent() {
        // Check if the user is logged in
        if (!SessionUtils::load("user", true)) {
            $this->generateView();
            return;
        }
    
        // Check if this is a POST request (form submission)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->validate()) {
                try {

                    $userId = SessionUtils::load("user", true)->id;
                    $currentDate = date('Y-m-d');
                    $nextMonthDate = date('Y-m-d', strtotime('+1 month'));
    
                    // Start transaction
                    App::getDB()->pdo->beginTransaction();
    
                    // Insert the rent record
                    $rentId = App::getDB()->id();
                    App::getDB()->insert("rents", [
                        "rent_id" => $rentId,
                        "user_id" => $userId,
                        "book_id" => $this->form->book_id,
                        "rent_date" => $currentDate,
                        "return_date" => $nextMonthDate
                    ]);
    
                    if ($rentId === 0) {
                        throw new \Exception("Failed to add rent to the database.");
                    }
    
                    // Update the available_copies for the rented book
                    $affectedRows = App::getDB()->update("books", [
                        "available_copies[-]" => 1
                    ], [
                        "book_id" => $this->form->book_id,
                        "available_copies[>]" => 0
                    ]);
    
                    if ($affectedRows === 0) {
                        throw new \Exception("Failed to update book availability. The book may be out of stock.");
                    }
    
                    // Commit transaction
                    App::getDB()->pdo->commit();
    
                    Utils::addInfoMessage('Book rental successfully registered.');
                    App::getRouter()->redirectTo('rentHistory');
                } catch (\PDOException $e) {
                    App::getDB()->pdo->rollBack();
                    Utils::addErrorMessage('An error occurred while processing the rent.');
                    if (App::getConf()->debug) {
                        Utils::addErrorMessage($e->getMessage());
                    }
                } catch (\Exception $e) {
                    App::getDB()->pdo->rollBack();
                    Utils::addErrorMessage($e->getMessage());
                }
            }
        }
    
        // If not POST or validation failed, display the form
        $this->generateView();
    }

    private function validate() {
        $this->form->book_id = $_POST['book_id'] ?? null;
    
        if (empty($this->form->book_id)) {
            Utils::addErrorMessage('All fields are required.');
            return false;
        }
    
        return true;
    }

    private function generateView() {
        try {
            $books = App::getDB()->select("books", ["book_id", "title", "author", "available_copies"]);
            $currentDate = date('Y-m-d');
            $nextMonthDate = date('Y-m-d', strtotime('+1 month'));
            $isLoggedIn = SessionUtils::load("user", true) ? true : false;
            App::getSmarty()->assign('books', $books);
            App::getSmarty()->assign('currentDate', $currentDate);
            App::getSmarty()->assign('nextMonthDate', $nextMonthDate);
            App::getSmarty()->assign('isLoggedIn', $isLoggedIn);
        } catch (\PDOException $e) {
            Utils::addErrorMessage('An error occurred while fetching available books.');
            if (App::getConf()->debug) {
                Utils::addErrorMessage($e->getMessage());
            }
        }
        
        App::getSmarty()->assign('form', $this->form);
        App::getSmarty()->display('RentView.tpl');
    }
}
