<?php

require_once 'Controller.php';

class HomeController extends Controller {
    public function index() {
        require_once 'views/home.php';
    }
}
?>
