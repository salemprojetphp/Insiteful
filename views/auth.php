<?php 
include_once 'header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insiteful</title>
    <link rel="icon" href="../public/images/insiteful.png">
    <link rel="stylesheet" href="../public/css/header.css">
    <link rel="stylesheet" href="../public/css/auth.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="/public/css/auth.css" type="text/css">

</head>
<body>

<?php
    if(isset($_GET['error'])) {
        echo "<h3>" . $_GET['error'] . "</h3>";
    }
?>
<div class="container" id="container">
    
    <div class="form-container sign-up-container">
        <form method="post" action="/signup/action">
            <h1>Create Account</h1>
            <span>or use your email for registration</span>
            <input type="text" name='username' placeholder="Name" />
            <input type="email" name='email' placeholder="Email" />
            <input type="password" name='password' placeholder="Password" />
            <input type="password" name='cpassword' placeholder="Confirm Password" />
            <button type="submit">Sign Up</button>
        </form>
    </div>
    <div class="form-container sign-in-container">
        <form action="/login/action" method="post">
            <h1>Sign In</h1>
            <span>or use your email for registration</span>
            <input type="email" name='email' placeholder="Email" />
            <input type="password" name='password' placeholder="Password" />
            <a href="/forgotPassword">Forgot your password?</a>
            <button type="submit">Log in</button>
        </form>
    </div>
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-left">
                <h1 >Welcome Back!</h1>
                <p> keep connected with us please log in<br>with your personal info</p>
                <button class="ghost" id="signIn">Log In</button>
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
<script src="../public/js/auth.js"></script>
</html>
<?php
include_once 'footer.php';?>