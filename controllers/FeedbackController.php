<?php

require_once 'Controller.php';
require_once __DIR__ . '/../models/feedback.php';


class FeedbackController extends Controller {
    public function index() {
        require_once 'views/feedback.php';
    }
    public function addFeedback(){
        $feedback = $_POST['feedback'];
        $feedbackModel = new Feedback();
        if($feedback){
            try{
                $feedbackModel->insert($feedback);
                header('Location: /');
            }
            catch(Exception $e){
                header('Location: /feedback?error=Feedback%20Cannot%20be%20empty');
            }
        } 
    }
}
?>
