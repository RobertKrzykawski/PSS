<?php

namespace app\controllers;

use core\App;
use core\Utils;
use core\ParamUtils;

class RentManagementCtrl {
    public function action_employeeRents() {
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
            $conditions['users.surname[~]'] = $surnameFilter;
        }
        if ($bookTitleFilter) {
            $conditions['books.title[~]'] = $bookTitleFilter;
        }

        try {
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
                "ORDER" => ["rents.return_date" => "DESC"]
            ]);

            if (empty($rents)) {
                Utils::addInfoMessage('Brak wyników dla podanych filtrów.');
            }

            App::getSmarty()->assign('rents', $rents);
            App::getSmarty()->assign('date_filter', $dateFilter);
            App::getSmarty()->assign('rent_id_filter', $rentIdFilter);
            App::getSmarty()->assign('surname_filter', $surnameFilter);
            App::getSmarty()->assign('book_title_filter', $bookTitleFilter);
        } catch (\PDOException $e) {
            Utils::addErrorMessage('Wystąpił błąd podczas pobierania wypożyczeń.');
            if (App::getConf()->debug) {
                Utils::addErrorMessage($e->getMessage());
            }
        }

        App::getSmarty()->display('EmployeeRentView.tpl');
    }

    public function action_updateRentStatus() {
        // Pobierz ID wypożyczenia i nowy status z żądania
        $rentId = ParamUtils::getFromPost('rent_id');
        $newStatus = ParamUtils::getFromPost('status');
    
        try {
            if ($newStatus === 'Zwrócone') {
                // Pobierz ID książki z tabeli wypożyczeń
                $rent = App::getDB()->get("rents", "*", ["rent_id" => $rentId]);
                $bookId = $rent['book_id'];

                // Zwiększ liczbę dostępnych egzemplarzy
                App::getDB()->update("books", [
                    "available_copies[+]" => 1
                ], [
                    "book_id" => $bookId
                ]);
            }

            // Ustaw dzisiejszą datę jako "returned_date"
            $currentDate = date('Y-m-d');
            App::getDB()->update("rents", [
                "returned_date" => $currentDate
            ], [
                "rent_id" => $rentId
            ]);

            // Zaktualizuj status wypożyczenia
            App::getDB()->update("rents", [
                "status" => $newStatus
            ], [
                "rent_id" => $rentId
            ]);
            Utils::addInfoMessage('Status wypożyczenia został zaktualizowany.');
        } catch (\PDOException $e) {
            Utils::addErrorMessage('Wystąpił błąd podczas aktualizacji statusu wypożyczenia.');
            if (App::getConf()->debug) {
                Utils::addErrorMessage($e->getMessage());
            }
        }

        App::getRouter()->redirectTo('employeeRents');
    }
}