<?php

require_once 'Controller.php';
require_once __DIR__ . '/../models/User.php';

class DashboardController extends Controller
{
    public function index(){
        require_once 'views/dashboard.php';
    }
    public function adminDashboard(){
        require_once 'views/admin/admindashboard.php';
    }
    public function pdf(){
        require_once 'views/pdf.php';
    }

}
?>