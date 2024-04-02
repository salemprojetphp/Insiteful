<?php
    include_once "adminheader.php";
    include_once 'models/Feedback.php';
    $feedbackModel = new Feedback();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/public/css/adminfeedback.css">
</head>
<body>
    <h1>
        Feedbacks
    </h1>
    <div class="container">
        <?php 
            $feedbacks = $feedbackModel->getFeedbacks();
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
            </div>
        <?php endforeach ?>
    </div>
    <script>
        const buttons = document.querySelectorAll("#remove");
        buttons.forEach(addEventListener("click", (e) =>{
            let feedback = e.target.parentNode;
            if(feedback.className == "feedback" && e.target.id == "remove"){
                feedback.remove();
            }
        }))
    </script>
    
</body>
</html>