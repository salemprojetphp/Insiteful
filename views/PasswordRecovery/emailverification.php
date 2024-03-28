<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/public/images/insiteful.png">
    <link rel="stylesheet" href="/public/css/pwdRecovery.css">
    <title>Password Recovery</title>
</head>
<body>
    <h2>
        <a href="Blog.php" class="logo"><img src="/public/images/insiteful.png" alt="logo"></a>
    </h2>
    <div class="container">
        <h1>Forgot your password</h1>
        <?php
            echo (isset($_GET['error'])) ? "<p>" . $_GET['error'] . "</p>" : "<p>A code will be sent to this email</p>"
        ?>
        <form method="post" action="/recoverpassword/action">
            <input type="mail" placeholder="Email" required name="email"><br>
            <input type="submit" value="Submit" class="button">
        </form>

    </div>
</body>
</html>