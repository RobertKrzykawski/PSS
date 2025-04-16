<?php
namespace app\controllers;

use core\App;
use core\Utils;
use core\ParamUtils;
use core\SessionUtils;

class CatalogCtrl {
    private $records_per_page = 10;

    public function action_catalog() {
        // Get the current page number from the request
        $page = ParamUtils::getFromRequest('page', false, 'Invalid application call');
        if (!$page || $page < 1) {
            $page = 1; // Default to the first page if no valid page is provided
        }

        $offset = ($page - 1) * $this->records_per_page;

        // Capture the search query and search type (title or author)
        $search_query = ParamUtils::getFromRequest('searchInput', false, '');
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

            // Check if it's an AJAX request
            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                header('Content-Type: application/json');
                echo json_encode([
                    'books' => $books,
                    'pagination' => $this->generatePagination($page, $total_pages, $search_query, $search_type)
                ]);
                exit;
            }
        
            // Assign the fetched books, pagination variables, and search parameters to the Smarty template
            App::getSmarty()->assign([
                'books' => $books,
                'total_pages' => $total_pages,
                'current_page' => $page,
                'search_query' => $search_query,
                'search_type' => $search_type
            ]);

        } catch (\PDOException $e) {
            Utils::addErrorMessage('An error occurred while retrieving the books.');
            if (App::getConf()->debug) {
                Utils::addErrorMessage($e->getMessage());
            }
        }

        // Display the template
        App::getSmarty()->display('CatalogView.tpl');
    }

    private function generatePagination($current_page, $total_pages, $search_query, $search_type) {
        $pagination = '';
        if ($total_pages > 1) {
            $pagination .= '<div class="pagination">';
            
            // Previous link
            if ($current_page > 1) {
                $prev_page = $current_page - 1;
                $pagination .= '<a href="#" data-page="'.$prev_page.'" data-search="'.htmlspecialchars($search_query).'" data-type="'.$search_type.'">&laquo; Previous</a>';
            }
    
            // Page numbers
            $start = max(1, $current_page - 2);
            $end = min($total_pages, $current_page + 2);
            
            for ($i = $start; $i <= $end; $i++) {
                $active = ($i == $current_page) ? 'active' : '';
                $pagination .= '<a href="#" class="'.$active.'" data-page="'.$i.'" data-search="'.htmlspecialchars($search_query).'" data-type="'.$search_type.'">'.$i.'</a>';
            }
    
            // Next link
            if ($current_page < $total_pages) {
                $next_page = $current_page + 1;
                $pagination .= '<a href="#" data-page="'.$next_page.'" data-search="'.htmlspecialchars($search_query).'" data-type="'.$search_type.'">Next &raquo;</a>';
            }
    
            $pagination .= '</div>';
        }
        return $pagination;
    }
    
    public function action_ajaxSearchBooks() {
        $this->action_catalog(); // Reuse the same logic
    }
}