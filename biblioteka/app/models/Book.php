<?php
class Book {
    public $book_id;
    public $title;
    public $author;
    public $isbn;

    public function __construct($book_id, $title, $author, $isbn) {
        $this->book_id = $book_id;
        $this->title = $title;
        $this->author = $author;
        $this->isbn = $isbn;
    }
}
?>