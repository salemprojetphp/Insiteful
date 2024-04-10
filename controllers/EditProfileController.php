<?php
require_once 'Controller.php';
require_once 'models/User.php';
require_once 'views/editProfilePage.php';

class EditProfileController extends Controller{
    public function index(){
        require_once 'views/editProfilePage.php';
    }
    public function handleProfileUpdate(){
        $userModel=new User();
        session_start();
        $userId=$_SESSION['user_id'];
        $username=$_POST['username'];
          $profilePic=$_POST['profile-picture'];
        $mail=$_POST['email'];
        $oldPassword=$_POST['old-password'];
        $newPassword=$_POST['new-password'];
        $verifPassword=$_POST['verif-password'];
        if(isset($username)||isset($mail)){
            $userModel->updateInformation($userId,$username,$mail);
        }
        if(isset($newPassword,$oldPassword,$verifPassword)){
            if($userModel->verifyPassword($userId,$oldPassword)){
                if ($newPassword===$verifPassword){
                    $user=$userModel->getUserById($userId);
                    $userMail=$user->Email;
                    $userModel->setPassword($userMail,$newPassword);
                }
                else{
                    echo "Reverify your new password";
                }
            }
            else{
                echo "Old password incorrect";
            }
        }
        if(isset($profilePic)){
            $userModel->updateProfilePicture($userId,$profilePic);
        }
    }

}
?>