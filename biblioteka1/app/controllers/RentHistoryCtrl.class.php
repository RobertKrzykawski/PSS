<?php

namespace app\controllers;

use core\App;
use core\Utils;
use core\ParamUtils;
use core\SessionUtils;

class RentHistoryCtrl {
    private $records_per_page = 20;

    public function action_rentHistory() {
        // Get the logged-in user
        $user = SessionUtils::load("user", true);
        if (!$user) {
            Utils::addErrorMessage('You must be logged in to view your rental history.');
            App::getRouter()->redirectTo('loginShow');
            return;
        }
        $user_id = $user->user_id;

        // Validate and process the `page` parameter
        $page = ParamUtils::getFromRequest('page', false, 'Invalid application call');
        if (!$page || !ctype_digit($page) || $page <= 0) {
            $page = 1; // Default to the first page
        }

        $offset = ($page - 1) * $this->records_per_page;

        try {
            // Get total number of records for pagination
            $total_records = App::getDB()->count("rents", [
                "user_id" => $user_id
            ]);
            $total_pages = ceil($total_records / $this->records_per_page);
        
            // Adjust `page` if it exceeds the total number of pages
            if ($page > $total_pages) {
                $page = $total_pages > 0 ? $total_pages : 1;
                $offset = ($page - 1) * $this->records_per_page;
            }
        
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
                "rents.user_id" => $user_id,
                "ORDER" => ["rents.rent_id" => "DESC"],
                "LIMIT" => [$offset, $this->records_per_page]
            ]);
        
            // Ensure both variables are passed to the template
            App::getSmarty()->assign('no_rents', empty($rents)); // true if no rents exist
            App::getSmarty()->assign('rents', $rents); 
        
            // Pass additional pagination data
            App::getSmarty()->assign('total_pages', $total_pages);
            App::getSmarty()->assign('current_page', $page);
        
        } catch (\PDOException $e) {
            Utils::addErrorMessage('An error occurred while retrieving rental history.');
            if (App::getConf()->debug) {
                Utils::addErrorMessage($e->getMessage());
            }
            
            // Assign default empty values in case of failure
            App::getSmarty()->assign('no_rents', true);
            App::getSmarty()->assign('rents', []);
            App::getSmarty()->assign('total_pages', 1);
            App::getSmarty()->assign('current_page', 1);
        }        

        // Render the view
        App::getSmarty()->display('RentHistoryView.tpl');
    }
}
