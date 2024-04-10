<?php
    
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    require_once 'Models/User.php';
    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
    } else {
        $user_id = null;
    }
    $userModel = new User();
    $user = $userModel->getUserById($user_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INSITEFUL</title>
    <link rel="icon" href="/public/images/insiteful.png">
    <link rel="stylesheet" href="/public/css/header.css">
    <link rel="stylesheet" href="../public/css/contact.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="../public/js/header.js" defer></script>
</head>
    
    <body>
    <input type="checkbox" id="check">
    <header>
        <h2>
            <a href="/" class="logo"><img src="/public/images/insiteful.png" alt="logo"></a>
        </h2>

        <!-- choosing the navigation based on the user role -->
        <?php
            if($user && $user->Role == 'Admin') {
                echo '      
                <div class="navigation">
                    <a href="/adminDashboard">Dashboard</a>
                    <a href="/blog">Blog</a>
                    <a href="/adminFeedback">Feedback</a>
                    <a href="/notifications">Notifications <span>0</span></a>
                ';
            } else{
                echo '
                <div class="navigation">
                    <a href="/">Home</a>
                    <a href="/dashboard">Dashboard</a>
                    <a href="/blog">Blog</a>
                    <a href="" class="contact-btn">Contact</a>
                    <a href="/feedback">Feedback</a>
                ';
            } 
        ?>  

        <!-- displaying session info  -->
        <?php
            if($user) {
                echo '
                    <div class="user-session-info">
                        <img src="../public/images/user.png" width="36" height="36">
                        <span>'.$user->Username.'</span>
                    </div>
                    </div>
                    <div class="dropdown">
                            <a href="/profile">Profile</a>
                            <a href="/logout">Logout</a>
                    </div>
                ';
            } else {
                echo '
                    <a href="/auth" class="login-btn">Get Started</a>
                ';
            }
        ?>
        
        <label for="check">
            <i class="fas fa-bars menu-btn"></i>
            <i class="fas fa-times close-btn"></i>
        </label>
    </header>
    <?php
        if(!$user || $user->Role == 'User'){
            require_once 'views/contact.php';
        }
    ?>
    <main>