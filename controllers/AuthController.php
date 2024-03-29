<?php
require_once 'Controller.php';
require_once __DIR__ . '\\..\\models\\User.php';
require_once __DIR__ . '\\..\\models\\Verification.php';
require_once 'utils\MailSender\MailSender.php';
require_once 'utils\unique_code.php';

class AuthController extends Controller{
    private $userModel;
    private $verificationModel;

    public function __construct() {
        $this->userModel = new User();
        $this->verificationModel = new Verification();
    }

    public function auth(){
        require_once 'views/auth.php';
    }

    public function verifyEmail(){
        $email = $_GET['email'];
        $user = $this->userModel->getUserByEmail($email);
        if($user){
            if($user->Verified){
                header('Location: /dashboard?message=Email%20Already%20Verified');
                exit;
            }
        }
        else{
            header('Location: /auth?error=Email%20Not%20Registered');
            exit;
        }
        $token = generateUniqueVerificationCode();
        $this->verificationModel->insertVerificationToken($email, $token);
        $link= "http://localhost:8000/verify?email=$email&token=$token";
        MailSender::sendMail([$email], "Email verification", $link);
        require_once 'views/emailverification.php';
    }

    public function resetPasswordAction(){
        $email = $_POST['email'];
        $user = $this->userModel->getUserByEmail($email);
        if(!$user){
            header('Location: /resetPassowrd?error=Email%20Not%20Registered');
            exit;
        }
        $token = generateUniqueVerificationCode();
        $this->verificationModel->insertVerificationToken($email, $token);
        $link= "http://localhost:8000/setPassword?email=$email&token=$token";
        header("Location: /forgotPassword?email=$email");
        MailSender::sendMail([$email], "Password recovery", $link);
    }

    public function setPassword(){
        $email = $_GET['email'];
        $token = $_GET['token'];
        $result = $this->verificationModel->verifiy($email, $token, false);
        if($result){
            require_once 'views/resetPassword.php';
        }
        else{
            header("Location: /resetPasswordForm?error=Invalid%20Token");
        }
    }
    public function setPasswordAction(){
        $email = $_POST['email'];
        $token = $_POST['token'];
        $result = $this->verificationModel->verifiy($email, $token);
        if($result){
            $password = $_POST['password'];
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $this->userModel->setPassword($email, $hashedPassword);
            header('Location: /auth?message=Password%20Changed');
        }
        else{
            header("Location: /resetPasswordForm?error=Invalid%20Token");
        }
    }

    public function resetPsswordForm(){
        require_once 'views/resetPasswordForm.php';
    }


    public function verifyToken(){
        $email = $_GET['email'];
        $token = $_GET['token'];
        $result = $this->verificationModel->verifiy($email, $token);
        if($result){
            header('Location: /dashboard?message=Email%20Verified');
        }
        else{
            header("Location: /emailverification?email=$email&error=Invalid%20Token");
        }
    }

    public function passwordChange(){
        require_once 'views/PasswordRecovery/changepassword.php';
    }

    public function authenticate() {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $loginResult = $this->userModel->login($email, $password);

        if ($loginResult === "Correct information") {
            if(!$this->userModel->isVerified($email)){
                echo "Email not verified";
                header('Location: /emailverification?email=' . $email);
                exit;
            }
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

        if($password == $cpassword){
            try{;
                $exists= $this->userModel->getUserByEmail($email);
                error_log($exists);

                if($exists){
                    header("Location: /auth?error=Email%20Already%20Used");
                    exit;
                }
                $this->userModel->register($email, $hashedPassword, $username);
                header("Location: /emailverification?email=$email");
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
        $exists = $this->userModel->getUserByEmail($email);
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
                $this->userModel->setPassword($email, $hashedPassword);
            }
            else{
                header("Location : /passwordchange?message=Check%20password");
                exit;
            }
        }
    }
}
?>
