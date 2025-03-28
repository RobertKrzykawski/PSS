<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../app/models/Book.php';

class BookDAO {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function findAllBooks() {
        $stmt = $this->db->query("SELECT * FROM books");
        $books = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $books[] = new Book($row['book_id'], $row['title'], $row['author'], $row['isbn']);
        }
        return $books;
    }
}
?>
