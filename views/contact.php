<!--<!DOCTYPE html>-->
<!--<html lang="en" dir="ltr">-->
<!--<head>-->
<!--    <meta charset="UTF-8">-->
<!--    <title> Insiteful </title>-->
<!--    <meta name="viewport" content="width=device-width, initial-scale=1">-->
<!--    <link rel="stylesheet" href="contact.css">-->
<!--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>-->
<!--    <meta name="viewport" content="width=device-width, initial-scale=1.0">-->
<!--</head>-->
<!--<body>-->
<!--<div class="container">-->
<!--    <div class="content">-->
<!--        <div class="left-side">-->
<!--            <div class="address details">-->
<!--                <i class="fas fa-map-marker-alt"></i>-->
<!--                <div class="topic">Address</div>-->
<!--                <div class="text-one">Surkhet, NP12</div>-->
<!--                <div class="text-two">Birendranagar 06</div>-->
<!--            </div>-->
<!--            <div class="phone details">-->
<!--                <i class="fas fa-phone-alt"></i>-->
<!--                <div class="topic">Phone</div>-->
<!--                <div class="text-one">+0098 9893 5647</div>-->
<!--                <div class="text-two">+0096 3434 5678</div>-->
<!--            </div>-->
<!--            <div class="email details">-->
<!--                <i class="fas fa-envelope"></i>-->
<!--                <div class="topic">Email</div>-->
<!--                <div class="text-one">codinglab@gmail.com</div>-->
<!--                <div class="text-two">info.codinglab@gmail.com</div>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="right-side">-->
<!--            <div class="topic-text">Send us a message</div>-->
<!--            <p>If you have any work from me or any types of quries related to my tutorial, you can send me message from here. It's my pleasure to help you.</p>-->
<!--            <form action="#">-->
<!--                <div class="input-box">-->
<!--                    <input type="text" placeholder="Enter your name">-->
<!--                </div>-->
<!--                <div class="input-box">-->
<!--                    <input type="text" placeholder="Enter your email">-->
<!--                </div>-->
<!--                <div class="input-box message-box">-->
<!---->
<!--                </div>-->
<!--                <div class="button">-->
<!--                    <input type="button" value="Send Now" >-->
<!--                </div>-->
<!--            </form>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<!--</body>-->
<!--</html>-->

<?php
include_once 'views/home.php';
?>

<html lang="en"><head>
    <meta charset="utf-8">
    <title>Insiteful</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="/public/css/home.css">
    <link rel="stylesheet" href="../public/css/contact.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;700&amp;family=Poppins:wght@700&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.2/jquery.modal.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.2/jquery.modal.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script data-id="33671ad4-a966-4a52-b48f-56c92d10a678" data-utcoffset="1" data-server="https://simple-web-analytics.com" src="https://cdn.counter.dev/script-testing.js"></script>
</head>
<body>
    <div class="container">
        <div class="contact-container">
            <div class="content">
                <div class="left-side">
                    <div class="address details">
                        <i class="fas fa-map-marker-alt"></i>
                        <div class="topic">Address</div>
                        <div class="text-one">Centre Urbain Nord</div>
                        <div class="text-two">INSAT</div>
                    </div>
                    <div class="phone details">
                        <i class="fas fa-phone-alt"></i>
                        <div class="topic">Phone</div>
                        <div class="text-one">+216 20 667 149</div>
                        <div class="text-two">+216 52 120 882</div>
                    </div>
                    <div class="email details">
                        <i class="fas fa-envelope"></i>
                        <div class="topic">Email</div>
                        <div class="text-one">insiteful@gmail.com</div>
                    </div>
                </div>
                <div class="right-side">
                    <div class="topic-text">Contact Us</div>
                    <p>We are pleased to receive any questions from you !</p>
                    <form method="post">
                        <div class="input-box">
                            <input type="text" id="email-input" name="email" placeholder="Enter your email" required>
                        </div>
                        <div class="input-box">
                            <input type="text" id="object-input" name="object" placeholder="Enter the object" required>
                        </div>
                        <div class="input-box message-box">
                            <textarea name="message" id="message-input"  placeholder="Enter your messsage" required></textarea>
                        </div>
                        <div class="buttons">
                            <a href="/" class="cancel-button" rel="modal:close">Cancel</a>
                            <button type="submit" class="send-button" id="send-button" >Send</button>
                        </div>
                    </form>
                    <?php
                        require_once 'utils/MailSender/MailSender.php';

                        if (isset($_POST['send-button'])) {
                            $email =$_POST['email'];
                            $object = $_POST['object'];
                            $message = $_POST['message'];
                            MailSender::receiveMail($email,$object,$message);
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="../public/js/contact.js"></script>
</html>
