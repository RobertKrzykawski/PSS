<?php

namespace app\controllers;

use core\App;
use core\Utils;
use core\ParamUtils;

class RentManagementCtrl {
    public function action_employeeRents() {
        // Fetch filter parameters from the request
        $dateFilter = ParamUtils::getFromRequest('rent_date');
        $rentIdFilter = ParamUtils::getFromRequest('rent_id');
        $surnameFilter = ParamUtils::getFromRequest('users_surname');
        $bookTitleFilter = ParamUtils::getFromRequest('book_title');

        $conditions = [];

        if ($dateFilter) {
            $conditions['rents.rent_date'] = $dateFilter;
        }
        if ($rentIdFilter !== null && $rentIdFilter >= 0) {
            $conditions['rents.rent_id'] = $rentIdFilter;
        }
        if ($surnameFilter) {
            $conditions['users.surname[~]'] = $surnameFilter; // Partial match
        }
        if ($bookTitleFilter) {
            $conditions['books.title[~]'] = $bookTitleFilter; // Partial match
        }

        try {
            // Fetch rent records with filters
            $rents = App::getDB()->select("rents", [
                "[><]books" => ["book_id" => "book_id"],
                "[><]users" => ["user_id" => "user_id"]
            ], [
                "rents.rent_id",
                "rents.rent_date",
                "rents.return_date",
                "rents.status",
                "books.title(book_title)",
                "books.author(book_author)",
                "books.available_copies(available_copies)",
                "users.name(user_name)",
                "users.surname(user_surname)"
            ], $conditions + [
                "ORDER" => ["rents.rent_id" => "DESC"]
            ]);

            if (empty($rents)) {
                Utils::addInfoMessage('No results found for the provided filters.');
            }

            // Pass data to the view
            App::getSmarty()->assign('rents', $rents);
            App::getSmarty()->assign('date_filter', $dateFilter);
            App::getSmarty()->assign('rent_id_filter', $rentIdFilter);
            App::getSmarty()->assign('surname_filter', $surnameFilter);
            App::getSmarty()->assign('book_title_filter', $bookTitleFilter);
        } catch (\PDOException $e) {
            Utils::addErrorMessage('An error occurred while retrieving rental records.');
            if (App::getConf()->debug) {
                Utils::addErrorMessage($e->getMessage());
            }
        }
        // Render the view
        App::getSmarty()->display('EmployeeRentView.tpl');
    }

    public function action_updateRentStatus() {
        // Retrieve rent ID and new status from the request
        $rent_id = ParamUtils::getFromPost('rent_id');
        $newStatus = ParamUtils::getFromPost('status');
    
        try {
            if ($newStatus === 'Zwrócone') {
                // Retrieve rent ID and new status from the request
                $rent = App::getDB()->get("rents", "*", ["rent_id" => $rent_id]);
                if (!$rent) {
                    Utils::addErrorMessage("The specified rental record does not exist.");
                    App::getRouter()->redirectTo('employeeRents');
                    return;
                }
                $book_id = $rent['book_id'];

                // Increment the number of available copies for the book
                App::getDB()->update("books", [
                    "available_copies[+]" => 1
                ], [
                    "book_id" => $book_id
                ]);
            }

            // Set the current date as the "returned_date" if applicable
            $currentDate = date('Y-m-d');
            App::getDB()->update("rents", [
                "returned_date" => $currentDate
            ], [
                "rent_id" => $rent_id
            ]);

            // Update the rental status
            App::getDB()->update("rents", [
                "status" => $newStatus
            ], [
                "rent_id" => $rent_id
            ]);
            Utils::addInfoMessage('The rental status has been successfully updated.');
        } catch (\PDOException $e) {
            Utils::addErrorMessage('An error occurred while updating the rental status.');
            if (App::getConf()->debug) {
                Utils::addErrorMessage($e->getMessage());
            }
        }
        
        // Redirect back to the employee rents page
        App::getRouter()->redirectTo('employeeRents');
    }
}