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
                echo"saleeemmm11<br>";
                $feedbackModel->insert($feedback);
                echo"saleeemmm";
                header('Location: /feedback?success=Feedback%20Submitted');
            }
            catch(Exception $e){
                header('Location: /feedback?error=Feedback%20Cannot%20be%20empty');
            }
        }    
    }
}
?>
