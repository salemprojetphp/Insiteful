<?php
require_once 'Controller.php';
require_once __DIR__ . '\\..\\models\\User.php';



class AuthController extends Controller{
    public function auth(){
        require_once 'views/auth.php';
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
            header('Location: /auth?error=' . urlencode($loginResult));
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
                error_log($exists);

                if($exists){
                    header("Location: /auth?error=Email%20Already%20Used");
                    exit;
                }
                $userModel->register($email, $hashedPassword, $username);
                header("Location: /dashboard");
            }
            catch(PDOException $e){
                header("Location: /auth?error=Internal%20Error");
            }
        }
        else{
            header("Location: /auth?error=Verify%20Password".password." ".cpassword);
        }
    }
}
?>
