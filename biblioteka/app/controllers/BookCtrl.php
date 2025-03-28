<?php
require_once __DIR__ . '/../services/BookSrv.php';

class BookCtrl {
    private $service;

    public function __construct() {
        $this->service = new BookSrv();
    }

    public function showBooks() {
        $books = $this->service->getAllBooks();
        include __DIR__ . '/../views/BookList.tpl';
    }
}
?>
