<?php
require_once __DIR__ . '/../dao/BookDAO.php';

class BookSrv {
    private $bookDAO;

    public function __construct() {
        $this->bookDAO = new BookDAO();
    }

    public function getAllBooks() {
        return $this->bookDAO->findAllBooks();
    }
}
?>
