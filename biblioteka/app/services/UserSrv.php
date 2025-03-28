<?php
require_once __DIR__ . '/../dao/UserDAO.php';

class UserSrv {
    private $userDAO;

    public function __construct() {
        $this->userDAO = new UserDAO();
    }

    public function getUser($user_id) {
        return $this->userDAO->findUserById($user_id);
    }
}
?>
