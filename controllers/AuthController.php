<?php
require_once 'Controller.php';
require_once __DIR__ . '\\..\\models\\User.php';
require_once 'utils\MailSender\MailSender.php';



class AuthController extends Controller{
    public function auth(){
        require_once 'views/auth.php';
    }

    public function verifyEmail(){
        require_once 'views/PasswordRecovery/emailverification.php';
    }

    public function passwordChange(){
        require_once 'views/PasswordRecovery/changepassword.php';
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
            header("Location: /auth?error=Verify%20Password");
        }
    }
    public function sendPasswordRecoveryCode(){
        $email = $_POST["email"];
        $userModel = new User();
        $exists = $userModel->getUserByEmail($email);
        if(!$exists){
            header("Location: /emailverification?error=Email%20isn't%20registered"); //if the email doesnt exits then the user doesnt have an account and thus cant change a password
            exit;
        }
        else{
            $code = rand(10000, 99999); //this code will be sent to the user in mail
            //MailSender::sendMail($email, "Password recovery", $code);
            setcookie('mail',$email,time() + 3600, '/'); //email will be used to set the password in the next page
            setcookie('code', $code,time() + 3600, '/'); //to verify and compare the code the user put
            header("Location: /passwordchange");
        }
    }
    public function changePassword(){// this handles all the possible outcomes after the code is sent 
        if(!isset($_GET['message'])){ //
            $code = $_COOKIE['code'];
            $userCode = $_POST['code'];
            if($code == $userCode){
                header("Location : /passwordchange?message=Correct%20code");
            }
            elseif($code != $userCode){
                header("Location : /passwordchange?message=Wrong%20code");
                exit;
            }
        }
        elseif($_GET['message'] == 'Correct code'){
            $email = $_COOKIE['mail']; 
            $password = $_POST['password'];
            $cpassword = $_POST['cpassword'];
            if($password = $cpassword){
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $user = new User();
                $user->setPassword($email, $hashedPassword);
            }
            else{
                header("Location : /passwordchange?message=Check%20password");
                exit;
            }
        }
    }
}
?>
