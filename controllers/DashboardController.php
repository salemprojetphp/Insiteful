<?php

require_once 'Controller.php';
require_once __DIR__ . '/../models/User.php';

class DashboardController extends Controller
{
    public function index()
    {
        session_start();
        $email = $_GET['email'];
        $userModel = new User();
        $user = $userModel->getUserByEmail($email);
        $user_id = $user -> id;
        echo $user_id;
        $_SESSION['user_id'] = $user_id;
        require_once 'views/dashboard.php';
    }
}
?>