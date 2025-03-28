<?php
require_once __DIR__ . '/../services/UserSrv.php';

class UserCtrl {
    private $service;

    public function __construct() {
        $this->service = new UserSrv();
    }

    public function showProfile($user_id) {
        $user = $this->service->getUser($user_id);
        include __DIR__ . '/../views/Profile.tpl';
    }
}
?>
