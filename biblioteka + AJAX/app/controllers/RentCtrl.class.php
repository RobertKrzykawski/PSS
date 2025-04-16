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
            Utils::addErrorMessage("You must be logged in to rent a book.");
            $this->generateView();
            return;
        }
    
        // Handle form submission via POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->validate()) {
                try {

                    $user_id = SessionUtils::load("user", true)->user_id; // Get user ID from session
                    $currentDate = date('Y-m-d'); // Current date
                    $nextMonthDate = date('Y-m-d', strtotime('+1 month')); // Return date (1 month later)
    
                    // Start transaction
                    App::getDB()->pdo->beginTransaction();
    
                    // Insert the rent record
                    App::getDB()->insert("rents", [
                        "user_id" => $user_id,
                        "book_id" => $this->form->book_id,
                        "rent_date" => $currentDate,
                        "return_date" => $nextMonthDate,
                        "status" => "Wypożyczone"
                    ]);
    
                    $rent_id = App::getDB()->id(); // Get the ID of the inserted rent record
                    if ($rent_id === 0) {
                        throw new \Exception("Failed to add the rental record to the database.");
                    }
    
                    // Update the available_copies for the rented book
                    $affectedRows = App::getDB()->update("books", [
                        "available_copies[-]" => 1
                    ], [
                        "book_id" => $this->form->book_id,
                        "available_copies[>]" => 0 // Ensure only books with available copies are updated
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
            Utils::addErrorMessage('Please select a book to rent.');
            return false;
        }
    
        return true;
    }

    private function generateView() {
        try {
            // Fetch all books with their availability
            $books = App::getDB()->select("books", [
                "book_id",
                "title",
                "author",
                "available_copies"
            ]);

            // Assign necessary data to the view
            App::getSmarty()->assign('books', $books);
            App::getSmarty()->assign('currentDate', date('Y-m-d'));
            App::getSmarty()->assign('nextMonthDate', date('Y-m-d', strtotime('+1 month')));
            App::getSmarty()->assign('isLoggedIn', SessionUtils::load("user", true) ? true : false);
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
