<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insiteful</title>
    <link rel="icon" href="../public/images/insiteful.png">
    <link rel="stylesheet" href="../public/css/header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="/public/css/signup.css" type="text/css">

</head>
<body>
<?php
if(isset($_GET['error'])) {
    echo "<h1>" . $_GET['error'] . "</h1>";
}
?>

<header>
    <h2>
        <a href="Blog.php" class="logo"><img src="../public/images/insiteful.png" alt="logo"></a>
    </h2>
    <div class="navigation">
        <a href="home.php">Home</a>
        <a href="#">About</a>
        <a href="Blog.php">Blog</a>
        <a href="#">Contact</a>
        <a href="#">Feedback</a>
    </div>
</header>
<div class="container" id="container">
    <div class="form-container sign-up-container">
        <form method="post" action="/signup/action">
            <h1>Create Account</h1>
            <span>or use your email for registration</span>
            <input type="text" placeholder="Name" />
            <input type="email" placeholder="Email" />
            <input type="password" placeholder="Password" />
            <input type="password" placeholder="Confirm Password" />
            <button>Sign Up</button>
        </form>
    </div>
    <div class="form-container sign-in-container">
        <form action="/login/authenticate" method="post">
            <h1>sign in</h1>
            <span>or use your email for registration</span>
            <input type="email" placeholder="Email" />
            <input type="password" placeholder="Password" />
            <a href="#">Forgot your password?</a>
            <button type="submit">Log in</button>
        </form>
    </div>
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-left">
                <h1 >Welcome Back!</h1>
                <p> keep connected with us please log in<br>with your personal info</p>
                <button class="ghost" id="signIn">Sign In</button>
            </div>
            <div class="overlay-panel overlay-right">
                <h1>   Hello, Friend!</h1>
                <p>   Enter your personal details and start </br>journey with us</p>
                <button class="ghost" id="signUp">Sign Up</button>
            </div>
        </div>
    </div>
</div>
</body>
<script src="/public/js/signup.js"></script>
</html>
