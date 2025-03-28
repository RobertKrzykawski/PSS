<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../app/models/User.php';

class UserDAO {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function findUserById($user_id) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $user_id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            return new User($data['user_id'], $data['name'], $data['surname'], $data['email']);
        }
        return null;
    }
}
?>