<?php

require_once 'Controller.php';
require_once __DIR__ . '/../models/User.php';

class DashboardController extends Controller
{
    public function index()
    {
        require_once 'views/dashboard.php';
    }
}
?>