<?php

require_once 'Controller.php';
require_once __DIR__ . '/../models/feedback.php';


class FeedbackController extends Controller {
    public function index() {
        require_once 'views/feedback.php';
    }
    public function adminFeedback(){
        require_once 'views/admin/adminfeedback.php';
    }
    public function addFeedback(){
        $feedback = $_POST['feedback'];
        $feedbackModel = new Feedback();
        if($feedback){
            try{
                $feedbackModel->insert($feedback);
                header('Location: /feedback?success=Feedback%20Submitted');
                exit;
            }
            catch(Exception $e){
                header('Location: /feedback?error=Feedback%20Cannot%20be%20empty');
            }
        }    
    }
    public function hideFeedback(){
        $feedback = $_GET['id'];
        $feedbackModel = new Feedback();
        $feedbackModel->hide($feedback);
    }
}
?>
