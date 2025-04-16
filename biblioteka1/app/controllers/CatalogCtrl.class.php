<?php
namespace app\controllers;

use core\App;
use core\Utils;
use core\ParamUtils;
use core\SessionUtils;

class CatalogCtrl {
    private $records_per_page = 5;

    public function action_catalog() {
        // Get the current page number from the request
        $page = ParamUtils::getFromRequest('page', false, 'Invalid application call');
        if (!$page || $page < 1) {
            $page = 1; // Default to the first page if no valid page is provided
        }

        $offset = ($page - 1) * $this->records_per_page;

        // Capture the search query and search type (title or author)
        $search_query = ParamUtils::getFromRequest('search', false, '');
        $search_type = ParamUtils::getFromRequest('search_type', false, 'title'); // Default to 'title'

        try {
            // Build conditions based on the search query and selected search type
            $conditions = [];
            if ($search_query) {
                if ($search_type == 'title') {
                    $conditions['books.title[~]'] = "%$search_query%"; // Search by partial title
                } elseif ($search_type == 'author') {
                    $conditions['books.author[~]'] = "%$search_query%"; // Search by partial author name
                }
            }

            // Fetch books with genre information from the database
            $books = App::getDB()->select("books", [
                "[><]genres" => ["genre_id" => "genre_id"] // Join books with genres table
            ], [
                "books.book_id",
                "books.title",
                "books.author",
                "genres.genre_name",
                "books.available_copies"
            ], array_merge($conditions, [
                "ORDER" => ["books.title" => "ASC"], // Sort books alphabetically by title
                "LIMIT" => [$offset, $this->records_per_page] // Pagination limit
            ]));

            // Fetch the total number of books to calculate total pages
            $total_books = App::getDB()->count("books", $conditions);

            // Calculate the total pages
            $total_pages = ceil($total_books / $this->records_per_page);

            // Assign the fetched books, pagination variables, and search parameters to the Smarty template
            App::getSmarty()->assign('books', $books);
            App::getSmarty()->assign('total_pages', $total_pages);
            App::getSmarty()->assign('current_page', $page);
            App::getSmarty()->assign('search_query', $search_query);
            App::getSmarty()->assign('search_type', $search_type); // Pass selected search type to the view

        } catch (\PDOException $e) {
            Utils::addErrorMessage('An error occurred while retrieving the books.');
            if (App::getConf()->debug) {
                Utils::addErrorMessage($e->getMessage());
            }
        }

        // Display the template
        App::getSmarty()->display('CatalogView.tpl');
    }
}
