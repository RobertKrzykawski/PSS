<?php
require_once __DIR__ . '/../controllers/BookCtrl.php';

$controller = new BookCtrl();
$controller->showBooks();
?>
