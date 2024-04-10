<?php
    session_start();
    // $userModel = new User(); 
    // include_once "models/User.php";
    // $user = $userModel->getUserById($_SESSION['user_id']);
    // echo $_SESSION['user_id'];
    // if(!isset($user) || $user->Role != 'Admin'){
    //     echo "404 - not found";
    //     return false;
    // }
    include_once "views/header.php";
    include_once 'models/Feedback.php';
    $feedbackModel = new Feedback();
    $feedbacksToHide = [];
    if(isset($_GET["id"])){
        $feedbacksToHide[] = $_GET["id"];
    }
    foreach($feedbacksToHide as $feedback):
        $feedbackModel->hide($feedback);
    endforeach;
?>


<link rel="stylesheet" href="/public/css/adminfeedback.css">

<h1>
    Feedbacks
</h1>
<div class="container">
    <?php 
        $feedbacks = $feedbackModel->getFeedbacks();
        if(count((array)$feedbacks) === 0){
            echo "<h2>Looks like we're clear for now ! </h2>";
        }
        foreach($feedbacks as $feedback): ?>
        <div class="feedback">
            <button id="remove">
                -
            </button>
            <div class="user">
                <?php echo $feedback->Username; ?>
            </div>
            <div class="date">
                <?php echo $feedback->Date; ?>
            </div>
            <div class="content">
                <?php echo $feedback->Feedback; ?>
            </div>
            <div id="feedbackid" style="display :none">
                <?php echo $feedback->id; ?>
            </div>
        </div>
    <?php endforeach ?>
</div>
<script>
    const buttons = document.querySelectorAll("#remove");
    const feedbackID = document.querySelector("#feedbackid").textContent;
    buttons.forEach(addEventListener("click", (e) =>{
        let feedback = e.target.parentNode;
        if(feedback.className == "feedback" && e.target.id == "remove"){
            fetch(`/adminFeedback?id=${feedbackID}`).then(feedback.remove());
            
        }
    }))
</script>
    
</body>
</html>