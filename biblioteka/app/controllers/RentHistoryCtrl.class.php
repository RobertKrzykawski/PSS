<?php

namespace app\controllers;

use core\App;
use core\Utils;
use core\ParamUtils;
use core\SessionUtils;

class RentHistoryCtrl {
    private $records_per_page = 5;

    public function action_rentHistory() {
        $user = SessionUtils::load("user", true);
        if (!$user) {
            Utils::addErrorMessage('You must be logged in to view your rental history.');
            App::getRouter()->redirectTo('loginShow');
            return;
        }
        $userId = $user->id;

        // Get current page
        $page = ParamUtils::getFromRequest('page', false, 'Invalid application call');
        if (!$page) {
            $page = 1;
        }

        $offset = ($page - 1) * $this->records_per_page;

        try {
            // Get total number of records for pagination
            $total_records = App::getDB()->count("rents", [
                "user_id" => $userId
            ]);
            $total_pages = ceil($total_records / $this->records_per_page);

            // Fetch rental records for the user
            $rents = App::getDB()->select("rents", [
                "[><]books" => ["book_id" => "book_id"]
            ], [
                "rents.rent_id",
                "rents.rent_date",
                "rents.return_date",
                "books.title(book_title)",
                "books.author(book_author)"
            ], [
                "rents.user_id" => $userId,
                "ORDER" => ["rents.rent_date" => "DESC"],
                "LIMIT" => [$offset, $this->records_per_page]
            ]);

            // Assign data to the view
            App::getSmarty()->assign('rents', $rents); 
            App::getSmarty()->assign('total_pages', $total_pages);
            App::getSmarty()->assign('current_page', $page);
        } catch (\PDOException $e) {
            Utils::addErrorMessage('An error occurred while retrieving rental history.');
            if (App::getConf()->debug) {
                Utils::addErrorMessage($e->getMessage());
            }
        }
        App::getSmarty()->display('RentHistoryView.tpl');
    }
}
