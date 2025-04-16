<?php

namespace app\controllers;

use core\App;

class AboutUsCtrl {

    public function action_aboutUs() {
        App::getSmarty()->assign('page_title', 'Biblioteka');
        App::getSmarty()->display('AboutUs.tpl');
    }
}
?>
