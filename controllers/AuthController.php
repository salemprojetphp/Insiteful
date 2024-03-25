<?php
require_once 'Controller.php';
require_once __DIR__ . '\\..\\models\\User.php';



class AuthController extends Controller{
    public function login() {
        require_once 'views/login.php';
    }

    public function signup(){
        require_once 'views/signup.php';
    }

    public function authenticate() {
        $email = $_POST['email'];
        $password = $_POST['password'];


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

    public function register(){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $userModel = new User();

        if($password == $cpassword){
            try{;
                $exists= $userModel->getUserByEmail($email);
                if($exists){
                    header("Location: /signup?error=Email%20Already%20Used");
                    exit;
                }
                $userModel->register($email, $hashedPassword, $username);
                header("Location: /login");
            }
            catch(PDOException $e){
                header("Location: /signup?error=Email%20Already%20Used");
            }
        }
        else{
            header("Location: /signup?error=Verify%20Password".password." ".cpassword);
        }
    }
}
?>
