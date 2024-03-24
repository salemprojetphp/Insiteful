<?php
require_once 'Controller.php';
require_once __DIR__ . '\\..\\models\\User.php';



class AuthController extends Controller{
    public function login() {
        require_once 'views/login.php';
    }

    public function authenticate() {
        $email = $_POST['email'];
        $password = $_POST['password'];

        echo $email;
        echo $password;

        $userModel = new User();
        $loginResult = $userModel->login($email, $password);

        if ($loginResult === "Correct information") {
            header('Location: /dashboard');
            exit;
        } else {
            header('Location: /login?error=' . urlencode($loginResult));
            exit;
        }
        
    }
}
?>
