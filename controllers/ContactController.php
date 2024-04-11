<?php
require_once 'Controller.php';

class ContactController extends Controller{
    public function index(){
        require_once 'views/contact.php';
    }

    public function handleContact(){
        require_once 'utils/MailSender/MailSender.php';
        if (isset($_POST['send-button'])) {
            $email = $_POST['email'];
            $object = $_POST['object'];
            $message = $_POST['message'];
            MailSender::receiveMail($email, $object, $message); 
        }
    }
}
?>
